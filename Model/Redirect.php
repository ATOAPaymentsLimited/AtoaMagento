<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Model;

use Atoa\AtoaPayment\Api\RedirectInterface;
use Atoa\AtoaPayment\Model\Data\RedirectFactory;
use Atoa\AtoaPayment\Model\Payment\Atoa;
use Magento\Checkout\Model\Session;
use Magento\Framework\Exception\AuthorizationException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\PaymentException;
use Magento\Framework\Exception\SessionException;
use Magento\Sales\Model\Order;

class Redirect implements RedirectInterface
{
    /**
     * @var RedirectFactory
     */
    private RedirectFactory $redirectDataFactory;

    /**
     * @var Session
     */
    private Session $checkoutSession;

    /**
     * @var RedirectUrl
     */
    private RedirectUrl $redirectUrl;

    /**
     * Redirect construct.
     *
     * @param RedirectFactory $redirectDataFactory
     * @param Session $checkoutSession
     * @param RedirectUrl $redirectUrl
     */
    public function __construct(
        RedirectFactory $redirectDataFactory,
        Session $checkoutSession,
        RedirectUrl $redirectUrl
    ) {
        $this->redirectDataFactory = $redirectDataFactory;
        $this->checkoutSession = $checkoutSession;
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * Redirect
     *
     * @param mixed $orderId
     * @return \Atoa\AtoaPayment\Api\Data\RedirectDataInterface
     * @throws AuthorizationException
     * @throws LocalizedException
     * @throws PaymentException
     * @throws SessionException
     * @throws \JsonException
     */
    public function redirect(mixed $orderId)
    {
        $order = $this->loadOrder((int)$orderId);
        if ($payment = $order->getPayment()) {
            $data = $this->redirectDataFactory->create();
            if ($payment->getMethod() === Atoa::CODE) {
                $data->setRedirectUrl($this->redirectUrl->getRedirectUrl($order));
            }
            return $data;
        }

        throw new PaymentException(
            __('Cannot retrieve a payment detail from the request,
             please contact our support if you have any questions')
        );
    }

    /**
     * Load Order
     *
     * @param int $orderId
     * @return Order
     * @throws AuthorizationException
     * @throws SessionException
     */
    private function loadOrder(int $orderId): Order
    {
        $order = $this->checkoutSession->getLastRealOrder();

        if (!$order->getId()) {
            throw new SessionException(
                __('Your order session is no longer exists.
                 In case that your payment transaction has been completed,
                  please kindly check your payment transaction with the bank.
                   In case that the payment has not been completed, you can make an order and complete payment again.')
            );
        }

        if ($orderId !== (int)$order->getId()) {
            throw new AuthorizationException(
                __('This request is not authorized to access the resource,
                 please contact our support if you have any questions')
            );
        }

        return $order;
    }
}
