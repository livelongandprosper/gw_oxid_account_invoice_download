# Invoice Download in Account

This module for OXID eShop makes it possible to upload invoices which are related to orders and make them available as download for users.

## Install
- This module has to be put to the folder
\[shop root\]**/modules/gw/gw_oxid_account_invoice_download/**

- You also have to create a file
\[shop root\]/modules/gw/**vendormetadata.php**

- add content in composer_add_to_root.json to your global composer.json file and call **composer dumpautoload**

- you have to add the Smarty Block **gw_oxid_account_invoice_download_link to template** **Application/views/[theme]]/tpl/page/account/order.tpl** within the order foreach loop

## Activate
After you have done install stuff go to shop backend and activate module.

## Usage
- Take a look at the module settings (German only for the moment)
![Screenshot of Backend Settings](https://raw.githubusercontent.com/livelongandprosper/gw_oxid_account_invoice_download/master/_screenshot_settings.jpeg)

- Upload invoices with a correct filename pattern to **/out/gw_incoice**

## License
See LICENSE file.
