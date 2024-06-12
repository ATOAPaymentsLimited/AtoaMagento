<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class WebhookUrl extends Field
{
    /**
     * Template of webhook URL
     *
     * @var string
     */
    protected $_template = 'Atoa_AtoaPayment::system/config/webhookUrl.phtml';

    /**
     * Return element HTML code.
     *
     * @param AbstractElement $element
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $this->setValue($element->getValue());
        return $this->_toHtml();
    }
}
