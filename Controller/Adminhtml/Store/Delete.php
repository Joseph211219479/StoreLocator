<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Joseph\StoreLocator\Controller\Adminhtml\Store;

use Joseph\StoreLocator\Api\StoreRepositoryInterface;
use Joseph\StoreLocator\Model\StoreFactory;


use Magento\Framework\App\Action\HttpDeleteActionInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\CsrfAwareActionInterface;

use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;
use Joseph\StoreLocator\Controller\Adminhtml\Store\Store as abstractStore;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Phrase;


class Delete extends abstractStore implements HttpGetActionInterface, CsrfAwareActionInterface
{
    protected $storeRepository;

    public function __construct(Context $context, StoreRepositoryInterface $storeRepository){
        $this->storeRepository = $storeRepository;

        parent::__construct($context);
    }

    /**
     * @return void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $this->storeRepository->deleteById($id);

                $this->messageManager->addSuccessMessage(__('You deleted the store.'));
                $this->_redirect(parent::ROUTE_FRONTNAME.'/*/');
                return;
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('We can\'t delete this store right now. Please review the log and try again.')
                );
                $this->_objectManager->get(\Psr\Log\LoggerInterface::class)->critical($e);
                $this->_redirect(parent::ROUTE_FRONTNAME.'/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a store to delete.'));

        $this->_redirect(parent::ROUTE_FRONTNAME.'/*/');
    }

    /**
     * @inheritDoc
     */
    public function createCsrfValidationException(RequestInterface $request): ?InvalidRequestException
    {
        //todo fix this method , not backwards compatable
        //https://magento.stackexchange.com/questions/253414/magento-2-3-upgrade-breaks-http-post-requests-to-custom-module-endpoint
        return null;
    }

    /**
     * @inheritDoc
     */
    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return true;
    }
}
