<?php

namespace PrAnd\Vendor\Plugin\Vendor;

use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Model\AbstractExtensibleModel;

use PrAnd\Vendor\Api\Data\VendorInterface;
use PrAnd\Vendor\Api\VendorImageServiceInterface;

class VendorAfterSavePlugin
{
    /**
     * @var File
     */
    protected $driverFile;

    /** @var VendorImageServiceInterface  */
    protected $vendorImage;

    public function __construct(
        File $driverFile,
        VendorImageServiceInterface $image
    ) {
        $this->driverFile = $driverFile;
        $this->vendorImage = $image;
    }

    public function beforeAfterSave(VendorInterface $vendor)
    {
        /** @var AbstractExtensibleModel|VendorInterface $vendor */
        $prevData = $vendor->getOrigData();
        $prevImage = $prevData['image'];
        $currentImage = $vendor->getImage();

        if (!empty($prevImage)) {
            if ($prevImage != $currentImage) {
                $fullPathToPrevImage = $this->vendorImage->getFullPathToImage($prevImage);

                if (!empty($fullPathToPrevImage)) {
                    $this->driverFile->deleteFile($fullPathToPrevImage);
                }
            }
        }
    }
}
