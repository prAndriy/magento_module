<?php

namespace PrAnd\Vendor\Block\Adminhtml\Vendor\Edit;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Framework\UrlInterface;

class DeleteButton implements ButtonProviderInterface
{
    const REQUEST_FIELD_NAME = 'id';

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    public function __construct(
        RequestInterface $request,
        UrlInterface $urlBuilder
    ) {
        $this->request = $request;
        $this->urlBuilder = $urlBuilder;
    }

    public function getButtonData()
    {
        $data = [];
        $id = $this->request->getParam(static::REQUEST_FIELD_NAME);

        if (!empty($id)) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\''
                    . __('Are you sure you want to delete this vendor?')
                    . '\', \'' . $this->getDeleteUrl($id) . '\', {data: {}})',
                'sort_order' => 20,
            ];
        }

        return $data;
    }

    /**
     * @param $carId
     * @return mixed
     */
    public function getDeleteUrl(int $id)
    {
        return $this->urlBuilder->getUrl('*/*/delete', [
            static::REQUEST_FIELD_NAME => $id
        ]);
    }
}
