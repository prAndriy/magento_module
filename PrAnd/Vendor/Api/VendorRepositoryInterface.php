<?php

namespace PrAnd\Vendor\Api;

use Magento\Eav\Model\Entity\AbstractEntity;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Model\AbstractExtensibleModel;
use PrAnd\Vendor\Api\Data\VendorInterface as VendorDto;
use PrAnd\Vendor\Model\ResourceModel\Vendor as VendorResource;

interface VendorRepositoryInterface
{
    /**
     * @param int $id
     * @return VendorDto
     */
    public function getById(int $id);

    /**
     * @param SearchCriteria $searchCriteria
     * @return SearchResultsInterface[]
     */
    public function getList(SearchCriteria $searchCriteria);

    /**
     * @param array $ids
     * @return VendorDto[]
     */
    public function getByIds(array $ids);

    /**
     * @param VendorDto|AbstractExtensibleModel $vendor
     * @return VendorResource|AbstractEntity
     */
    public function saveOrUpdate(VendorDto $vendor);

    /**
     * @param VendorDto|AbstractExtensibleModel $vendor
     * @return boolean
     */
    public function delete(VendorDto $vendor);

    /**
     * @param int $id
     * @return boolean
     */
    public function deleteById(int $id);
}
