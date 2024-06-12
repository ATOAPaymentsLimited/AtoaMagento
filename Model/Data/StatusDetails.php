<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Model\Data;

use Atoa\AtoaPayment\Api\Data\StatusDetailsDataInterface;
use Magento\Framework\DataObject;

class StatusDetails extends DataObject implements StatusDetailsDataInterface
{
    /**
     * @inheritdoc
     */
    public function getStatus(): ?string
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inheritdoc
     */
    public function setStatus(?string $status)
    {
        $this->setData(self::STATUS, $status);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getStatusUpdateDate(): ?string
    {
        return $this->getData(self::STATUS_UPDATE_DATE);
    }

    /**
     * @inheritdoc
     */
    public function setStatusUpdateDate(?string $statusUpdateDate)
    {
        $this->setData(self::STATUS_UPDATE_DATE, $statusUpdateDate);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getIsoStatus(): \Atoa\AtoaPayment\Api\Data\IsoStatusDataInterface
    {
        return $this->getData(self::ISO_STATUS);
    }

    /**
     * @inheritdoc
     */
    public function setIsoStatus(\Atoa\AtoaPayment\Api\Data\IsoStatusDataInterface $isoStatus)
    {
        $this->setData(self::ISO_STATUS, $isoStatus);
        return $this;
    }
}
