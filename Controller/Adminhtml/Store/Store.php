<?php

namespace Joseph\StoreLocator\Controller\Adminhtml\Store;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Joseph\StoreLocator\Api\StoreRepositoryInterfaceFactory;
use Joseph\StoreLocator\Model\StoreFactory;

abstract class Store extends Action {
    const ROUTE_FRONTNAME = "storelocator";
    const ADMIN_RESOURCE = 'Joseph_StoreLocator::Store_Locator';

    protected $_storeFactory;
    protected $_model;

    public function __construct(Context $context){
        parent::__construct($context);
    }

    protected function _construct(StoreFactory  $storeFactory ){
        $this->_storeFactory = $storeFactory;
        if(!isset($this->_model)){
            $this->_model = $storeFactory->create([]);//$this->_objectManager->create(\Joseph\StoreLocator\Model\Store::class);
        }
    }

    /**
     * Init action
     *
     * @return $this
     */
    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            self::ADMIN_RESOURCE
        )->_addBreadcrumb(
            __('Store Locator'),
            __('Store Locator')
        );
        return $this;
    }
}
