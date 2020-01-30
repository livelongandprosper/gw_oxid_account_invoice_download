<?php
namespace gw\gw_oxid_account_invoice_download\Application\Controller;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\DbMetaDataHandler;
use OxidEsales\Eshop\Core\DatabaseProvider;
use gw\gw_oxid_account_invoice_download\Core\gw_oxid_account_invoice_download;

/**
 * @see OxidEsales\Eshop\Application\Controller\AccountOrderController
 */
class AccountOrderController extends \OxidEsales\Eshop\Application\Controller\AccountOrderController {

	/**
	 *
	 */
	public function invoice_download() {
		$config = \OxidEsales\Eshop\Core\Registry::getConfig();
		$oHeader = oxNew('oxHeader');

		// get request params
		$requestedFilename = $config->getRequestParameter("file");
		$requestedOrderId = $config->getRequestParameter("ordernumber");

		// get active user
		$activeUser = $this->getUser();

		if(!gw_oxid_account_invoice_download::checkInvoiceDirectory()) {
			// if invoice directory is not ok, prevent download
			$oHeader->setNonCacheable();
			$oHeader->setHeader("Content-Type: text/html");
			$oHeader->setHeader("Pragma: no-cache");
			$oHeader->setHeader("Expires: 0");
			$oHeader->sendHeader();
			OxidEsales\EshopCommunity\Core\Registry::getUtils()->showMessageAndExit('Error: gw_oxid_account_invoice_download-001');
		} else {
			if ($activeUser) {
				$userOrders = $activeUser->getOrders();
				if($userOrders) {
					if($userOrders->offsetExists($requestedOrderId)) {

						$order = oxNew(Order::class);
						$order->load($requestedOrderId);
						$invoicePdfPath = gw_oxid_account_invoice_download::getInvoiceFolderPath() . $requestedFilename;
						if($order->isInvoiceDownloadAllowed($invoicePdfPath)) {
							// set headers
							$oHeader->setNonCacheable();
							$oHeader->setHeader("Content-Type: application/pdf");

							if($config->getConfigParam('gw_invoice_download_file')) {
								$oHeader->setHeader("Content-Disposition: attachment; filename=".urlencode($requestedFilename));
							}
							$oHeader->setHeader("Pragma: no-cache");
							$oHeader->setHeader("Expires: 0");
							$oHeader->sendHeader();

							// TODO: put the pdf file content here
							Registry::getUtils()->showMessageAndExit(file_get_contents($invoicePdfPath));
						} else {
							$oHeader->setHeader('HTTP/1.1 401 Unauthorized');
							$oHeader->setHeader("Content-Type: text/html");
							echo "Unauthorized file";
							$oHeader->sendHeader();
							exit;
						}
					} else {
						$oHeader->setHeader('HTTP/1.1 401 Unauthorized');
						$oHeader->setHeader("Content-Type: text/html");
						echo "Unauthorized order";
						$oHeader->sendHeader();
						exit;
					}
				}
			}
		}
	}
}
