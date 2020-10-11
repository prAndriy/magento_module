<?php

namespace PrAnd\Vendor\Model\ResourceModel\Vendor;

use Magento\Eav\Model\Entity\Collection\AbstractCollection;

use PrAnd\Vendor\Model\Vendor;
use PrAnd\Vendor\Model\ResourceModel\Vendor as ResourceVendor;

class Collection extends AbstractCollection
{
    /**
     * {@inheritdoc}
     */
    protected $_idFieldName = Vendor::ID;

    public function _construct()
    {
        $this->_init(
            Vendor::class,
            ResourceVendor::class
        );
    }
}
