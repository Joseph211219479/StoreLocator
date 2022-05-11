<?php
namespace Joseph\StoreLocator\Block;
use Magento\Framework\View\Element\Template;
use Joseph\StoreLocator\Api\StoreRepositoryInterface;

class Storelocator extends Template
{
    private StoreRepositoryInterface $storeRepository;

    /**
     * @param Template\Context $context
     * @param array $data
     * @param StoreRepositoryInterface $storeRepository
     */
    public function __construct(Template\Context $context, array $data = [], StoreRepositoryInterface $storeRepository
)
    {
        parent::__construct($context, $data);
        $this->storeRepository = $storeRepository;
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getStorelocatorCollection(){
        return $this->storeRepository->getListGroupedByProvince();
    }
}
