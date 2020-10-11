<?php

namespace PrAnd\Vendor\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Magento\Framework\DataObject\IdentityInterface;
use PrAnd\Vendor\Api\Data\VendorInterface;
use PrAnd\Vendor\Model\ResourceModel\Vendor as ResourceVendor;

class Vendor extends AbstractExtensibleModel implements IdentityInterface, VendorInterface
{
    /** @var string  */
    const CACHE_TAG = 'vendor_cache_';

    /**
     * {@inheritdoc}
     */
    protected $_idFieldName = 'entity_id';

    /** @var string  */
    protected $_eventPrefix = 'prand_vendor';

    public function _construct()
    {
        $this->_init(
            ResourceVendor::class
        );
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        $identity = [self::CACHE_TAG . $this->getId()];
        return $identity;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param string $name
     * @return $this|Vendor
     */
    public function setName($name)
    {
        $this->setData(self::NAME, $name);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {
        return $this->getData(static::DESCRIPTION);
    }

    /**
     * @param string $description
     * @return $this|Vendor
     */
    public function setDescription($description)
    {
        $this->setData(static::DESCRIPTION, $description);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getImage()
    {
        return $this->getData(static::IMAGE) ?? '';
    }

    /**
     * @param string $image
     * @return $this|Vendor
     */
    public function setImage($image)
    {
        $this->setData(static::IMAGE, $image);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {
        return $this->getData(static::CREATED_AT);
    }

    /**
     * @param string $createdAt
     * @return $this|Vendor
     */
    public function setCreatedAt($createdAt)
    {
        $this->setData(static::CREATED_AT, $createdAt);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt()
    {
        return $this->getData(static::UPDATED_AT);
    }

    /**
     * @param string $updatedAt
     * @return $this|Vendor
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->setData(static::UPDATED_AT, $updatedAt);
        return $this;
    }

    protected function getCustomAttributesCodes()
    {
        $this->customAttributesCodes = static::ATTRIBUTES;
        return $this->customAttributesCodes;
    }
}
