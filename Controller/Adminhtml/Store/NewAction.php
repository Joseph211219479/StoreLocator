<?php
namespace Joseph\StoreLocator\Controller\Adminhtml\Store;
use Magento\Backend\App\Action;
use Joseph\StoreLocator\Model\Store as Store;

class NewAction extends Action
{
    /**
     * Edit A Store Page
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        $storetData = $this->getRequest()->getParam('store');
        if (is_array($storetData)) {
            $contact = $this->_objectManager->create(Store::class);
            $contact->setData($storetData)->save();/*todo */
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
