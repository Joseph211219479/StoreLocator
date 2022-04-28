<?php
namespace Joseph\StoreLocator\Model\DataProvider;

use Joseph\StoreLocator\Model\ResourceModel\Store\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class Store extends AbstractDataProvider
{
    protected DataPersistorInterface $dataPersistor;
    protected $storeCollectionFactory;


    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $storeFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $storeFactory, //todo: this should be store model not collection
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->dataPersistor = $dataPersistor;
        $this->storeCollectionFactory = $storeFactory;
    }

    public function getData()
    {
        $this->collection = $this->storeCollectionFactory->create();

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        foreach ($items as $store) {
            $this->loadedData[$store->getId()]['store'] = $store->getData();
        }

        /*$data = $this->dataPersistor->get('catalog_rule');
        if (!empty($data)) {
            $store = $this->collection->getNewEmptyItem();
            $store->setData($data);
            $this->loadedData[$store->getId()] = $store->getData();
            $this->dataPersistor->clear('catalog_rule');
        }*/
        return $this->loadedData;
    }

    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        return null;
    }
}
