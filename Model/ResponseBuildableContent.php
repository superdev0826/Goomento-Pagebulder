<?php
/**
 * @package Goomento_PageBuilderApi
 * @link https://github.com/Goomento/PageBuilderApi
 */
declare(strict_types=1);

namespace Goomento\PageBuilderApi\Model;

use Goomento\PageBuilderApi\Api\ResponseBuildableContentInterface;
use Magento\Framework\DataObject;

class ResponseBuildableContent extends DataObject implements ResponseBuildableContentInterface
{
    /**
     * @inheritDoc
     */
    public function getSettings(): array
    {
        return (array) $this->getData(self::SETTINGS);
    }

    /**
     * @inheritDoc
     */
    public function setSettings(array $settings): ResponseBuildableContentInterface
    {
        return $this->setData(self::SETTINGS, $settings);
    }

    /**
     * @inheritDoc
     */
    public function getElements(): array
    {
        return (array) $this->getData(self::ELEMENTS);
    }

    /**
     * @inheritDoc
     */
    public function setElements(array $elements): ResponseBuildableContentInterface
    {
        return $this->setData(self::ELEMENTS, $elements);
    }

    /**
     * @inheritDoc
     */
    public function getTitle(): string
    {
        return (string) $this->getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function setTitle(string $title): ResponseBuildableContentInterface
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return (string) $this->getData(self::TYPE);
    }

    /**
     * @inheritDoc
     */
    public function setType(string $type): ResponseBuildableContentInterface
    {
        return $this->setData(self::TYPE, $type);
    }

    /**
     * @inheritDoc
     */
    public function getStatus(): string
    {
        return (string) $this->getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setStatus(string $status): ResponseBuildableContentInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @inheritDoc
     */
    public function getUpdateTime(): string
    {
        return (string) $this->getData(self::UPDATE_TIME);
    }

    /**
     * @inheritDoc
     */
    public function setUpdateTime(string $updateTime): ResponseBuildableContentInterface
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * @inheritDoc
     */
    public function getCreationTime(): string
    {
        return (string) $this->getData(self::CREATION_TIME);
    }

    /**
     * @inheritDoc
     */
    public function setCreationTime(string $creationTime): ResponseBuildableContentInterface
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * @inheritDoc
     */
    public function getHtml(): string
    {
        return (string) $this->getData(self::HTML);
    }

    /**
     * @inheritDoc
     */
    public function setHtml(string $html): ResponseBuildableContentInterface
    {
        return $this->setData(self::HTML, $html);
    }

    /**
     * @inheritDoc
     */
    public function getStyles(): array
    {
        return (array) $this->getData(self::STYLES);
    }

    /**
     * @inheritDoc
     */
    public function setStyles(array $styles): ResponseBuildableContentInterface
    {
        return $this->setData(self::STYLES, $styles);
    }
}
