<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Joseph\StoreLocator\Controller\Adminhtml\Store;

use Joseph\StoreLocator\Api\StoreRepositoryInterfaceFactory;
use Joseph\StoreLocator\Controller\Adminhtml\Store\Store as abstractStore;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 */
class Index extends abstractStore
{
    protected $resultPageFactory = false;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
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
