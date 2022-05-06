<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Joseph\StoreLocator\Controller\Adminhtml\Store;

use Joseph\StoreLocator\Api\StoreRepositoryInterfaceFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Joseph\StoreLocator\Controller\Adminhtml\Store\Store as abstractStore;
use Magento\Framework\App\Request\DataPersistorInterface;
use Joseph\StoreLocator\Model\StoreFactory;


class Edit extends abstractStore implements HttpGetActionInterface
{
    protected $adminSession;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param StoreFactory $storeFactory
     */
    public function __construct(
        Context $context,
        StoreFactory $storeFactory,
        \Magento\Backend\Model\Auth\SessionFactory $adminSession
    ) {
        parent::__construct($context);

        $this->_storeFactory = $storeFactory;
        if(!isset($this->_model)){
            $this->_model = $storeFactory->create([]);//$this->_objectManager->create(\Joseph\StoreLocator\Model\Store::class);
        }

        $this->adminSession = $adminSession;
    }

    /**
     * @return void
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = $this->getRequest()->getParam('id');

        /** @var \Joseph\StoreLocator\Api\StoreRepositoryInterface $storeRepository */
        $storeRepository = $this->_storeFactory->create();

        if ($id) {
            try {
                //does not work because get returns a array
               // $this->_model = $storeRepository->get($id);
            } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
                $this->messageManager->addErrorMessage(__('This store no longer exists.'));
                $this->_redirect(parent::ROUTE_FRONTNAME.'/*');
                return;
            }
        }

        // set entered data if was error when we do save
        //todo get it to work with the factory
        //$this->adminSession->create()
        // $data = $this->adminSession->getPageData(true);
        $data = $this->_objectManager->get(\Magento\Backend\Model\Session::class)->getPageData(true);

        if (!empty($data)) {
            $this->_model->addData($data);
        }

        $this->_initAction();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Store Locator: Store'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend(
            $this->_model->getStoreId() ? $this->_model->getName() : __('Update Store')
        );

        $breadcrumb = $id ? __('Edit Store') : __('New Store');
        $this->_addBreadcrumb($breadcrumb, $breadcrumb);
        $this->_view->renderLayout();
    }
}
