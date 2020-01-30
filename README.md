# Invoice Download in Account

...

## Install
- This module has to be put to the folder
\[shop root\]**/modules/gw/gw_oxid_account_invoice_download/**

- You also have to create a file
\[shop root\]/modules/gw/**vendormetadata.php**

- add content in composer_add_to_root.json to your global composer.json file and call **composer update --no-dev**

- you have to add the Smarty Block gw_oxid_account_invoice_download_link to template Application/views/[theme]]/tpl/page/account/order.tpl within the order foreach loop

After you have done that go to shop backend and activate module.
