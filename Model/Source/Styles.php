<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Styles implements OptionSourceInterface
{
    public const STYLE_RED = '1';
    public const STYLE_GRAY = '2';
    public const STYLE_WHITE = '3';

    /**
     * Possible actions on order place.
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => self::STYLE_RED,
                'label' => __('Red'),
            ],
            [
                'value' => self::STYLE_GRAY,
                'label' => __('Gray'),
            ],
            [
                'value' => self::STYLE_WHITE,
                'label' => __('White'),
            ]
        ];
    }
}
