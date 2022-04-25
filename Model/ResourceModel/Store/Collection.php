<?php

namespace Joseph\StoreLocator\Model\ResourceModel\Store;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(Joseph\StoreLocator\Model\Store::class, Joseph\StoreLocator\Model\ResourceModel\Store::class);
    }
}
