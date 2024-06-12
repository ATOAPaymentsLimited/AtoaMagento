<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Gateway\Command;

use Magento\Framework\Exception\NotFoundException;
use Magento\Payment\Gateway\CommandInterface;
use Magento\Payment\Gateway\Helper\ContextHelper;
use Magento\Payment\Gateway\Helper\SubjectReader;
use Magento\Payment\Model\MethodInterface;
use Magento\Sales\Model\Order;

class StrategyCommand implements CommandInterface
{
    /**
     * Execute
     *
     * @param array $commandSubject
     *
     * @return void
     */
    public function execute(array $commandSubject)
    {
        $payment = SubjectReader::readPayment($commandSubject)->getPayment();
        ContextHelper::assertOrderPayment($payment);

        /** @var Order $order */
        $order = $payment->getOrder();
        $totalDue = $order->getTotalDue();
        $baseTotalDue = $order->getBaseTotalDue();

        if ($this->getPaymentAction($commandSubject) === MethodInterface::ACTION_AUTHORIZE) {
            $payment->authorize(true, $baseTotalDue);
            $payment->setAmountAuthorized($totalDue);
        }
    }

    /**
     * Payment Action
     *
     * @param array $commandSubject
     *
     * @return string
     */
    protected function getPaymentAction(array $commandSubject)
    {
        return $commandSubject['paymentAction'];
    }

    /**
     * Update Order State
     *
     * @param array $commandSubject
     * @param string $state
     * @param string $status
     */
    protected function updateOrderState(array $commandSubject, string $state, string $status)
    {
        $stateObject = SubjectReader::readStateObject($commandSubject);
        $stateObject->setState($state);
        $stateObject->setStatus($status);
    }
}
