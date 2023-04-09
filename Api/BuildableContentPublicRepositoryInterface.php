<?php
/**
 * @package Goomento_PageBuilderApi
 * @link https://github.com/Goomento/PageBuilderApi
 */
declare(strict_types=1);

namespace Goomento\PageBuilderApi\Api;

interface BuildableContentPublicRepositoryInterface
{
    /**
     * Get content data by identifier
     *
     * @param string $identifier
     * @param string|null $token
     * @return ResponseBuildableContentInterface
     */
    public function getPublicContent(string $identifier, ?string $token = '') : ResponseBuildableContentInterface;
}
