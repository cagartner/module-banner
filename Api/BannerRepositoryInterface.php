<?php


namespace Redstage\Banner\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Redstage\Banner\Api\Data\BannerInterface;
use Redstage\Banner\Api\Data\BannerSearchResultsInterface;

interface BannerRepositoryInterface
{

    /**
     * Save Banner
     * @param BannerInterface $banner
     * @return BannerInterface
     * @throws LocalizedException
     */
    public function save(
        BannerInterface $banner
    );

    /**
     * Retrieve Banner
     * @param string $bannerId
     * @return BannerInterface
     * @throws LocalizedException
     */
    public function getById($bannerId);

    /**
     * Retrieve Banner matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return BannerSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Banner
     * @param BannerInterface $banner
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(
        BannerInterface $banner
    );

    /**
     * Delete Banner by ID
     * @param string $bannerId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($bannerId);
}
