<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Gateway\Response;

use Magento\Payment\Gateway\Response\HandlerInterface;

class PaymentAtoaDetailsHandler implements HandlerInterface
{
    /**
     * Handle
     *
     * @param array $handlingSubject
     * @param array $response
     *
     * @return void
     */
    public function handle(array $handlingSubject, array $response)
    {
        $handlingSubject;
        $response;
    }
}
