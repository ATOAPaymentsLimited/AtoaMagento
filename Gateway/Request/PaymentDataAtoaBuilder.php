<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Gateway\Request;

use Magento\Payment\Gateway\Request\BuilderInterface;

class PaymentDataAtoaBuilder implements BuilderInterface
{
    /**
     * Build
     *
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject): array
    {
        return [];
    }
}
