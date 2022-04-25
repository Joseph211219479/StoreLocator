<?php

namespace Joseph\StoreLocator\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;


class Store extends AbstractDb
{
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('joseph_storelocator', 'joseph_storelocator_id');
    }
}
