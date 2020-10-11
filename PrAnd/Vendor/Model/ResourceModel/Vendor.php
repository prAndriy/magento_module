<?php

namespace PrAnd\Vendor\Model\ResourceModel;

use Magento\Eav\Model\Entity\AbstractEntity;
use PrAnd\Vendor\Model\Vendor as VendorModel;

class Vendor extends AbstractEntity
{
    /**
     * {@inheritDoc}
     */
    protected $_entityIdField = VendorModel::ID;

    /**
     * @return \Magento\Eav\Model\Entity\Type
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getEntityType()
    {
        if (empty($this->_type)) {
            $this->setType(VendorModel::ENTITY);
        }

        return parent::getEntityType();
    }
}
