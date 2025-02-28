<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Joseph\StoreLocator\Controller\Adminhtml\Store;

use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Request\DataPersistorInterface;
use Joseph\StoreLocator\Controller\Adminhtml\Store\Store as abstractStore;
use Joseph\StoreLocator\Api\StoreRepositoryInterface;
use Joseph\StoreLocator\Model\StoreFactory;

/**
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Save extends abstractStore implements HttpPostActionInterface
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    protected $storeRepository;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param StoreFactory $storeFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        StoreFactory $storeFactory,
        StoreRepositoryInterface $storeRepository
    ) {
        parent::__construct($context);

        $this->dataPersistor = $dataPersistor;
        $this->storeRepository = $storeRepository;

        $this->_storeFactory = $storeFactory;
        if(!isset($this->_model)){
            $this->_model = $storeFactory->create([]);
        }
    }

    /**
     * Execute save action from store
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        if ($this->getRequest()->getPostValue()) {

            try {
                $data = $this->getRequest()->getPostValue();
                $this->setStoreModelData($data);

                $this->dataPersistor->set('storelocator_store', $data);

                $this->storeRepository->save($this->_model);

                $this->messageManager->addSuccessMessage(__('You saved the store.'));
                $this->_objectManager->get(\Magento\Backend\Model\Session::class)->setPageData(false);
                $this->dataPersistor->clear('storelocator_store');

                $this->_redirect(parent::ROUTE_FRONTNAME.'/*/');

                return;
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('Something went wrong while saving the store data. Please review the error log.')
                );
                $this->_objectManager->get(\Psr\Log\LoggerInterface::class)->critical($e);
                $this->_objectManager->get(\Magento\Backend\Model\Session::class)->setPageData($data);
                $this->dataPersistor->set('storelocator_store', $data);
                $this->_redirect(parent::ROUTE_FRONTNAME.'/*/edit', ['id' => $this->getRequest()->getParam('store_id')]);
                return;
            }
        }
        $this->_redirect(parent::ROUTE_FRONTNAME.'/*/');
    }

    /**
     * @param $data
     * @return void
     */
    private function setStoreModelData($data){
        if(isset($data['store'])){
            if(isset($data['store']['joseph_storelocator_id'])){
                if($data['store']['joseph_storelocator_id'] != ""){
                    $this->_model->setStoreId($data['store']["joseph_storelocator_id"]);
                }
            }
            $this->_model->setName($data['store']["name"]);
            $this->_model->setEmail($data['store']["email"]);
            $this->_model->setTelephone($data['store']["telephone"]);
            $this->_model->setProvince($data['store']["province"]);
        }
    }
}
