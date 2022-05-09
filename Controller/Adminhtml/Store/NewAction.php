<?php
namespace Joseph\StoreLocator\Controller\Adminhtml\Store;

use Joseph\StoreLocator\Controller\Adminhtml\Store\Store as abstractStore;

class NewAction extends abstractStore
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

        $storeData = $this->getRequest()->getParam('store');
        if (is_array($storeData)) {

            $store = $this->_storeFactory->create();
            $store->save($storeData);

            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
