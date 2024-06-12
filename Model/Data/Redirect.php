<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Model\Data;

use Magento\Framework\Model\AbstractExtensibleModel;
use Atoa\AtoaPayment\Api\Data\RedirectDataInterface;

class Redirect extends AbstractExtensibleModel implements RedirectDataInterface
{
    /**
     * @inheritdoc
     */
    public function getRedirectUrl(): ?string
    {
        return $this->getData(self::REDIRECT_URL);
    }

    /**
     * @inheritdoc
     */
    public function setRedirectUrl(?string $redirectUrl)
    {
        $this->setData(self::REDIRECT_URL, $redirectUrl);
        return $this;
    }
}
