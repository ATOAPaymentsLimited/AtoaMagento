<?php

declare(strict_types=1);

namespace Atoa\AtoaPayment\Block\Html;

use Magento\Checkout\Model\Session;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\ScopeInterface;

class Title extends Template
{
    /**
     * Config path to 'Translate Title' header settings
     */
    private const XML_PATH_HEADER_TRANSLATE_TITLE = 'design/header/translate_title';

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @var Session
     */
    private Session $checkoutSession;

    /**
     * Title construct.
     *
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param Session $checkoutSession
     * @param array $data
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        Session $checkoutSession,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->checkoutSession = $checkoutSession;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get Page Heading
     *
     * @return string
     */
    public function getPageHeading()
    {
        $pageTitle = $this->checkoutSession->getData('titlePage');

        return $this->shouldTranslateTitle() ? __($pageTitle)->getText() : $pageTitle;
    }

    /**
     * Get Message
     *
     * @return string
     */
    public function getMessage()
    {
        $message = '';
        if ($this->checkoutSession->getData('message')) {
            $message = $this->checkoutSession->getData('message');
        }

        return $this->shouldTranslateTitle() ? __($message)->getText() : $message;
    }

    /**
     * Check if page title should be translated
     *
     * @return bool
     */
    private function shouldTranslateTitle(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_HEADER_TRANSLATE_TITLE,
            ScopeInterface::SCOPE_STORE
        );
    }
}
