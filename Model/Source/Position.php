<?php

namespace Redstage\Banner\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Position
 * @package Redstage\Banner\Model\Source
 */
class Position implements OptionSourceInterface
{
    /**
     * Menu Top position in Layout
     */
    const MENU_TOP = 'menu_top';
    /**
     * Menu bottom position in layout
     */
    const MENU_BOTTOM = 'menu_bottom';
    /**
     * Content top in layout
     */
    const CONTENT_TOP = 'content_top';
    /**
     * Show page bottom
     */
    const PAGE_BOTTOM = 'page_bottom';

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::MENU_TOP,  'label' => __('Menu Top')],
            ['value' => self::MENU_BOTTOM,  'label' => __('Menu Bottom')],
            ['value' => self::CONTENT_TOP,  'label' => __('Content top')],
            ['value' => self::PAGE_BOTTOM,  'label' => __('Page bottom')]
        ];
    }
}