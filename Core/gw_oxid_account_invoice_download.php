<?php
namespace gw\gw_oxid_account_invoice_download\Core;

use OxidEsales\Eshop\Core\Registry;

class gw_oxid_account_invoice_download {
	/**
	 * @var string
	 */
    public static $invoiceFolderName = 'gw_invoice';

	/**
	 * @var null
	 */
    private static $invoiceFolderPath = null;

	/**
	 * @return string|null
	 */
    public static function getInvoiceFolderPath(){
    	if(self::$invoiceFolderPath === null) {
			self::$invoiceFolderPath = Registry::getConfig()->getOutDir() . self::$invoiceFolderName . DIRECTORY_SEPARATOR;
		}

    	return self::$invoiceFolderPath;
	}

	/**
	 *
	 */
	public static  function checkInvoiceDirectory() {
		$everythingsFine = true;
		if( !is_dir( self::getInvoiceFolderPath() ) ){
			// create directory if it's not existing
			if(!mkdir(self::getInvoiceFolderPath())){
				$everythingsFine = false;
			}
			chmod ( self::getInvoiceFolderPath() , 0770 );
		}
		// create .htaccess file if it's not existing
		if( !is_file( self::getInvoiceFolderPath() . '.htaccess' ) ) {
			if(!file_put_contents( self::getInvoiceFolderPath() . '.htaccess' , 'deny from all' )) {
				$everythingsFine = false;
			}
			chmod ( self::getInvoiceFolderPath() . '.htaccess' , 0444 );
		}

		return $everythingsFine;
	}
}
