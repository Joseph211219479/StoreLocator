<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Joseph\StoreLocator\Controller\Adminhtml\Store;

//use Magento\Backend\App\Action;
use Joseph\StoreLocator\Controller\Adminhtml\Store\Store;

/**
 * Class Index
 */
class Index extends Store
{
   // const ADMIN_RESOURCE = 'Joseph_StoreLocator::Store_Locator';

    protected $resultPageFactory = false;

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
