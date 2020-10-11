<?php

namespace PrAnd\Vendor\Service;

use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\UrlInterface;

use PrAnd\Vendor\Api\VendorImageServiceInterface;

class VendorImageService implements VendorImageServiceInterface
{
    /** @var DirectoryList  */
    protected $directoryList;

    /** @var File  */
    protected $fileSystem;

    /** @var UrlInterface  */
    protected $urlBuilder;

    /**
     * Image constructor.
     * @param DirectoryList $directoryList
     * @param File $fileSystem
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        DirectoryList $directoryList,
        File $fileSystem,
        UrlInterface $urlBuilder
    )
    {
        $this->directoryList = $directoryList;
        $this->fileSystem = $fileSystem;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * {@inheritDoc}
     */
    public function getFullPathToImage($imageName)
    {
        if (!empty($imageName)) {
            $pathToImage = $this->directoryList->getPath('media') . '/' . self::BASE_TMP_PATH . '/' . $imageName;
            $isFileExists = $this->fileSystem->isFile($pathToImage) && $this->fileSystem->isExists($pathToImage);

            if ($isFileExists) {
                return $pathToImage;
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getUrl($imageName)
    {
        $url = '';

        if (!empty($imageName)) {
            $isImageExists = (bool)$this->getFullPathToImage($imageName);

            if ($isImageExists) {
                $url = $this->urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]) . self::BASE_TMP_PATH . '/' . $imageName;
            }
        }

        return $url;
    }

    /**
     * {@inheritDoc}
     */
    public function getPreparedData($imageName)
    {
        $result = [];

        if (!empty($imageName)) {
            $pathToImage = $this->getFullPathToImage($imageName);

            if (!empty($pathToImage)) {
                $result = [
                    'url' => $this->getUrl($imageName),
                    'name' => $imageName,
                    'path' => $pathToImage,
                    'size' => \filesize($pathToImage)
                ];
            }
        }

        return $result;
    }
}
