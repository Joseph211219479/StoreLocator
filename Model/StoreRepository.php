<?php
namespace Joseph\StoreLocator\Model;

use Joseph\StoreLocator\Api\Data\StoreInterface;
use Joseph\StoreLocator\Api\StoreRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\ValidatorException;
use Joseph\StoreLocator\Model\ResourceModel\Store;
use Joseph\StoreLocator\Model\ResourceModel\Store\FrontendCollection as FrontendCollection;

class StoreRepository implements StoreRepositoryInterface
{
    private $storeResource;
    private $storeFactory;

    /**
     * @var array
     */
    private $stores = [];
    private  $storeCollection;

    /**
     * @param ResourceModel\Store $storeResource
     * @param StoreFactory $storeFactory
     * @param FrontendCollection $collection
     */
    public function __construct(Store $storeResource, StoreFactory $storeFactory,FrontendCollection $collection){
        $this->storeResource = $storeResource;
        $this->storeFactory = $storeFactory;
        $this->storeCollection = $collection;
    }

    /**
     * @param $storeId
     * @return StoreInterface|\Joseph\StoreLocator\Model\Store|void
     * @throws NoSuchEntityException
     */
    public function get($storeId)
    {
        if(!isset($this->stores[$storeId])){
            $store = $this->storeFactory->create();
            $this->storeResource->load($store,$storeId);

            if(!$store->getStoreId()){
                throw new NoSuchEntityException(
                    __('The store with the "%1" ID wasn\'t found. Verify the ID and try again.', $storeId)
                );
            }
            return $store;
        }
    }

    /**
     * @param StoreInterface $store
     * @return StoreInterface|\Joseph\StoreLocator\Model\Store
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function save(StoreInterface $store)
    {
        /*todo remove after test*/
        //$grouped = $this->getListGroupedByProvince();

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

    /**
     * @param StoreInterface $store
     * @return bool
     * @throws CouldNotDeleteException
     * @throws CouldNotSaveException
     */
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

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Joseph\StoreLocator\Api\Data\StoreSearchResultInterface|void
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
    }

    /**
     * @return Store\Collection|mixed
     */
    public function getListGroupedByProvince(){
        $this->storeCollection->setOrder('province');
        return $this->storeCollection;
    }
}
