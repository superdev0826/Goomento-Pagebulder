<?php
/**
 * @package Goomento_PageBuilderApi
 * @link https://github.com/Goomento/PageBuilderApi
 */
declare(strict_types=1);

namespace Goomento\PageBuilderApi\Model\Resolver;

use Goomento\PageBuilderApi\Api\BuildableContentPublicRepositoryInterface;
use Goomento\PageBuilderApi\Model\ResponseBuildableContent;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\Resolver\ValueFactory;

class BuildableContent implements ResolverInterface
{
    /**
     * @var ValueFactory
     */
    private $valueFactory;
    /**
     * @var BuildableContentPublicRepositoryInterface
     */
    private $buildableContentPublicRepository;

    /**
     * @param ValueFactory $valueFactory
     * @param BuildableContentPublicRepositoryInterface $buildableContentPublicRepository
     */
    public function __construct(
        ValueFactory $valueFactory,
        BuildableContentPublicRepositoryInterface $buildableContentPublicRepository
    ) {
        $this->valueFactory = $valueFactory;
        $this->buildableContentPublicRepository = $buildableContentPublicRepository;
    }

    /**
     * @inheritDoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (!isset($args['identifier'])) {
            throw new GraphQlAuthorizationException(
                __(
                    'Identifier for pagebuilder should be specified'
                )
            );
        }
        try {
            /** @var ResponseBuildableContent $data */
            $data = $this->buildableContentPublicRepository->getPublicContent($args['identifier'], $args['token'] ?? '');
            $result = function () use ($data) {
                return !empty($data) ? $data->getData() : [];
            };
            return $this->valueFactory->create($result);
        } catch (LocalizedException $exception) {
            throw new GraphQlNoSuchEntityException(__($exception->getMessage()));
        } catch (\Exception $exception) {
            throw new GraphQlNoSuchEntityException(__('Something went wrong'));
        }
    }
}
