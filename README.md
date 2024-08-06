# AtoaMagento


#### Installation Guide

Magento 2 is a powerful, self-hosted platform that empowers businesses globally to create and manage their e-commerce stores. It offers flexibility for businesses to customize their online stores according to their specific requirements.

Atoa Payments integrates seamlessly with Magento, allowing businesses to process payments securely and efficiently, enhancing the overall customer experience.

To ensure smooth integration, we advise testing the Atoa Payments plugin in a Magento test environment before deploying it on your live production site.

## 1. Prerequisites

First, you must create an Atoa account and generate the access secret. Check the [Getting Started](https://docs.atoa.me/introduction) guide for more information.

## 2. Install the Atoa Payments Magento Plugin

### 1.Add the GitHub Repository to Composer:

First, add the GitHub repository to your Magento project's composer.json file. Open a terminal and navigate to the root of your Magento to project, then run the following command:

```sh

composer config repositories.atoa vcs
https://github.com/ATOAPaymentsLimited/AtoaMagento.git

```

### 2. Authenticate Composer with GitHub:

If the repository is private, you need to authenticate Composer with GitHub. Create a personal access token on GitHub with the repo scope. Once you have the token, configure Composer to use it:

```sh
composer config --global github-oauth.github.com your-github-token
```

**your-github-token is the personal access token you generated.**

### 3. Require the Module Using Composer:

Now, require the module in your project. Run the following command:

```sh
composer require atoa/module-atoa-payment:dev-main
```

Ensure that you replace atoa/module-atoa-payment with the correct vendor and package name if it is different. dev-main refers to the main branch of the repository.

### 4. Enable the Module in Magento:

Once the module is installed, enable it using Magento's CLI commands:

```sh
php bin/magento module:enable Atoa_AtoaPayment
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
php bin/magento cache:clean
```

Via Zip/Archive

- Download file, unzip file:
- Copy folder app into root folder
- Run command

```sh
php bin/magento module:enable Atoa_AtoaPayment
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
php bin/magento cache:clean
```

## 3. Configure the Atoa Payments Plugin

- Sign in to your Magento Admin Panel.
- Choose Stores -> Configuration -> Sales -> Payment Methods -> Atoa Payment.
- Copy and paste your Access token from your Atoa Payments Portal into the API key field
- Choose the type and color of payments banner for your storefront
- Save your changes.

## 4. Activate the Atoa Payments Plugin

- Enable the Atoa Payments module by selecting Enabled -> Yes.
- Atoa Payments will appear as an option on your checkout.
- Set the Sort Order -> 1 so Atoa Payments is top.

<br />
