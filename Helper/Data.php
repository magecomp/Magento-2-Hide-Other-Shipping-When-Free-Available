<?php

namespace Magecomp\Freeshiphideother\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    protected $_storeManager;
    const FREESHIPHIDEOTHER_GENRAL_ENABLED = 'freeshiphideother/general/enable';

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    )
    {
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    public function isEnabled()
    {
        $configValue = $this->scopeConfig->getValue(
            self::FREESHIPHIDEOTHER_GENRAL_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->_storeManager->getStore()
        );
        return $configValue;
    }

}
