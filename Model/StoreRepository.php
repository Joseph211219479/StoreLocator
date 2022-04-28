<?php
namespace Joseph\StoreLocator\Model;

use Joseph\StoreLocator\Api\Data\StoreInterface;
use Joseph\StoreLocator\Api\StoreRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\ValidatorException;

class StoreRepository implements StoreRepositoryInterface
{
    private ResourceModel\Store $storeResource;
    private ResourceModel\StoreFactory $storeFactory;

    private $stores = []; //todo try without an array

    /**
     * @param ResourceModel\Store $storeResource
     * @param ResourceModel\StoreFactory $storeFactory
     */
    public function __construct(\Joseph\StoreLocator\Model\ResourceModel\Store $storeResource, \Joseph\StoreLocator\Model\ResourceModel\StoreFactory $storeFactory){

        $this->storeResource = $storeResource;
        $this->storeFactory = $storeFactory;
    }
    public function get($storeId)
    {
        if(!isset($this->stores[$storeId])){
            $store = $this->storeFactory->create();

            $store->load($storeId);
            if(!$store->getStoreId()){
                throw new NoSuchEntityException(
                    __('The store with the "%1" ID wasn\'t found. Verify the ID and try again.', $storeId)
                );
            }
        }
    }

    public function save(StoreInterface $store)
    {
        if($store->getStoreId()){
            $store = $this->get($store->getStoreId())->addData($store->getData());
        }

        try{
            $this->storeResource->save($store);
            unset($this->stores[$store->getId()]);
        }catch (ValidatorException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __('The "%1" store was unable to be saved. Please try again.', $store->getStoreId())
            );
        }
        return $store;
    }

    public function delete(StoreInterface $store)
    {
        try {
            $this->storeResource->delete($store);
            unset($this->store[$store->getId()]);
        } catch (ValidatorException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('The "%1" store couldn\'t be removed.', $store->getStoreId()));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($storeId)
    {
        $model = $this->get($storeId);
        $this->delete($model);
        return true;
    }


    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        // TODO: Implement getList() method.
    }
}
