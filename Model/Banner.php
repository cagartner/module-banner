<?php


namespace Redstage\Banner\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Redstage\Banner\Api\Data\BannerInterface;
use Redstage\Banner\Api\Data\BannerInterfaceFactory;
use Redstage\Banner\Model\ResourceModel\Banner\Collection;

/**
 * Class Banner
 * @package Redstage\Banner\Model
 */
class Banner extends AbstractModel
{

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;
    /**
     * @var string
     */
    protected $_eventPrefix = 'redstage_banner';
    /**
     * @var BannerInterfaceFactory
     */
    protected $bannerDataFactory;


    /**
     * @param Context $context
     * @param Registry $registry
     * @param BannerInterfaceFactory $bannerDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param ResourceModel\Banner $resource
     * @param Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        BannerInterfaceFactory $bannerDataFactory,
        DataObjectHelper $dataObjectHelper,
        ResourceModel\Banner $resource,
        Collection $resourceCollection,
        array $data = []
    ) {
        $this->bannerDataFactory = $bannerDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve banner model with banner data
     * @return BannerInterface
     */
    public function getDataModel()
    {
        $bannerData = $this->getData();
        
        $bannerDataObject = $this->bannerDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $bannerDataObject,
            $bannerData,
            BannerInterface::class
        );
        
        return $bannerDataObject;
    }
}
