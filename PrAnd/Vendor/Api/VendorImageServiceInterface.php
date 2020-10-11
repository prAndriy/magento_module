<?php

namespace PrAnd\Vendor\Api;

interface VendorImageServiceInterface
{
    /** @var string  */
    const BASE_TMP_PATH = 'prand/vendors/images';

    /** @var string[]  */
    const ALLOWED_TYPES = [
        'jpg' => 'image/jpg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'png' => 'image/png'
    ];

    /**
     * @param string|null $imageName
     * @return string|void
     */
    public function getFullPathToImage(string $imageName);

    /**
     * @param string|void $imageName
     * @return string
     */
    public function getUrl($imageName);

    /**
     * @param string|null $imageName
     * @return array
     */
    public function getPreparedData($imageName);
}
