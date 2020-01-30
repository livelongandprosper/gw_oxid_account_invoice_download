[{$smarty.block.parent}]
[{foreach from=$order->getInvoiceUrls() item="invoicepdf"}]
    <div class="gw-invoice">
        <span class="gw-invoice-download-prefix">[{oxmultilang ident="GW_INVOICE_DOWNLOAD" suffix="COLON"}]</span> <a href="[{$invoicepdf.href}]" target="_blank">[{$invoicepdf.filename}]</a>
    </div>
[{/foreach}]
