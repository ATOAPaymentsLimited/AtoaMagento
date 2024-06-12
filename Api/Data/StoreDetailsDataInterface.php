<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Api\Data;

interface StoreDetailsDataInterface
{
    public const ID = 'id';
    public const ADDRESS = 'address';
    public const LOCATION_NAME = 'locationName';

    /**
     * Get ID
     *
     * @return ?string
     */
    public function getId(): ?string;

    /**
     * Set Id
     *
     * @param ?string $id
     * @return $this
     */
    public function setId(?string $id);

    /**
     * Get Address
     *
     * @return ?string
     */
    public function getAddress(): ?string;

    /**
     * Set Address
     *
     * @param ?string $address
     * @return $this
     */
    public function setAddress(?string $address);

    /**
     * Get Location Name
     *
     * @return ?string
     */
    public function getLocationName(): ?string;

    /**
     * Set Location Name
     *
     * @param ?string $locationName
     * @return $this
     */
    public function setLocationName(?string $locationName);
}
