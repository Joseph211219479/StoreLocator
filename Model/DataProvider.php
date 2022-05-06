<?php
namespace Joseph\StoreLocator\Model;

use Joseph\StoreLocator\Model\ResourceModel\Store\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $storeCollectionFactory;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $storeCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $storeCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->storeCollectionFactory = $storeCollectionFactory;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        $this->collection = $this->storeCollectionFactory->create();

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();

        foreach ($items as $store) {
            $this->loadedData[$store->getId()]['store'] = $store->getData();
        }

        return $this->loadedData;
    }
}
