<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Model\Data;

use Atoa\AtoaPayment\Api\Data\IsoStatusDataInterface;
use Magento\Framework\DataObject;

class IsoStatus extends DataObject implements IsoStatusDataInterface
{
    /**
     * @inheritdoc
     */
    public function getCode(): ?string
    {
        return $this->getData(self::CODE);
    }

    /**
     * @inheritdoc
     */
    public function setCode(?string $code)
    {
        $this->setData(self::CODE, $code);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritdoc
     */
    public function setName(?string $name)
    {
        $this->setData(self::NAME, $name);
        return $this;
    }
}
