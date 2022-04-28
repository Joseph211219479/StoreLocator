<?php
namespace Joseph\StoreLocator\Model;

use Magento\Cron\Exception;
use Magento\Framework\Model\AbstractModel;

class Store extends AbstractModel
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime
     */
    protected $_dateTime;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Joseph\StoreLocator\Model\ResourceModel\Store::class);
    }

}
