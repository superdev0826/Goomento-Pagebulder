<?php
/**
 * @package Goomento_PageBuilderApi
 * @link https://github.com/Goomento/PageBuilderApi
 */
declare(strict_types=1);

namespace Goomento\PageBuilderApi\Model\WebApi;

use Goomento\PageBuilderApi\Api\ResponseBuildableContentInterface;

class ChangeOutputArray
{
    /**
     * @param ResponseBuildableContentInterface $data
     * @param array $result
     * @return array
     */
    public function execute(
        ResponseBuildableContentInterface $data,
        array $result
    ) {
        $result[ResponseBuildableContentInterface::SETTINGS] = $data->getSettings();
        $result[ResponseBuildableContentInterface::ELEMENTS] = $data->getElements();
        $result[ResponseBuildableContentInterface::STYLES] = $data->getStyles();

        return $result;
    }
}
