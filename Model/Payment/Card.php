<?php

namespace Atoa\AtoaPayment\Model\Payment;

use Magento\Payment\Model\Method\AbstractMethod;
use Magento\Quote\Api\Data\CartInterface;

class Card extends AbstractMethod
{
    protected $_code = 'atoa_card';

    protected $_isOffline = false;

    public function isAvailable(CartInterface $quote = null): bool
    {
        return $this->getConfigData('active')
            && parent::isAvailable($quote);
    }
}