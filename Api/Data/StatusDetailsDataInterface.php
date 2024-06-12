<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Api\Data;

interface StatusDetailsDataInterface
{
    public const STATUS = 'status';
    public const STATUS_UPDATE_DATE = 'statusUpdateDate';
    public const ISO_STATUS = 'isoStatus';

    /**
     * Get Status
     *
     * @return ?string
     */
    public function getStatus(): ?string;

    /**
     * Set Status
     *
     * @param ?string $status
     * @return $this
     */
    public function setStatus(?string $status);

    /**
     * Get Status Update Date
     *
     * @return ?string
     */
    public function getStatusUpdateDate(): ?string;

    /**
     * Set Status Update Date
     *
     * @param ?string $statusUpdateDate
     * @return $this
     */
    public function setStatusUpdateDate(?string $statusUpdateDate);

    /**
     * Get Iso Status
     *
     * @return \Atoa\AtoaPayment\Api\Data\IsoStatusDataInterface
     */
    public function getIsoStatus(): \Atoa\AtoaPayment\Api\Data\IsoStatusDataInterface;

    /**
     * Set Iso Status
     *
     * @param \Atoa\AtoaPayment\Api\Data\IsoStatusDataInterface $isoStatus
     * @return $this
     */
    public function setIsoStatus(\Atoa\AtoaPayment\Api\Data\IsoStatusDataInterface $isoStatus);
}
