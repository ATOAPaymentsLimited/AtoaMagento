# Atoa Payment for Magento 2

Atoa is an Authorised UK Payment Institution (FRN #1007647) powering growth for UK businesses. This extension integrates Atoa into your Magento 2 store, enabling customers to pay via instant bank transfer directly from their banking app, or by card — including Visa, Mastercard, Google Pay and Apple Pay — from a single checkout integration.

[![Magento 2.4](https://img.shields.io/badge/Magento-2.4.4%2B-orange)](https://devdocs.magento.com)
[![PHP 8.1+](https://img.shields.io/badge/PHP-8.1%2B-blue)](https://www.php.net)
[![License: OSL-3.0](https://img.shields.io/badge/License-OSL--3.0-green)](https://opensource.org/licenses/OSL-3.0)
[![Version](https://img.shields.io/badge/Version-2.0.0-brightgreen)](https://github.com/ATOAPaymentsLimited/AtoaMagento/releases)

---

## Table of Contents

- [Payment Methods](#payment-methods)
- [Features](#features)
- [Compatibility](#compatibility)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
  - [Atoa Bank Payment](#atoa-bank-payment)
  - [Webhook Setup](#webhook-setup)
  - [Order Statuses](#order-statuses)
  - [Auto Invoice](#auto-invoice)
  - [Display & Banner Settings](#display--banner-settings)
  - [Atoa Card Payment](#atoa-card-payment)
  - [Country Restrictions](#country-restrictions)
  - [Order Amount Limits](#order-amount-limits)
  - [Multi-Store Setup](#multi-store-setup)
- [Troubleshooting](#troubleshooting)
- [Support](#support)
- [License](#license)

---

## Payment Methods

| Method | Description |
|---|---|
| **Atoa Bank Payment** | Customers pay directly from their banking app via UK Open Banking — faster checkout, lower fees |
| **Atoa Card Payment** | Customers pay using Visa, Mastercard, Google Pay or Apple Pay |

---

## Features

**Payments**
- Pay by Bank via UK Open Banking
- Card payments: Visa, Mastercard, Google Pay, Apple Pay
- Two independently configurable payment methods

**Order Management**
- Real-time order status updates via webhooks
- Secure V2 webhook signing (HMAC-SHA256) with V1 fallback for backward compatibility
- Configurable order statuses for pending, paid and cancelled states
- Auto invoice creation on payment confirmation
- Automatic order cancellation on payment expiry with customer notification email

**Storefront Promotions**
- Promotional banners on homepage, product listing, product detail and checkout pages
- Customisable banner text with `{{logo}}` placeholder support
- Three colour themes: Red, Gray, White
- Information popup modal with live bank logos fetched from the Atoa API

**Merchant Controls**
- Country-level payment restrictions
- Minimum and maximum order amount limits
- Multi-store callback routing

---

## Compatibility

| Component | Supported Versions |
|---|---|
| Magento Open Source | 2.4.4, 2.4.5, 2.4.6, 2.4.7, 2.4.8 |
| Adobe Commerce | 2.4.4, 2.4.5, 2.4.6, 2.4.7, 2.4.8 |
| PHP | 8.1, 8.2, 8.3 |

---

## Prerequisites

- An active **Atoa Business Account** — [Sign up at paywithatoa.co.uk](https://paywithatoa.co.uk)
- An **Access Token** from your [Atoa Dashboard](https://dashboard.paywithatoa.co.uk)
- Composer 2.x

---

## Installation

### Option A — Composer (Recommended)

**1. Add the Atoa repository to your Magento project:**

```bash
composer config repositories.atoa vcs https://github.com/ATOAPaymentsLimited/AtoaMagento.git
```

**2. Authenticate with GitHub (required for private repository access):**

```bash
composer config --global github-oauth.github.com YOUR_GITHUB_TOKEN
```

Replace `YOUR_GITHUB_TOKEN` with a [GitHub personal access token](https://github.com/settings/tokens) with `repo` scope.

**3. Require the module:**

```bash
composer require atoa/module-atoa-payment:2.0.0
```

**4. Enable and deploy:**

```bash
php bin/magento module:enable Atoa_AtoaPayment
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
php bin/magento cache:clean
```

---

### Option B — Manual ZIP Install

**1.** Download the release zip from this repository.

**2.** Extract and copy the contents into:

```
{magento_root}/app/code/Atoa/AtoaPayment/
```

**3.** Run setup commands:

```bash
php bin/magento module:enable Atoa_AtoaPayment
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
php bin/magento cache:clean
```

**4.** Confirm the module is active:

```bash
php bin/magento module:status Atoa_AtoaPayment
```

---

## Configuration

All settings are in the Magento Admin Panel under:

**Stores → Configuration → Sales → Payment Methods**

For a complete setup guide, visit the [Atoa Magento Documentation](https://docs.atoa.me/magento).

---

### Atoa Bank Payment

| Field | Description |
|---|---|
| **Enabled** | Enable or disable the Pay by Bank payment method |
| **Access Token** | Your API key from the [Atoa Dashboard](https://dashboard.paywithatoa.co.uk). This is shared between Bank Payment and Card Payment |
| **Title** | Payment method label shown to customers at checkout |
| **Description** | Short description shown below the payment method title |
| **Instructions** | Additional instructions displayed to the customer |
| **Sort Order** | Position of this method relative to other payment methods at checkout |

---

### Webhook Setup

Webhooks notify your Magento store of payment status changes in real time. Two webhook endpoints are registered:

| Webhook Event | Endpoint | Trigger |
|---|---|---|
| `PAYMENTS_STATUS` | `/rest/V1/atoa/webhook` | Payment completed, pending or failed |
| `EXPIRED_STATUS` | `/rest/V1/atoa/expiredWebhook` | Payment request timed out |

**Step 1 — Register Webhooks**

In the Atoa Payment configuration, click the **Generate** button next to the *Webhook URL* field. This registers both webhook endpoints with Atoa automatically using your Access Token.

**Step 2 — Enable V2 Webhook Signing (Recommended)**

V2 signing uses HMAC-SHA256 to verify that incoming webhook requests originate from Atoa.

1. Enable **V2 Webhook Signing** in your [Atoa Dashboard](https://dashboard.paywithatoa.co.uk)
2. Copy the signing secret (`whsec_...`)
3. Paste it into the **Webhook Signing Secret** field in the Magento admin

> If no Webhook Signing Secret is set, the extension falls back to V1 signature validation using your Access Token as the HMAC key.

---

### Order Statuses

| Field | Default | Description |
|---|---|---|
| **New Order Status** | Pending | Applied when an order is placed and payment is initiated |
| **Paid Order Status** | Processing | Applied when Atoa confirms the payment is complete |
| **Cancel Order Status** | Cancelled | Applied when a payment fails or expires |

---

### Auto Invoice

| Field | Default | Description |
|---|---|---|
| **Create Auto Invoice** | No | When enabled, an invoice is automatically created and emailed to the customer upon payment confirmation |

---

### Display & Banner Settings

Navigate to the **Display Setting** sub-section within the Atoa Payment configuration.

| Field | Description |
|---|---|
| **Enable Store View Banner** | Display a promotional banner on the homepage |
| **Enable Banner on Product List Page** | Display a banner on category and search result pages |
| **Enable Banner on Product Detail Page** | Display a banner on individual product pages |
| **Enable Information Popup** | Show a **More Info** link on banners that opens a modal about Atoa, including live bank logos and payment steps |
| **Banner Content Text** | The banner message. Use `{{logo}}` as a placeholder for the Atoa icon. Example: `{{logo}} Pay by Bank or Card with Atoa` |
| **Styles** | Banner colour theme: **Red**, **Gray** or **White** |

**Checkout Page Settings** (separate sub-section):

| Field | Description |
|---|---|
| **Banner Styles** | Colour theme for the banner inside the checkout payment block |
| **Banner Checkout Text** | Text displayed inside the checkout payment block |

---

### Atoa Card Payment

Accept Visa, Mastercard, Google Pay and Apple Pay through Atoa.

> Card Payment uses the same **Access Token** as Bank Payment. Ensure the Bank Payment method has a valid Access Token configured before enabling Card Payment.

| Field | Default | Description |
|---|---|---|
| **Enabled** | No | Enable or disable Card Payment |
| **Title** | Atoa Card Payment | Payment method label shown at checkout |
| **Banner Checkout Text** | — | Text displayed in the card payment checkout block |
| **Banner Styles** | — | Colour theme for the card payment checkout block |

---

### Country Restrictions

| Field | Description |
|---|---|
| **Payment from Applicable Countries** | Select *Specific Countries* to restrict availability by geography |
| **Specific Countries** | Multi-select list of countries where the payment method will be shown |

---

### Order Amount Limits

| Field | Description |
|---|---|
| **Min Order Total** | Minimum order value required for this method to appear at checkout |
| **Max Order Total** | Maximum order value for this method to appear at checkout |
| **Min Allowed Amount** | Minimum accepted payment amount |
| **Max Allowed Amount** | Maximum accepted payment amount |

---

### Multi-Store Setup

| Field | Default | Description |
|---|---|---|
| **Default Callback Store** | Default Store | The store view customers are redirected to after completing payment. Configure this when running a multi-store Magento setup to ensure the correct store is loaded post-payment |

---

## Troubleshooting

Logs are written daily to:

```
{magento_root}/var/log/atoa_payment/debug_YYYYMMDD.log
```

| Issue | Resolution |
|---|---|
| Webhook not being received | Click **Generate** to re-register webhooks. Verify the Access Token is correct and active |
| Order status not updating after payment | Confirm the Webhook Signing Secret in Magento matches the one in your Atoa Dashboard |
| Bank logos not displaying | Verify your store's CSP policy allows images from the Atoa static asset domain. This is handled automatically by the module's CSP whitelist configuration |
| Card Payment not appearing at checkout | Ensure Atoa Bank Payment is **Enabled** and has a valid **Access Token** set |
| Payment callback redirecting to wrong store | Set the correct store view under **Default Callback Store** in the Bank Payment configuration |
| Banners not appearing on the frontend | Run `php bin/magento setup:static-content:deploy` followed by `php bin/magento cache:clean` |
| Module compilation errors after install | Run `php bin/magento setup:di:compile` and review the output for dependency errors |

---

## Support

| Channel | Details |
|---|---|
| **Documentation** | [docs.atoa.me/magento](https://docs.atoa.me/magento) |
| **Dashboard** | [dashboard.paywithatoa.co.uk](https://dashboard.paywithatoa.co.uk) |
| **Email** | [hello@paywithatoa.co.uk](mailto:hello@paywithatoa.co.uk) |
| **Live Chat** | Available via Chatwoot inside the [Atoa Dashboard](https://dashboard.paywithatoa.co.uk) |
| **Bug Reports** | [Open a GitHub Issue](https://github.com/ATOAPaymentsLimited/AtoaMagento/issues) |

---

## License

This extension is licensed under the [Open Software License 3.0 (OSL-3.0)](https://opensource.org/licenses/OSL-3.0).
