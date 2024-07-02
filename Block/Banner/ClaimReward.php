<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */
declare(strict_types=1);

namespace Atoa\AtoaPayment\Block\Banner;

use Atoa\AtoaPayment\Model\ConfigProvider;
use Magento\Checkout\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class ClaimReward extends Template
{
    private const CLAIM_CASHBACK_URL = 'https://atoa.me/claim-cashback?';

    /**
     * @var Session
     */
    private Session $checkoutSession;

    /**
     * @var ConfigProvider
     */
    private ConfigProvider $configProvider;

    /**
     * ClaimReward construct.
     *
     * @param Context $context
     * @param Session $checkoutSession
     * @param ConfigProvider $configProvider
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Session $checkoutSession,
        ConfigProvider $configProvider,
        array $data = []
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->configProvider = $configProvider;
        parent::__construct($context, $data);
    }

    /**
     * Get Payment Idempotency ID
     *
     * @return bool|string
     */
    public function getPaymentIdempotencyId(): bool|string
    {
        return $this->checkoutSession->getData('paymentIdempotencyId') ?: false;
    }

    /**
     * Get Mobile Number
     *
     * @return bool|string
     */
    public function getMobileNumber(): bool|string
    {
        return $this->checkoutSession->getData('mobilenumber')
            ? preg_replace('/[^0-9]/', '', $this->checkoutSession->getData('mobilenumber'))
            : '';
    }

    /**
     * Can Show Iframe
     *
     * @return bool
     */
    public function canShowIframe(): bool
    {
        return $this->getPaymentIdempotencyId() && $this->configProvider->isEnableBannerCheckout();
    }

    /**
     * Get Iframe Src
     *
     * @return string
     */
    public function getIframeSrc(): string
    {
        $params['paymentIdempotencyId'] = $this->getPaymentIdempotencyId();
        if ($this->getMobileNumber()) {
            $params['mobilenumber'] = $this->getMobileNumber();
        }

        return self::CLAIM_CASHBACK_URL . http_build_query($params);
    }
}
