<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Api;

interface RedirectInterface
{
    /**
     * Redirect
     *
     * @param mixed $orderId
     * @return \Atoa\AtoaPayment\Api\Data\RedirectDataInterface
     */
    public function redirect(mixed $orderId);
}
