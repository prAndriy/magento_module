<?php

namespace PrAnd\Vendor\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

use PrAnd\Vendor\Api\Data\VendorInterface;
use PrAnd\Vendor\Api\Data\VendorInterfaceFactory;
use PrAnd\Vendor\Api\VendorRepositoryInterface;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var VendorRepositoryInterface
     */
    protected $vendorRepository;

    /**
     * @var VendorInterfaceFactory
     */
    protected $vendorDtoFactory;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    public function __construct(
        Context $context,
        VendorRepositoryInterface $vendorRepository,
        VendorInterfaceFactory $vendorDtoFactory,
        DataPersistorInterface $dataPersistor
    ) {
        parent::__construct($context);

        $this->vendorRepository = $vendorRepository;
        $this->vendorDtoFactory = $vendorDtoFactory;
        $this->dataPersistor = $dataPersistor;
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $redirect = $this->resultRedirectFactory->create();
        $post = $this->getRequest()->getParam('vendor');
        $isUpdate = !empty($post[VendorInterface::ID]);

        /** @var VendorInterface|AbstractExtensibleModel $vendorDTO */
        $vendorDTO = $this->vendorDtoFactory->create();
        $this->dataPersistor->set('vendor', $post);
        $post['image'] = $post['image']['0']['name'] ?? '';

        try {
            $vendorDTO->setData($post);
            $this->vendorRepository->saveOrUpdate($vendorDTO);
            $this->messageManager->addSuccessMessage(__('Data saved successfully.'));
            $this->dataPersistor->clear('vendor');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Failed to update data.'));

            if (!$isUpdate) {
                return $redirect->setPath('*/*/addNew');
            }
        }

        return $redirect->setPath('*/*/edit', [
            'id' => $vendorDTO->getId()
        ]);
    }

    /**
     * @return bool
     */
    public function _isAllowed()
    {
        $isAllowed = ($this->_authorization->isAllowed(\PrAnd\Vendor\Controller\Adminhtml\Vendor\Edit::ADMIN_RESOURCE) ||
                    $this->_authorization->isAllowed(\PrAnd\Vendor\Controller\Adminhtml\Vendor\AddNew::ADMIN_RESOURCE));

        return $isAllowed;
    }
}
