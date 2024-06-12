<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Gateway\Validator;

use Magento\Payment\Gateway\Validator\AbstractValidator;
use Magento\Payment\Gateway\Validator\ResultInterface;

class ResponseAtoaValidator extends AbstractValidator
{
    /**
     * Validate
     *
     * @param array $validationSubject
     * @return ResultInterface
     */
    public function validate(array $validationSubject)
    {
        return $this->createResult($this->validateResponse());
    }

    /**
     * Validate Response
     *
     * @return true
     */
    protected function validateResponse(): bool
    {
        return true;
    }
}
