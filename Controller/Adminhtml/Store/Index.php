<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Joseph\StoreLocator\Controller\Adminhtml\Store;

//todo : add to module sequence
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 */
class Index extends Action implements HttpGetActionInterface
{
    const MENU_ID = 'Joseph_StoreLocator::Store_Locator';

    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Joseph_StoreLocator::Store_Locator';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Load the page defined in view/adminhtml/layout/storelocator_store_index.xml
     *
     * @return Page
     */
    public function execute(): Page
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(static::MENU_ID);
        $resultPage->getConfig()->getTitle()->prepend(__('Hello World'));

        return $resultPage;
    }
}
