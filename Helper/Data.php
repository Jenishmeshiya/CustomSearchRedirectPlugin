<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 * @package  Czargroup_CustomSearchRedirectPlugin
 * @author
 */
namespace Czargroup\CustomSearchRedirectPlugin\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Xigen ContactResponse Email helper class
 */
class Data extends AbstractHelper
{
    const XML_PATH_EMAIL_CONFIRM = 'web/default/custom_module_enabel';

    /**
     * @var Magento\Store\Model\StoreManagerInterface $storeManager
     */
    private $storeManager;

    /**
     * @var Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    protected $scopeConfig;

    /**
     * Email constructor.
     * @param Magento\Framework\App\Helper\Context $context
     * @param Magento\Store\Model\StoreManagerInterface $storeManager
     * @param Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    /**
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getConfirmation()
    {
        return $this->getConfigValue(self::XML_PATH_EMAIL_CONFIRM, $this->storeManager->getStore()->getId());
    }

    /**
     * @param $xmlPath
     * @param null $storeId
     * @return mixed
     */
    public function getConfigValue($xmlPath, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $xmlPath,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
