<?php

namespace Joseph\StoreLocator\Controller\Adminhtml\Store;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Joseph\StoreLocator\Api\StoreRepositoryInterfaceFactory;

abstract class Store extends Action {
    const ROUTE_FRONTNAME = "storelocator";
    const ADMIN_RESOURCE = 'Joseph_StoreLocator::Store_Locator';

    protected $_storeFactory;
    protected $_model;

    public function __construct(Context $context){
        parent::__construct($context);
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
