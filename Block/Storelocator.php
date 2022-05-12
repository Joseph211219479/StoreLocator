<?php
namespace Joseph\StoreLocator\Block;
use Magento\Framework\View\Element\Template;
use Joseph\StoreLocator\Api\StoreRepositoryInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\UrlInterface;

class Storelocator extends Template
{
    private StoreRepositoryInterface $storeRepository;
    private UrlInterface $urlBuiler;

    /**
     * @param Context $context
     * @param array $data
     * @param StoreRepositoryInterface $storeRepository
     * @param UrlInterface $urlBuiler
     */
    public function __construct(Context $context, array $data = [], StoreRepositoryInterface $storeRepository, UrlInterface $urlBuiler
)
    {
        parent::__construct($context, $data);
        $this->storeRepository = $storeRepository;
        $this->urlBuiler = $urlBuiler;
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getStorelocatorCollection(){
        return $this->storeRepository->getListGroupedByProvince();
    }

    /**
     * @param int $id
     * @return string
     */
    public function getStoreHrefString(int $id): string
    {
       return  $this->urlBuiler->getUrl(  'storelocator/index/store', ['id' => $id]);
    }
}
