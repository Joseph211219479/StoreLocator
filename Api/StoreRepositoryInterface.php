<?php
namespace Joseph\StoreLocator\Api;

use Joseph\StoreLocator\Api\Data\StoreSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Joseph\StoreLocator\Api\Data\StoreInterface;

interface StoreRepositoryInterface
{
    /**
     * @param int $storeId
     * @return \Joseph\StoreLocator\Api\Data\StoreInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @since 100.1.0
     */
    public function get($storeId);

    /**
     * @param \Joseph\StoreLocator\Api\Data\StoreInterface $store
     * @return \Joseph\StoreLocator\Api\Data\StoreInterface
     */
    public function save(StoreInterface $store);

    /**
     * @param \Joseph\StoreLocator\Api\Data\StoreInterface $store
     * @return void
     */
    public function delete(StoreInterface $store);

    /**
     * @param int $storeId
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @since 100.1.0
     */
    public function deleteById($storeId);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return StoreSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @return mixed
     */
    public function getListGroupedByProvince();
}
