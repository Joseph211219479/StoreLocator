<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Joseph\StoreLocator\Controller\Adminhtml\Store;

//use Magento\Backend\App\Action;
use Joseph\StoreLocator\Api\StoreRepositoryInterfaceFactory;
use Joseph\StoreLocator\Controller\Adminhtml\Store\Store as abstractStore;

/**
 * Class Index
 */
class Index extends abstractStore
{
   // const ADMIN_RESOURCE = 'Joseph_StoreLocator::Store_Locator';

    protected $resultPageFactory = false;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Store Locator')));

        return $resultPage;
    }
}
