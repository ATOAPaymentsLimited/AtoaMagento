<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Model;

use Atoa\AtoaPayment\Model\Payment\Atoa;
use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Asset\Repository;

class AtoaConfigProvider implements ConfigProviderInterface
{
    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * @var Repository
     */
    private Repository $assetRepo;

    /**
     * @var ConfigProvider
     */
    private ConfigProvider $configProvider;

    /**
     * Atoa Config Provider construct.
     *
     * @param RequestInterface $request
     * @param Repository $assetRepo
     * @param ConfigProvider $configProvider
     */
    public function __construct(
        RequestInterface $request,
        Repository $assetRepo,
        ConfigProvider $configProvider
    ) {
        $this->request = $request;
        $this->assetRepo = $assetRepo;
        $this->configProvider = $configProvider;
    }

    /**
     * @inheritdoc
     */
    public function getConfig()
    {
        return [
            'payment' => [
                Atoa::CODE => [
                    'logoMarkHref' => $this->assetRepo->getUrlWithParams(
                        'Atoa_AtoaPayment/images/atoa-claret-icon.png',
                        ['_secure' => $this->request->isSecure()]
                    ),
                    'bankLogosHref' => $this->assetRepo->getUrlWithParams(
                        'Atoa_AtoaPayment/images/bank-support.png',
                        ['_secure' => $this->request->isSecure()]
                    ),
                    'mobileBankLogosHref' => $this->assetRepo->getUrlWithParams(
                        'Atoa_AtoaPayment/images/bank-support-mobile.png',
                        ['_secure' => $this->request->isSecure()]
                    ),
                    'bannerCheckoutText' => $this->configProvider->getConfig(Atoa::BANNER_CHECKOUT_TEXT),
                    'style' => $this->configProvider->getConfig(Atoa::BANNER_CHECKOUT_STYLES)
                ]
            ]
        ];
    }
}
