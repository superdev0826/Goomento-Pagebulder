<?php
/**
 * @package Goomento_PageBuilderApi
 * @link https://github.com/Goomento/PageBuilderApi
 */
declare(strict_types=1);

namespace Goomento\PageBuilderApi\Model;

use Goomento\PageBuilder\Api\ContentRegistryInterface;
use Goomento\PageBuilder\Api\Data\BuildableContentInterface;
use Goomento\PageBuilder\Builder\Css\ContentCss;
use Goomento\PageBuilder\Builder\Css\GlobalCss;
use Goomento\PageBuilder\Helper\EncryptorHelper;
use Goomento\PageBuilder\Model\BetterCaching;
use Goomento\PageBuilder\Model\ContentDataProcessor;
use Goomento\PageBuilderApi\Api\BuildableContentPublicRepositoryInterface;
use Goomento\PageBuilderApi\Api\ResponseBuildableContentInterface;
use Goomento\PageBuilderApi\Api\ResponseBuildableContentInterfaceFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\LocalizedException;

class BuildableContentPublicRepository implements BuildableContentPublicRepositoryInterface
{
    /**
     * @var ResponseBuildableContentInterfaceFactory
     */
    private $responseBuildableContentFactory;
    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var ContentRegistryInterface
     */
    private $contentRegistry;
    /**
     * @var ContentDataProcessor
     */
    private $contentDataProcessor;
    /**
     * @var BetterCaching
     */
    private $betterCaching;

    /**
     * @param RequestInterface $request
     * @param ContentRegistryInterface $contentRegistry
     * @param ContentDataProcessor $contentDataProcessor
     * @param BetterCaching $betterCaching
     * @param ResponseBuildableContentInterfaceFactory $responseBuildableContentFactory
     */
    public function __construct(
        RequestInterface $request,
        ContentRegistryInterface $contentRegistry,
        ContentDataProcessor $contentDataProcessor,
        BetterCaching $betterCaching,
        ResponseBuildableContentInterfaceFactory $responseBuildableContentFactory
    ) {
        $this->request = $request;
        $this->responseBuildableContentFactory = $responseBuildableContentFactory;
        $this->contentRegistry = $contentRegistry;
        $this->contentDataProcessor = $contentDataProcessor;
        $this->betterCaching = $betterCaching;
    }

    /**
     * @inheritDoc
     */
    public function getPublicContent(string $identifier, ?string $token = ''): ResponseBuildableContentInterface
    {
        $result = null;
        $content = $this->contentRegistry->getByIdentifier($identifier);
        if ($content && $content->getId()) {
            if ($content->getIsActive() && $content->isPublished()) {
                $result = $content;
            } elseif ($token || $token = $this->request->getParam(EncryptorHelper::ACCESS_TOKEN)) {
                if (EncryptorHelper::isAllowed($token, $content)) {
                    $result = $content;
                }
            }
        }

        return $this->getResponseContent($result);
    }

    /**
     * @param BuildableContentInterface|null $buildableContent
     * @return ResponseBuildableContentInterface|null
     * @throws LocalizedException
     */
    protected function getResponseContent(?BuildableContentInterface $buildableContent) : ?ResponseBuildableContentInterface
    {
        /** @var ResponseBuildableContent $response */
        $response = $this->responseBuildableContentFactory->create();

        if ($buildableContent) {
            $key = implode('_', [
                'webapi_content',
                $buildableContent->getUniqueIdentity(),
                $buildableContent->getRevisionHash()
            ]);

            $collect = function () use ($response, $buildableContent) {
                $contentStyle = new ContentCss($buildableContent);
                $globalStyle = new GlobalCss();

                $styles[] = [
                    'href' => $globalStyle->getUrl(),
                    'content' => $globalStyle->getContent(),
                ];

                $styles[] = [
                    'href' => $contentStyle->getUrl(),
                    'content' => $contentStyle->getContent(),
                ];

                $elements = $buildableContent->getElements();
                $settingsForDisplay = [];
                foreach ($elements as $element) {
                    $settingsForDisplay[] =  $this->contentDataProcessor->getSettingsForDisplay($element);
                }

                $response->setTitle(
                    $buildableContent->getTitle()
                )->setElements(
                    $settingsForDisplay
                )->setSettings(
                    $buildableContent->getSettings()
                )->setStatus(
                    $buildableContent->getStatus()
                )->setType(
                    $buildableContent->getType()
                )->setUpdateTime(
                    $buildableContent->getUpdateTime()
                )->setCreationTime(
                    $buildableContent->getCreationTime()
                )->setHtml(
                    $this->contentDataProcessor->getHtml($buildableContent)
                )->setStyles(
                    $styles
                );

                $response->setData('settings_content', \Zend_Json::encode($response->getSettings()));
                $response->setData('elements_content', \Zend_Json::encode($response->getElements()));

                return $response->getData();
            };

            $data = $this->betterCaching->resolve($key, $collect);

            if ($response->isEmpty()) {
                $response->setData($data);
            }
        }

        return $response;
    }
}
