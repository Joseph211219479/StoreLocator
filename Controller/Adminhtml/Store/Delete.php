<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Joseph\StoreLocator\Controller\Adminhtml\Store;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Backend\App\Action;


class Delete extends Action implements HttpPostActionInterface
{
    protected $_storeFactory;

    protected function _construct(\Joseph\StoreLocator\Api\StoreRepositryInterfaceFactory  $storeFactory){
        $this->_storeFactory = $storeFactory;
    }

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
                $this->_redirect('catalog_rule/*/');
                return;
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('We can\'t delete this rule right now. Please review the log and try again.')
                );
                $this->_objectManager->get(\Psr\Log\LoggerInterface::class)->critical($e);
                $this->_redirect('catalog_rule/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a rule to delete.'));

        $this->_redirect('*/*/');
    }
}
