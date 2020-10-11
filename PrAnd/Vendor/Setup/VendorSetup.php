<?php

namespace PrAnd\Vendor\Setup;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use PrAnd\Vendor\Model\ResourceModel\Vendor as ResourceVendor;
use PrAnd\Vendor\Model\Vendor;

class VendorSetup extends EavSetup
{
    public function getDefaultEntities()
    {
        $entities = [
            Vendor::ENTITY => [
                'entity_model' => ResourceVendor::class,
                'table' => Vendor::ENTITY . '_entity',
                'attributes' => [
                    Vendor::NAME => [
                        'group' => 'General',
                        'type' => 'text',
                        'label' => 'Name',
                        'input' => 'text',
                        'required' => true,
                        'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                        'is_used_in_grid' => true,
                        'is_visible_in_grid' => true,
                        'is_filterable_in_grid' => true,
                        'used_in_product_listing' => true
                    ],
                    Vendor::DESCRIPTION => [
                        'group' => 'General',
                        'type' => 'text',
                        'label' => 'Name',
                        'input' => 'textarea',
                        'required' => false,
                        'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                        'is_used_in_grid' => true,
                        'is_visible_in_grid' => true,
                        'is_filterable_in_grid' => true,
                        'used_in_product_listing' => true
                    ],
                    Vendor::CREATED_AT => [
                        'group' => 'General',
                        'type' => 'static',
                        'input' => 'date',
                        'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                        'is_used_in_grid' => true,
                        'is_visible_in_grid' => true,
                        'is_filterable_in_grid' => true,
                        'visible' => 0,
                        'required' => false
                    ],
                    Vendor::UPDATED_AT => [
                        'group' => 'General',
                        'type' => 'static',
                        'input' => 'date',
                        'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                        'is_used_in_grid' => true,
                        'is_visible_in_grid' => true,
                        'is_filterable_in_grid' => true,
                        'visible' => 0,
                        'required' => false
                    ],
                    Vendor::IMAGE => [
                        'group' => 'General',
                        'type' => 'static',
                        'label' => 'Image',
                        'input' => 'image',
                        'required' => false,
                        'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                        'is_used_in_grid' => true,
                        'is_visible_in_grid' => true,
                        'is_filterable_in_grid' => true
                    ],
                ]
            ]
        ];

        return $entities;
    }
}
