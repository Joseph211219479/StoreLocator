<?php
namespace Joseph\StoreLocator\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Joseph\StoreLocator\Api\Data\StoreInterface;

interface StoreRepositoryInterface
{
    /**
     * @param int $id
     * @return \Joseph\StoreLocator\Api\Data\StoreInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param \Joseph\StoreLocator\Api\Data\StoreInterface $store
     * @return \Joseph\StoreLocator\Api\Data\StoreInterface
     */
    public function save(StoreInterface $store);

    /**
     * @param \Amasty\Example\Api\Data\StoreInterface $store
     * @return void
     */
    public function delete(StoreInterface $store);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Joseph\StoreLocator\Api\Data\StoreSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
