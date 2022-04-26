<?php
namespace Joseph\StoreLocator\Controller\Adminhtml\Store;

use Magento\Backend\App\Action;
use Joseph\StoreLocator\Model\Store as Store;

class NewAction extends Action
{

    protected $_storeFactory;

    protected function _construct(\Joseph\StoreLocator\Api\StoreRepositryInterface  $storeFactory){
        $this->_storeFactory = $storeFactory;
    }


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

        //todo use factory
        $storetData = $this->getRequest()->getParam('store');
        if (is_array($storetData)) {
            //$store = $this->_objectManager->create(Store::class);
            //$store->setData($storetData)->save();/*todo */

            $store = $this->_storeFactory->create();
            $store->save($storetData);/*todo debug*/

            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
