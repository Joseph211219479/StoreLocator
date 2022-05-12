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
            'EASTERN CAPE' => __('Eastern Cape'),
            'FREE STATE' => __('Free State'),
            'GAUTENG' => __('Gauteng'),
            'KWAZULU-NATAL' => __('KwaZulu-Natal'),
            'LIMPOPO' => __('Limpopo'),
            'MPUMALANGA' => __('Mpumalanga'),
            'NORTHERN CAPE' => __('Northern Cape'),
            'NORTH WEST' => __('North West'),
            'WESTERN CAPE' => __('Western Cape')
        ];
    }
}
