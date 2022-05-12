<?php
/** @noinspection PhpDeprecationInspection */

/*todo fix depricated, suppresed to test*/
namespace Joseph\StoreLocator\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Store extends Action
{
    /** @var  Page */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    /**
     *
     * @return PageFactory
     */
    public function execute()
    {
        /*todo load the specific store page*/
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Store view'));
        return $resultPage;
    }
}
