<?php
namespace Joseph\StoreLocator\Model;

use Magento\Cron\Exception;
use Magento\Framework\Model\AbstractModel;
use Joseph\StoreLocator\Api\Data\StoreInterface;

class Store extends AbstractModel implements StoreInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Store::class);
    }

    /**
     * @inheritDoc
     */
    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setStoreId($storeId)
    {
        $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);

    }

    /**
     * @inheritDoc
     */
    public function setEmail($email)
    {
        $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritDoc
     */
    public function getProvince()
    {
        return $this->getData(self::PROVINCE);
    }

    /**
     * @inheritDoc
     */
    public function setProvince($province)
    {
        return $this->setData(self::PROVINCE, $province);
    }

    /**
     * @inheritDoc
     */
    public function setTelephone($telephone)
    {
        return $this->setData(self::TELEPHONE, $telephone);
    }

    /**
     * @inheritDoc
     */
    public function getTelephone()
    {
        return $this->getData(self::TELEPHONE);
    }
}
