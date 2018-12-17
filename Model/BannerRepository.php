<?php


namespace Redstage\Banner\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Redstage\Banner\Api\Data\BannerInterface;
use Redstage\Banner\Api\Data\BannerSearchResultsInterface;
use Redstage\Banner\Model\ResourceModel\Banner\CollectionFactory as BannerCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Redstage\Banner\Model\ResourceModel\Banner as ResourceBanner;
use Redstage\Banner\Api\Data\BannerInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Redstage\Banner\Api\Data\BannerSearchResultsInterfaceFactory;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Redstage\Banner\Api\BannerRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;

/**
 * Class BannerRepository
 * @package Redstage\Banner\Model
 */
class BannerRepository implements BannerRepositoryInterface
{

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var ExtensibleDataObjectConverter
     */
    protected $extensibleDataObjectConverter;

    /**
     * @var BannerInterfaceFactory
     */
    protected $dataBannerFactory;

    /**
     * @var JoinProcessorInterface
     */
    protected $extensionAttributesJoinProcessor;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var BannerFactory
     */
    protected $bannerFactory;

    /**
     * @var ResourceBanner
     */
    protected $resource;

    /**
     * @var BannerCollectionFactory
     */
    protected $bannerCollectionFactory;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var BannerSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;


    /**
     * @param ResourceBanner $resource
     * @param BannerFactory $bannerFactory
     * @param BannerInterfaceFactory $dataBannerFactory
     * @param BannerCollectionFactory $bannerCollectionFactory
     * @param BannerSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceBanner $resource,
        BannerFactory $bannerFactory,
        BannerInterfaceFactory $dataBannerFactory,
        BannerCollectionFactory $bannerCollectionFactory,
        BannerSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->resource = $resource;
        $this->bannerFactory = $bannerFactory;
        $this->bannerCollectionFactory = $bannerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataBannerFactory = $dataBannerFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Save banner
     *
     * @param BannerInterface $banner
     * @return BannerInterface
     * @throws CouldNotSaveException
     */
    public function save(
        BannerInterface $banner
    ) {
        $bannerData = $this->extensibleDataObjectConverter->toNestedArray(
            $banner,
            [],
            BannerInterface::class
        );
        
        $bannerModel = $this->bannerFactory->create()->setData($bannerData);
        
        try {
            $this->resource->save($bannerModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the banner: %1',
                $exception->getMessage()
            ));
        }
        return $bannerModel->getDataModel();
    }

    /**
     * Load Banner by ID
     * @param string $bannerId
     * @return BannerInterface
     * @throws NoSuchEntityException
     */
    public function getById($bannerId)
    {
        $banner = $this->bannerFactory->create();
        $this->resource->load($banner, $bannerId);
        if (!$banner->getId()) {
            throw new NoSuchEntityException(__('Banner with id "%1" does not exist.', $bannerId));
        }
        return $banner->getDataModel();
    }

    /**
     * Get list of banners
     * @param SearchCriteriaInterface $criteria
     * @return BannerSearchResultsInterface
     */
    public function getList(
        SearchCriteriaInterface $criteria
    ) {
        $collection = $this->bannerCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            BannerInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @param null $position
     * @return BannerSearchResultsInterface
     */
    public function getListByPosition($position=null)
    {
        // Filter active and by position
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('status', 1)
        ->addFilter('position', $position)->create();

        return $this->getList($searchCriteria);
    }

    /**
     * Delete Banner
     *
     * @param BannerInterface $banner
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(
        BannerInterface $banner
    ) {
        try {
            $bannerModel = $this->bannerFactory->create();
            $this->resource->load($bannerModel, $banner->getBannerId());
            $this->resource->delete($bannerModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Banner: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * Delete Banner by ID
     *
     * @param string $bannerId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($bannerId)
    {
        return $this->delete($this->getById($bannerId));
    }
}
