<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Joseph\StoreLocator\Controller\Adminhtml\Store;

use Magento\Backend\App\Action;

/**
 * Class Index
 */
class Index extends Action
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Joseph_StoreLocator::Store_Locator';

    /**
     * Index action
     *
     * @return void
     */
    public function execute(): void
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
