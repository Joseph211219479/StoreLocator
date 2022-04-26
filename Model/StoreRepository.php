<?php

use Joseph\StoreLocator\Api\StoreRepositoryInterface;

class StoreRepository implements StoreRepositoryInterface
{

    /**
     * @var ResourceModel\Store
     */
    protected $storeResource;

    /**
     * @var StoreFactory
     */
    protected $storeFactory;

    /**
     * @var array
     */
    private $stores = [];

    /**
     * @param ResourceModel\Store $storeResource
     * @param StoreFactory $storeFactory
     */
    public function __construct(
        \Joseph\StoreLocator\Model\ResourceModel\Store $storeResource,
        \Joseph\StoreLocator\Model\StoreFactory $storeFactory
    ) {
        $this->storeResource = $storeResource;
        $this->storeFactory = $storeFactory;
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function save(\Joseph\StoreLocator\Api\Data\StoreInterface $store)
    {
        // TODO: Implement save() method.
    }

    public function delete(\Joseph\StoreLocator\Api\Data\StoreInterface $store)
    {
        // TODO: Implement delete() method.
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        // TODO: Implement getList() method.
    }
}
