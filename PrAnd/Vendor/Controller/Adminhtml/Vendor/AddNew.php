<?php

namespace PrAnd\Vendor\Controller\Adminhtml\Vendor;

use Magento\Framework\App\Action\HttpGetActionInterface;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\Model\View\Result\Page;
use PrAnd\Vendor\Controller\Adminhtml\Index\Index;

class AddNew extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'PrAnd_Vendor::vendors_addNew';

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $page->setActiveMenu(Index::MENU)
            ->getConfig()
            ->getTitle()
            ->prepend(__('Add a new vendor.'));

        return $page;
    }
}
