<?php
declare(strict_types=1);

namespace Atoa\AtoaPayment\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class GenerateWebhookUrl extends Field
{
    /**
     * @var string
     */
    protected $_template = 'Atoa_AtoaPayment::system/config/generateWebhookUrl.phtml';

    /**
     * Get the button and scripts contents
     *
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element): string
    {
        $this->addData(
            [
                'button_label' => __($element->getOriginalData()['button_label']),
            ]
        );

        return $this->_toHtml();
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getAjaxUrl(): string
    {
        return $this->_urlBuilder->getUrl(
            'atoa/system_config/generatewebhookurl',
            [
                'form_key' => $this->getFormKey(),
            ]
        );
    }
}
