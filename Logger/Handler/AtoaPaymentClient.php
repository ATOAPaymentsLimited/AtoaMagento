<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Logger\Handler;

use Exception;
use Magento\Framework\Filesystem\DriverInterface;
use Magento\Framework\Logger\Handler\Base;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class AtoaPaymentClient extends Base
{
    /**
     * @var TimezoneInterface
     */
    private TimezoneInterface $localeDate;

    /**
     * Client constructor.
     *
     * @param DriverInterface $filesystem
     * @param TimezoneInterface $localeDate
     * @param string|null $filePath
     * @param string|null $fileName
     * @throws Exception
     */
    public function __construct(
        DriverInterface $filesystem,
        TimezoneInterface $localeDate,
        $filePath = null,
        $fileName = null
    ) {
        $this->localeDate = $localeDate;
        $fileName = '/var/log/atoa_payment/debug_' . $this->getTimeStamp() . '.log';
        parent::__construct($filesystem, $filePath, $fileName);
    }

    /**
     * Get Time Stamp
     *
     * @return string
     */
    public function getTimeStamp()
    {
        $currentDate = $this->localeDate->date();
        return $currentDate->format('Ymd');
    }
}
