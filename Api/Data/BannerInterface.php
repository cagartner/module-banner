<?php


namespace Redstage\Banner\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface BannerInterface extends ExtensibleDataInterface
{

    const NAME = 'name';
    const BANNER_ID = 'banner_id';
    const POSITION = 'position';
    const STATUS = 'status';
    const BANNER = 'banner';

    /**
     * Get banner_id
     * @return string|null
     */
    public function getBannerId();

    /**
     * Set banner_id
     * @param string $bannerId
     * @return BannerInterface
     */
    public function setBannerId($bannerId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return BannerInterface
     */
    public function setName($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return BannerExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param BannerExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        BannerExtensionInterface $extensionAttributes
    );

    /**
     * Get banner
     * @return string|null
     */
    public function getBanner();

    /**
     * Set banner
     * @param string $banner
     * @return BannerInterface
     */
    public function setBanner($banner);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return BannerInterface
     */
    public function setStatus($status);

    /**
     * Get position
     * @return string|null
     */
    public function getPosition();

    /**
     * Set position
     * @param string $position
     * @return BannerInterface
     */
    public function setPosition($position);
}
