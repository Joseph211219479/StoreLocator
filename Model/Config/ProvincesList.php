<?php
/** @noinspection PhpDeprecationInspection */

namespace Joseph\StoreLocator\Model\Config;

use Magento\Framework\Option\ArrayInterface;

class ProvincesList implements ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $result = [];
        foreach ($this->getOptions() as $value => $label) {
            $result[] = [
                'value' => $value,
                'label' => $label,
            ];
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return [
            '' => __('Please select...'),
            'Eastern Cape' => __('Eastern Cape'),
            'Free State' => __('Free State'),
            'Gauteng' => __('Gauteng'),
            'KwaZulu-Natal' => __('KwaZulu-Natal'),
            'Limpopo' => __('Limpopo'),
            'Mpumalanga' => __('Mpumalanga'),
            'Northern Cape' => __('Northern Cape'),
            'North West' => __('North West'),
            'Western Cape' => __('Western Cape')
        ];
    }
}
