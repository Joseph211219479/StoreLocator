<?php
namespace Joseph\StoreLocator\Block\Adminhtml\Store\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Joseph\StoreLocator\Block\Adminhtml\Store\Edit\GenericButton;

/**
 * Class DeleteButton
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getStoreId()) {
            $data = [
                'label' => __('Delete Store'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\''
                    . __('Are you sure you want to delete this contact ?')
                    . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['joseph_storelocator_id' => $this->getStoreId()()]);
    }
}
