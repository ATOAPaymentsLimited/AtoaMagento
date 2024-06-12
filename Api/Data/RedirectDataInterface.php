<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Api\Data;

interface RedirectDataInterface
{
    public const REDIRECT_URL = 'redirect_url';

    /**
     * Get Redirect Url
     *
     * @return ?string
     */
    public function getRedirectUrl(): ?string;

    /**
     * Set Redirect Url
     *
     * @param ?string $redirectUrl
     * @return $this
     */
    public function setRedirectUrl(?string $redirectUrl);
}
