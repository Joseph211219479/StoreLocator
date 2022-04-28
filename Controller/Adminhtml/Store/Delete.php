<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Joseph\StoreLocator\Controller\Adminhtml\Store;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Exception\LocalizedException;
use Joseph\StoreLocator\Controller\Adminhtml\Store\Store as abstractStore;


class Delete extends abstractStore implements HttpPostActionInterface
{
    /**
     * @return void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $store = $this->_storeFactory->create();
                $store->deleteById($id);

                $this->messageManager->addSuccessMessage(__('You deleted the rule.'));
                $this->_redirect(parent::ROUTE_FRONTNAME.'/*/');
                return;
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('We can\'t delete this rule right now. Please review the log and try again.')
                );
                $this->_objectManager->get(\Psr\Log\LoggerInterface::class)->critical($e);
                $this->_redirect(parent::ROUTE_FRONTNAME.'/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a store to delete.'));

        $this->_redirect(parent::ROUTE_FRONTNAME.'/*/');
    }
}
