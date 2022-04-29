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
        $this->_init(\Joseph\StoreLocator\Model\ResourceModel\Store::class);
    }

    /**
     * @inheritDoc
     */
    public function getStoreId()
    {
        return $this->getData(self::RULE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setStoreId($storeId)
    {
        $this->setData(self::RULE_ID, $storeId);
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
     * @inheritdoc
     */
    public function validateData(DataObject $dataObject)
    {
        $result = parent::validateData($dataObject);
        if ($result === true) {
            $result = [];
        }

        $action = $dataObject->getData('simple_action');
        $discount = $dataObject->getData('discount_amount');
        $result = array_merge($result, $this->validateDiscount($action, $discount));

        return !empty($result) ? $result : true;
    }
}
