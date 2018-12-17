<?php


namespace Redstage\Banner\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Redstage\Banner\Api\Data\BannerExtensionInterface;
use Redstage\Banner\Api\Data\BannerInterface;

class Banner extends AbstractExtensibleObject implements BannerInterface
{

    /**
     * Get banner_id
     * @return string|null
     */
    public function getBannerId()
    {
        return $this->_get(self::BANNER_ID);
    }

    /**
     * Set banner_id
     * @param string $bannerId
     * @return BannerInterface
     */
    public function setBannerId($bannerId)
    {
        return $this->setData(self::BANNER_ID, $bannerId);
    }

    /**
     * Get name
     * @return string|null
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return BannerInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return BannerExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param BannerExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        BannerExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get banner
     * @return string|null
     */
    public function getBanner()
    {
        return $this->_get(self::BANNER);
    }

    /**
     * Set banner
     * @param string $banner
     * @return BannerInterface
     */
    public function setBanner($banner)
    {
        return $this->setData(self::BANNER, $banner);
    }

    /**
     * Get status
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return BannerInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get position
     * @return string|null
     */
    public function getPosition()
    {
        return $this->_get(self::POSITION);
    }

    /**
     * Set position
     * @param string $position
     * @return BannerInterface
     */
    public function setPosition($position)
    {
        return $this->setData(self::POSITION, $position);
    }
}
