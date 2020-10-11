<?php

namespace PrAnd\Vendor\Model\ResourceModel\Vendor\Grid;

use Magento\Eav\Model\Entity\Collection\AbstractCollection;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\Search\AggregationInterface;
use PrAnd\Vendor\Api\Data\VendorInterface;
use PrAnd\Vendor\Model\ResourceModel\Vendor as ResourceVendor;
use PrAnd\Vendor\Model\Vendor;
use Magento\Framework\Api\Search\SearchResultInterface;

class Collection extends AbstractCollection implements SearchResultInterface
{
    /** @var AggregationInterface */
    protected $aggregations;
    protected $searchCriteria;

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

        $this->addAttributeToSelect('*');
    }

    /**
     * @return SearchCriteriaInterface
     */
    public function getSearchCriteria()
    {
        return $this->searchCriteria;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return $this|Collection
     */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria)
    {
        $this->searchCriteria = $searchCriteria;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * @param int $totalCount
     * @return $this|Collection
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * @param array|null $items
     * @return $this|Collection
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function setItems(?array $items = null)
    {
        if (!empty($items)) {
            /** @var VendorInterface $item */
            foreach ($items as $item) {
                $this->addItem($item);
            }
        }

        return $this;
    }

    /**
     * @return AggregationInterface
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /**
     * @param AggregationInterface $aggregations
     * @return $this|Collection
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
        return $this;
    }
}
