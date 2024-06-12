<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Model;

use Atoa\AtoaPayment\Model\Payment\Atoa;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class ConfigProvider
{
    public const MODULE_CONFIG_PREFIX = 'payment/atoa/';

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * ConfigProvider construct.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get Atoa Config
     *
     * @param string $field
     * @param ?string $scope
     * @return mixed
     */
    public function getConfig(string $field, ?string $scope = ScopeInterface::SCOPE_STORE): mixed
    {
        return $this->scopeConfig->getValue(self::MODULE_CONFIG_PREFIX . $field, $scope);
    }

    /**
     * Is Sandbox
     *
     * @return bool
     */
    public function isSandbox(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::MODULE_CONFIG_PREFIX . Atoa::IS_SANDBOX,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Ts Enable Banner Checkout
     *
     * @return bool
     */
    public function isEnableBannerCheckout(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::MODULE_CONFIG_PREFIX . Atoa::ENABLE_BANNER_CHECKOUT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Ts Enable Information Popup
     *
     * @return bool
     */
    public function isEnableInformationPopup(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::MODULE_CONFIG_PREFIX . Atoa::ENABLE_INFORMATION_POPUP,
            ScopeInterface::SCOPE_STORE
        );
    }
}
