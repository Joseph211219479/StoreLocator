<?php
namespace Joseph\StoreLocator\Api\Data;

/**
 * @api
 * @since 100.1.0
 */
interface StoreInterface
{
    /**#@+
     * Constants defined for keys of data array
     */
    const STORE_ID = 'joseph_storelocator_id';

    const NAME = 'name';

    const EMAIL = 'email';

    const PROVINCE = 'province';

    const TELEPHONE = 'telephone';

    const IS_ACTIVE = 'is_active';//todo :impl

    /**#@-*/

    /**
     * Returns store id field
     *
     * @return int|null
     * @since 100.1.0
     */
    public function getStoreId();

    /**
     * @param int $storeId
     * @return $this
     * @since 100.1.0
     */
    public function setStoreId($storeId);

    /**
     * Returns store name
     *
     * @return string
     * @since 100.1.0
     */
    public function getName();

    /**
     * @param string $name
     * @return $this
     * @since 100.1.0
     */
    public function setName($name);

    /**
     * Returns store email
     *
     * @return string
     * @since 100.1.0
     */
    public function getEmail();

    /**
     * @param string $email
     * @return $this
     * @since 100.1.0
     */
    public function setEmail($email);

    /**
     * @param $telephone
     * @return mixed
     */
    public function setTelephone($telephone);

    /**
     * @return mixed
     */
    public function getTelephone();


    /**
     * Returns store name
     *
     * @return string
     * @since 100.1.0
     */
    public function getProvince();

    /**
     * @param string $province
     * @return $this
     * @since 100.1.0
     */
    public function setProvince($province);

}
