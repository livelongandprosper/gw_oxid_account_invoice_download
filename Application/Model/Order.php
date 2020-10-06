<?php
namespace gw\gw_oxid_account_invoice_download\Application\Model;
use gw\gw_oxid_account_invoice_download\Core;
use OxidEsales\Eshop\Core\Registry;

class Order extends Order_parent {

	private $_invoicePaths = null;

	/**
	 * Get all Invoice URLs of an order
	 * @return array of urls
	 */
    public function getInvoiceUrls() {
		$filenames = array();
		$files = $this->getInvoicePaths();

		// create return array
		if(is_array($files) && sizeof($files) > 0) {
			foreach ($files as $file) {
				$filenames[] = array(
					"href" => Registry::getConfig()->getShopUrl().'index.php?cl=account_order&fnc=invoice_download&ordernumber='.urlencode($this->getId()).'&file='.urlencode(basename($file)),
					"filename" => basename($file),
				);
			}
		}
/*
		echo "<pre>";
		print_r($filenames);
		echo "</pre>";
		exit;
*/
    	return $filenames;
	}

	/**
	 * @param $filepath
	 * @return bool
	 */
	public function isInvoiceDownloadAllowed($filepath) {
		if($this->oxorder__oxordernr->value) {
			$allowed_files = $this->getInvoicePaths();
			return in_array($filepath, $allowed_files);
		}

		return false;
	}

	/**
	 * Gets invoice file names
	 * Paceholders: [ordernr]
	 * @return array|null
	 */
	private function getInvoicePaths() {
		if($this->_invoicePaths === null) {
			if('' != $this->oxorder__oxordernr->value) {
				$config = \OxidEsales\Eshop\Core\Registry::getConfig();
				$dir = Core\gw_oxid_account_invoice_download::getInvoiceFolderPath();
				$this->_invoicePaths = array();

				// get all files with pattern
				if($glob_pattern = $config->getConfigParam('gw_invoice_glob_pattern')) {
					if(strstr($glob_pattern, '[ordernr]') !== false) {
						$this->_invoicePaths = glob($dir. str_replace('[ordernr]', $this->oxorder__oxordernr->value, $glob_pattern));
					} else {
						$logger = Registry::getLogger();
						$logger->error('There has to be an correct pattern gw_invoice_glob_pattern to correctly identify user invoices', [__CLASS__, __FUNCTION__]);
					}
				} else {
					$this->_invoicePaths = glob($dir.'*_'.$this->oxorder__oxordernr->value.'.pdf');
				}
			} else {
				$this->_invoicePaths = array();
			}
		}
		return $this->_invoicePaths;
	}
}
