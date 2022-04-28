<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Joseph\StoreLocator\Block\Adminhtml\Store\Edit;

use Magento\Framework\App\Request\DataPersistorInterface;

class GenericButton
{

    protected DataPersistorInterface $dataPersistor;

    /**
     * Url Builder
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        DataPersistorInterface $dataPersistor,
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->urlBuilder = $context->getUrlBuilder();
    }

     /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }

    /**
     * Return the current Store Id.
     *
     * @return int|null
     */
    public function getStoreId()
    {

        $data = $this->dataPersistor->get('storelocator_store');
        if(isset($data)){
            return isset($data["id"]) ? $data["id"] : null;
        }
        return null;
    }

    /**
     * Check where button can be rendered
     *
     * @param string $name
     * @return string
     */
    public function canRender($name)
    {
        return $name;
    }
}
