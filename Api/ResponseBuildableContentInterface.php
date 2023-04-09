<?php
/**
 * @package Goomento_PageBuilderApi
 * @link https://github.com/Goomento/PageBuilderApi
 */
declare(strict_types=1);

namespace Goomento\PageBuilderApi\Api;

interface ResponseBuildableContentInterface
{
    const STATUS                   = 'status';
    const TITLE                    = 'title';
    const TYPE                     = 'type';
    const ELEMENTS                 = 'elements';
    const SETTINGS                 = 'settings';
    const CREATION_TIME            = 'creation_time';
    const UPDATE_TIME              = 'update_time';
    const HTML                     = 'html';
    const STYLES                   = 'styles';

    /**
     * Set settings
     *
     * @return array
     */
    public function getSettings() : array;

    /**
     * Set settings
     *
     * @param array $settings
     * @return ResponseBuildableContentInterface
     */
    public function setSettings(array $settings) : ResponseBuildableContentInterface;

    /**
     * Get elements
     *
     * @return array
     */
    public function getElements() : array;

    /**
     * Set elements
     *
     * @param array $elements
     * @return ResponseBuildableContentInterface
     */
    public function setElements(array $elements) : ResponseBuildableContentInterface;

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() : string;

    /**
     * Set title
     *
     * @param string $title
     * @return ResponseBuildableContentInterface
     */
    public function setTitle(string $title) : ResponseBuildableContentInterface;

    /**
     * Get type
     *
     * @return string
     */
    public function getType() : string;

    /**
     * Set type
     *
     * @param string $type
     * @return ResponseBuildableContentInterface
     */
    public function setType(string $type) : ResponseBuildableContentInterface;

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus() : string;

    /**
     * Set status
     *
     * @param string $status
     * @return ResponseBuildableContentInterface
     */
    public function setStatus(string $status) : ResponseBuildableContentInterface;

    /**
     * Get update time
     *
     * @return string
     */
    public function getUpdateTime() : string;

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return ResponseBuildableContentInterface
     */
    public function setUpdateTime(string $updateTime) : ResponseBuildableContentInterface;

    /**
     * Get creation time
     *
     * @return string
     */
    public function getCreationTime() : string;

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return ResponseBuildableContentInterface
     */
    public function setCreationTime(string $creationTime) : ResponseBuildableContentInterface;

    /**
     * Get HTML
     *
     * @return string
     */
    public function getHtml() : string;

    /**
     * Set HTML
     *
     * @param string $html
     * @return ResponseBuildableContentInterface
     */
    public function setHtml(string $html) : ResponseBuildableContentInterface;

    /**
     * Get style link contents
     *
     * @return array
     */
    public function getStyles() : array;

    /**
     * Set style link contents
     *
     * @param array $styles
     * @return ResponseBuildableContentInterface
     */
    public function setStyles(array $styles) : ResponseBuildableContentInterface;
}
