<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Gateway\Http\Client;

use Magento\Payment\Gateway\Http\ClientInterface;
use Magento\Payment\Gateway\Http\TransferInterface;

class PaymentAtoa implements ClientInterface
{
    /**
     * Place Request
     *
     * @param TransferInterface $transferObject
     * @return array
     */
    public function placeRequest(TransferInterface $transferObject): array
    {
        return ['charge' => []];
    }
}
