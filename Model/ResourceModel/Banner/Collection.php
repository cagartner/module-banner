<?php


namespace Redstage\Banner\Model\ResourceModel\Banner;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Redstage\Banner\Model\Banner;
use Redstage\Banner\Model\ResourceModel\Banner as BannerResource;

/**
 * Class Collection
 * @package Redstage\Banner\Model\ResourceModel\Banner
 */
class Collection extends AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            Banner::class,
            BannerResource::class
        );
    }
}
