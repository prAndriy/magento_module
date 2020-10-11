<?php

namespace PrAnd\Vendor\Model;

use Magento\Eav\Model\Api\SearchCriteria\CollectionProcessor\FilterProcessor;
use Magento\Eav\Model\Entity\AbstractEntity;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Model\AbstractExtensibleModel;

use PrAnd\Vendor\Api\Data\VendorCollectionInterface;
use PrAnd\Vendor\Api\Data\VendorCollectionInterfaceFactory;
use PrAnd\Vendor\Api\Data\VendorInterface as VendorDto;
use PrAnd\Vendor\Api\VendorRepositoryInterface;
use PrAnd\Vendor\Model\ResourceModel\Vendor as VendorResource;
use PrAnd\Vendor\Model\ResourceModel\Vendor\Collection as VendorCollection;

class VendorRepository implements VendorRepositoryInterface
{
    /** @var VendorFactory  */
    protected $vendorFactory;

    /** @var VendorResource  */
    protected $vendorResource;

    /** @var CollectionProcessorInterface  */
    protected $collectionProcessor;

    /** @var SearchCriteriaBuilder  */
    protected $searchCriteriaBuilder;

    /** @var VendorCollectionInterfaceFactory  */
    protected $vendorCollectionInterfaceFactory;

    /** @var SearchResultsInterfaceFactory  */
    protected $searchResultFactory;

    /** @var FilterProcessor  */
    protected $filterProcessor;

    /**
     * VendorRepository constructor.
     *
     * @param VendorResource $vendorResource
     * @param VendorFactory $vendorFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param VendorCollectionInterfaceFactory $vendorCollectionInterfaceFactory
     * @param SearchResultsInterfaceFactory $searchResultFactory
     * @param FilterProcessor $filterProcessor
     */
    public function __construct(
        VendorResource $vendorResource,
        VendorFactory $vendorFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        VendorCollectionInterfaceFactory $vendorCollectionInterfaceFactory,
        SearchResultsInterfaceFactory $searchResultFactory,
        FilterProcessor $filterProcessor
    ) {
        $this->vendorResource = $vendorResource;
        $this->vendorFactory = $vendorFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->vendorCollectionInterfaceFactory = $vendorCollectionInterfaceFactory;
        $this->searchResultFactory = $searchResultFactory;
        $this->filterProcessor = $filterProcessor;
    }

    /**
     * @param int $id
     * @return VendorDto
     */
    public function getById(int $id)
    {
        /** @var VendorDto|AbstractExtensibleModel $vendorDto */
        $vendorDto = $this->vendorFactory->create();
        $this->vendorResource->load($vendorDto, $id);

        return $vendorDto;
    }

    /**
     * {@inheritDoc}
     */
    public function getList(SearchCriteria $searchCriteria)
    {
        /** @var VendorCollectionInterface|VendorCollection $vendorCollection */
        $vendorCollection = $this->vendorCollectionInterfaceFactory->create();
        $vendorCollection->addAttributeToSelect('*');
        $this->filterProcessor->process($searchCriteria, $vendorCollection);

        /** @var SearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($vendorCollection->getItems());
        $searchResult->setTotalCount($vendorCollection->getSize());

        return $searchResult;
    }

    /**
     * {@inheritDoc}
     */
    public function getByIds(array $ids)
    {
        $result = [];

        if (!empty($ids)) {
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter('entity_id', $ids, 'in')
                ->create();
            $result = $this->getList($searchCriteria)->getItems();
        }

        return $result;
    }

    /**
     * @param Vendor $vendor
     * @return AbstractEntity|VendorResource
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function saveOrUpdate(VendorDto $vendor)
    {
        // update
        if (!empty($vendor->getId())) {
            /** @var Vendor $vendorToUpdate */
            $vendorToUpdate = $this->getById($vendor->getId());
            $vendorToUpdate->setData($vendor->getData());
            return $this->vendorResource->save($vendorToUpdate);
        }

        return $this->vendorResource->save($vendor);
    }

    /**
     * @param Vendor $vendor
     * @return bool
     * @throws \Exception
     */
    public function delete(VendorDto $vendor)
    {
        /** @var AbstractEntity|VendorResource $vendorResource */
        $this->vendorResource->delete($vendor);
        return $vendor->isDeleted();
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function deleteById(int $id)
    {
        /** @var VendorDto|AbstractExtensibleModel $vendorDto */
        $vendorDto = $this->vendorFactory->create();
        $this->vendorResource->load($vendorDto, $id);

        return $this->delete($vendorDto);
    }
}
