<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Model\Data;

use Atoa\AtoaPayment\Api\Data\StoreDetailsDataInterface;
use Magento\Framework\DataObject;

class StoreDetails extends DataObject implements StoreDetailsDataInterface
{
    /**
     * @inheritdoc
     */
    public function getId(): ?string
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritdoc
     */
    public function setId(?string $id)
    {
        $this->setData(self::ID, $id);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getAddress(): ?string
    {
        return $this->getData(self::ADDRESS);
    }

    /**
     * @inheritdoc
     */
    public function setAddress(?string $address)
    {
        $this->setData(self::ADDRESS, $address);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLocationName(): ?string
    {
        return $this->getData(self::LOCATION_NAME);
    }

    /**
     * @inheritdoc
     */
    public function setLocationName(?string $locationName)
    {
        $this->setData(self::LOCATION_NAME, $locationName);
        return $this;
    }
}
