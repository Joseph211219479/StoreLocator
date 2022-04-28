<?php

namespace Joseph\StoreLocator\Controller\Adminhtml\Store;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Joseph\StoreLocator\Api\StoreRepositoryInterfaceFactory;
use Joseph\StoreLocator\Model\Store as StoreModel;

abstract class Store extends Action {
    const ROUTE_FRONTNAME = "storelocator";
    const ADMIN_RESOURCE = 'Joseph_StoreLocator::Store_Locator';

    protected $_storeFactory;
    protected $_model;

    public function __construct(Context $context){
        parent::__construct($context);
    }

    protected function _construct(StoreRepositoryInterfaceFactory  $storeFactory ){
        $this->_storeFactory = $storeFactory;
        if(!isset($this->_model)){
            $this->_model = $this->_objectManager->create(\Joseph\StoreLocator\Model\Store::class);
        }
    }
}
