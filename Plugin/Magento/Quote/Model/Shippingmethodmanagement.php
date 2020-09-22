<?php

namespace Magecomp\Freeshiphideother\Plugin\Magento\Quote\Model;

use Magecomp\Freeshiphideother\Helper\Data;

class Shippingmethodmanagement
{
    protected $_helper;

    public function __construct(Data $helper)
    {
        $this->_helper = $helper;

    }

    private function shipingforuse($shippingMethodManagement, $output)
    {
        if ($this->_helper->isEnabled()) {
            $free = [];
            $chargeble = [];
            foreach ($output as $shippingMethod) {
                if ($shippingMethod->getCarrierCode() == 'freeshipping' && $shippingMethod->getMethodCode() == 'freeshipping') {
                    $free[] = $shippingMethod;
                }
                $chargeble[] = $shippingMethod;
            }
            if ($free) {
                return $free;
            } else {
                return $chargeble;
            }
        }
        return $output;
    }

    public function afterEstimateByAddressId(\Magento\Quote\Model\ShippingMethodManagement $shippingMethodManagement, $output)
    {
        $result = $this->shipingforuse($shippingMethodManagement, $output);
        return $result;
    }

    public function afterExtractAddressData(\Magento\Quote\Model\ShippingMethodManagement $shippingMethodManagement, $output)
    {
        $result = $this->shipingforuse($shippingMethodManagement, $output);
        return $result;
    }

    public function afterEstimateByExtendedAddress(\Magento\Quote\Model\ShippingMethodManagement $shippingMethodManagement, $output)
    {
        $result = $this->shipingforuse($shippingMethodManagement, $output);
        return $result;
    }
}
