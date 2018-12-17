<?php


namespace Redstage\Banner\Block;

use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Phrase;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Redstage\Banner\Api\Data\BannerSearchResultsInterface;
use Redstage\Banner\Model\BannerRepository;

/**
 * Class Banner
 * @package Redstage\Banner\Block
 */
class Banner extends Template
{
    /**
     * @var string Default template
     */
    protected $_template = 'Redstage_Banner::banner.phtml';

    /**
     * @var BannerRepository
     */
    protected $bannerRepository;

    /**
     * @var FilterProvider
     */
    protected $filterProvider;

    /**
     * Banner constructor.
     * @param Context $context
     * @param BannerRepository $bannerRepository
     * @param array $data
     */
    public function __construct(
        Context $context,
        BannerRepository $bannerRepository,
        FilterProvider $filterProvider,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->bannerRepository = $bannerRepository;
        $this->filterProvider = $filterProvider;
    }

    /**
     * @return null|string
     * @throws \Exception
     */
    public function getBanner()
    {
        if ($position = $this->getData('position')) {

            /** @var \Magento\Framework\Api\SearchResults $searchResult */
            $searchResult = $this->bannerRepository->getListByPosition($position);

            if ($searchResult->getTotalCount()) {
                $banner = $searchResult->getItems()[0];
                return $this->filterProvider->getBlockFilter()->filter($banner->getBanner());
            }
        }
        return null;
    }
}
