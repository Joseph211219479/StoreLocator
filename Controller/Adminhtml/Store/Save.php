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

/**
 * Save action for catalog rule
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Save extends abstractStore implements HttpPostActionInterface
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Execute save action from catalog rule
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        if ($this->getRequest()->getPostValue()) {

            /** @var \Joseph\StoreLocator\Api\StoreRepositoryInterface $storeRepository */
            $storeRepository = $this->_storeFactory->create();

            try {
                $data = $this->getRequest()->getPostValue();

                $id = $this->getRequest()->getParam('store_id');
                if ($id) {
                    $this->_model = $storeRepository->get($id);
                }

                /*todo: how does validatorData work ?*/
                $validateResult = $this->_model->validateData(new \Magento\Framework\DataObject($data));
                if ($validateResult !== true) {
                    foreach ($validateResult as $errorMessage) {
                        $this->messageManager->addErrorMessage($errorMessage);
                    }
                    $this->_getSession()->setPageData($data);
                    $this->dataPersistor->set('storelocator_store', $data);
                    $this->_redirect(parent::ROUTE_FRONTNAME.'/*/edit', ['id' => $this->_model->getId()]);
                    return;
                }

                if (isset($data['store'])) {
                    //why
                   //unset($data['store']);
                }

                $this->_model->loadPost($data);

                $this->_session()->setPageData($data);
                //$this->_objectManager->get(\Magento\Backend\Model\Session::class)->setPageData($data);
                $this->dataPersistor->set('storelocator_store', $data);

                $storeRepository->save($this->_model);

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
}
