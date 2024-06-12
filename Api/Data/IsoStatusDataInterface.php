<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Api\Data;

interface IsoStatusDataInterface
{
    public const CODE = 'code';
    public const NAME = 'name';

    /**
     * Get Code
     *
     * @return ?string
     */
    public function getCode(): ?string;

    /**
     * Set Code
     *
     * @param ?string $code
     * @return $this
     */
    public function setCode(?string $code);

    /**
     * Get Name
     *
     * @return ?string
     */
    public function getName(): ?string;

    /**
     * Set Name
     *
     * @param ?string $name
     * @return $this
     */
    public function setName(?string $name);
}
