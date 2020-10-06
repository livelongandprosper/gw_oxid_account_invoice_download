<?php
/**
 * @abstract
 * @author 	Gregor Wendland <gregor@gewend.de>
 * @copyright Copyright (c) 2018-2019, Gregor Wendland
 * @package gw
 * @version 2019-08-21
 */

/**
 * Metadata version
 */
$sMetadataVersion = '2.1'; // see https://docs.oxid-esales.com/developer/en/6.0/modules/skeleton/metadataphp/version20.html

/**
 * Module information
 */
$aModule = array(
    'id'           => 'gw_oxid_account_invoice_download',
    'title'        => 'Rechnungsdownload im Benutzer-Account',
//     'thumbnail'    => 'out/admin/img/logo.jpg',
    'version'      => '1.0.1',
    'author'       => 'Gregor Wendland',
    'email'		   => 'kontakt@gewend.de',
    'url'		   => 'https://www.gewend.de',
    'description'  => array(
    	'de'		=> 'Ermöglicht den Download von Rechnungen zu getätigen Bestellungen in der Bestellhistorie.
							<ul>
								<li>Unter '.oxRegistry::getConfig()->getShopUrl().'index.php?cl=account_order ist bei jeder Bestellung ein Rchnungsdownload-Link vorhanden, falls verfügbar</li>
								<li>Es muss im Template page/account/order.tpl der Smarty-Block gw_oxid_account_invoice_download_link angelegt werden</li>
							</ul>
						',
    ),
    'extend'       => array(
		\OxidEsales\Eshop\Core\ViewConfig::class => gw\gw_oxid_account_invoice_download\Core\ViewConfig::class,
		\OxidEsales\Eshop\Application\Controller\AccountOrderController::class => gw\gw_oxid_account_invoice_download\Application\Controller\AccountOrderController::class,
		\OxidEsales\Eshop\Application\Model\Order::class => gw\gw_oxid_account_invoice_download\Application\Model\Order::class,

    ),
    'settings'		=> array(
		array( 'group' => 'general', 	'name' => 'gw_invoice_glob_pattern', 'type' => 'str', 'value' => '*_[ordernr].pdf'),
		array( 'group' => 'general', 	'name' => 'gw_invoice_download_file', 'type' => 'bool', 'value' => 'true'),
	),
	'events'		=> array(
    ),
	'blocks' => array(
		/*
		// backend
		array(
			'template' => 'content_main.tpl',
			'block' => 'admin_content_main_form',
			'file' => 'Application/views/blocks/admin/admin_content_main_form.tpl'
		),
		*/
		// frontend
		array(
			'template' => 'page/account/order.tpl',
			'block' => 'gw_oxid_account_invoice_download_link',
			'file' => 'Application/views/blocks/gw_oxid_account_invoice_download_link.tpl'
		),
	),
	'events'       => array(
		'onActivate'   => '\gw\gw_oxid_account_invoice_download\Core\Events::onActivate',
		'onDeactivate' => '\gw\gw_oxid_account_invoice_download\Core\Events::onDeactivate'
	),
	'controllers'  => [
		// controller frontend
		// 'gw_oxid_account_invoice_download' => gw\gw_oxid_account_invoice_download\Application\Controller\AccountOrderController::class,
	],
	'templates' => [
		/* admin templates */
		// 'gw_oxid_data_export_article_infos.tpl'		=> 'gw/gw_oxid_data_export/application/views/admin/tpl/gw_oxid_data_export_article_infos.tpl',

		/* frontend */
		// 'page/account/gw_invoice_download.tpl' => 'gw/gw_oxid_account_invoice_download/Application/views/tpl/page/account/gw_invoice_download.tpl',
	]
);
?>
