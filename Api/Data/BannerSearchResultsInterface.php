<?php


namespace Redstage\Banner\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;
use Redstage\Banner\Api\Data\BannerInterface;

interface BannerSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get Banner list.
     * @return BannerInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param BannerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
