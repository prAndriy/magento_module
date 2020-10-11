<?php

namespace PrAnd\Vendor\Setup;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetup;
use PrAnd\Vendor\Model\Entity\Attribute\Source\AvailableVendors;
use PrAnd\Vendor\Model\Vendor;

class InstallData implements InstallDataInterface
{
    /** @var VendorSetupFactory $vendorSetup */
    protected $vendorSetupFactory;

    public function __construct(
        VendorSetupFactory $vendorSetupFactory
    ) {
        $this->vendorSetupFactory = $vendorSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var VendorSetup|EavSetup $vendorSetup */
        $vendorSetup = $this->vendorSetupFactory->create([
            'setup' => $setup
        ]);
        $vendorSetup->installEntities();

        $vendorSetup->addAttribute(Product::ENTITY, Vendor::ENTITY, [
            'group' => 'General',
            'label' => 'Vendor',
            'type' => 'text',
            'input' => 'multiselect',
            'source' => AvailableVendors::class,
            'required' => false,
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'used_in_product_listing' => true,
            'is_used_in_grid' => true,
            'is_visible_in_grid' => true,
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'backend' => ArrayBackend::class
        ]);
    }
}
