# Module Studio3Marketing GoogleTagManager

    ``studio3marketing/module-googletagmanager``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
Write a simple Magento module that outputs a Purchase event using the Google Tag Manager API. This Purchase event should only appear in the Magento Checkout Success page.

## Installation
 - This module is developed for `Magento ver. 2.3.*` enterprise version
 - This module has dependency on core `Magento_GoogleTagManager` module

### Type 1: Zip file

 - Unzip the zip file in `app/code/Studio3Marketing`
 - Enable the module by running `php bin/magento module:enable Studio3Marketing_GoogleTagManager`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

## Configuration
 - After Installation confirm following configuration. 
  1) Go to `Stores > Configuration > SALES > Google API > Google Analytics`
  2) Select `Account type = Google Tag Manager`
  3) Insert your Google Tag Manager Container Id = GTM-`XXXXXXX`
  
  <a href="#"><img src="https://iili.io/GFRRDP.th.png" border="0"></a>
## Specifications

 - Plugin
	- aroundGetOrdersDataArray - Magento\GoogleTagManager\Block\Ga > Studio3Marketing\GoogleTagManager\Plugin\Magento\GoogleTagManager\Block\Ga


## Attributes



