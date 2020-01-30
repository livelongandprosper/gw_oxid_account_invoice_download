[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

<script type="text/javascript">
<!--
function editThis( sID )
{
    var oTransfer = top.basefrm.edit.document.getElementById( "transfer" );
    oTransfer.oxid.value = sID;
    oTransfer.cl.value = top.basefrm.list.sDefClass;

    //forcing edit frame to reload after submit
    top.forceReloadingEditFrame();

    var oSearch = top.basefrm.list.document.getElementById( "search" );
    oSearch.oxid.value = sID;
    oSearch.actedit.value = 0;
    oSearch.submit();
}
[{if !$oxparentid}]
window.onload = function ()
{
    [{ if $updatelist == 1}]
        top.oxid.admin.updateList('[{ $oxid }]');
    [{ /if}]
    var oField = top.oxid.admin.getLockTarget();
    oField.onchange = oField.onkeyup = oField.onmouseout = top.oxid.admin.unlockSave;
}
[{/if}]
//-->
</script>

[{ if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="oxidCopy" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="article_main">
    <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
</form>


	<table cellspacing="0" cellpadding="0" border="0" style="width:98%;">
        <form name="myedit" id="myedit" action="[{ $oViewConf->getSelfLink() }]" enctype="multipart/form-data" method="post" style="padding: 0px;margin: 0px;height:0px;">
	        [{$oViewConf->getHiddenSid()}]
	        <input type="hidden" name="cl" value="gw_oxid_data_export_article_infos">
	        <input type="hidden" name="fnc" value="save">
	        <input type="hidden" name="oxid" value="[{ $oxid }]">
	        <input type="hidden" name="voxid" value="[{ $oxid }]">
	        <input type="hidden" name="oxparentid" value="[{ $oxparentid }]">
	        <input type="hidden" name="editval[oxarticles__oxid]" value="[{ $oxid }]">
			<tr>
				<td valign="top" class="edittext" style="padding-top:10px;padding-left:10px;">
					<div style="height: 550px;overflow-y: auto;">
						<table cellspacing="0" cellpadding="0" border="0">
						[{ if $errorsavingatricle }]
							<tr>
								<td colspan="2">
									[{ if $errorsavingatricle eq 1 }]
										<div class="errorbox">[{ oxmultilang ident="ARTICLE_MAIN_ERRORSAVINGARTICLE" }]</div>
									[{/if}]
								</td>
							</tr>
						[{ /if}]
						[{ if $invalid_tags }]
							<tr>
								<td colspan="2">
									<div class="errorbox">[{ oxmultilang ident="ARTICLE_MAIN_INVALIDTAGSFOUND" }]: [{$invalid_tags}]</div>
								</td>
							</tr>
						[{ /if}]
						[{ if $oxparentid }]
							<tr>
								<td class="edittext" width="120">
									<b>[{ oxmultilang ident="ARTICLE_IS_CAR_ARTICLE" }]</b>
								</td>
								<td class="edittext">
									<a href="Javascript:editThis('[{ $parentarticle->oxarticles__oxid->value}]');" class="edittext"><b>[{ $parentarticle->oxarticles__oxartnum->value }] [{ $parentarticle->oxarticles__oxtitle->value}] [{if !$parentarticle->oxarticles__oxtitle->value }][{ $parentarticle->oxarticles__oxvarselect->value }][{/if}]</b></a>
								</td>
							</tr>
						[{/if}]

						<!-- here comes our own stuff -->

						<!-- WARENGRUPPE -->
						<tr>
							<td class="edittext" width="120">
								Warengruppe
							</td>
                            <td class="edittext">
                                <input type="text" class="editinput" size="32" maxlength="[{$edit->oxarticles__gw_export_category->fldmax_length}]" name="editval[oxarticles__gw_export_category]" value="[{$edit->oxarticles__gw_export_category->value}]" [{ $readonly }]>
                                [{* oxinputhelp ident="HELP_ARTICLE_MAIN_ARTNUM" *}]
                            </td>
						</tr>

						<!-- FARBE -->
						<tr>
							<td class="edittext" width="120">
								Farbe
							</td>
                            <td class="edittext">
                                <input type="text" class="editinput" size="32" maxlength="[{$edit->oxarticles__gw_export_colorname->fldmax_length}]" name="editval[oxarticles__gw_export_colorname]" value="[{$edit->oxarticles__gw_export_colorname->value}]" [{ $readonly }]>
                                [{* oxinputhelp ident="HELP_ARTICLE_MAIN_ARTNUM" *}]
                            </td>
						</tr>

						<!-- FARB ID -->
						<tr>
							<td class="edittext" width="120">
								Farb-ID
							</td>
                            <td class="edittext">
                                <input type="text" class="editinput" size="32" maxlength="[{$edit->oxarticles__gw_export_colorid->fldmax_length}]" name="editval[oxarticles__gw_export_colorid]" value="[{$edit->oxarticles__gw_export_colorid->value}]" [{ $readonly }]>
                                [{* oxinputhelp ident="HELP_ARTICLE_MAIN_ARTNUM" *}]
                            </td>
						</tr>

						<!-- MATERIAL -->
						<tr>
							<td class="edittext" width="120">
								Material
							</td>
                            <td class="edittext">
                                <input type="text" class="editinput" size="32" maxlength="[{$edit->oxarticles__gw_export_material->fldmax_length}]" name="editval[oxarticles__gw_export_material]" value="[{$edit->oxarticles__gw_export_material->value}]" [{ $readonly }]>
                                [{* oxinputhelp ident="HELP_ARTICLE_MAIN_ARTNUM" *}]
                            </td>
						</tr>

						<!-- that was all of the fun -->

						<tr>
							<td class="edittext" colspan="2"><br><br>
								<input type="submit" class="edittext" id="oLockButton" name="saveArticle" value="[{ oxmultilang ident="ARTICLE_MAIN_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='save'" [{ $readonly }]>
							</td>
						</tr>
						[{if $oxid == -1}]
							<tr>
								<td class="edittext">
									[{ oxmultilang ident="ARTICLE_MAIN_INCATEGORY" }]
								</td>
								<td class="edittext">
									<select name="art_category" class="editinput" onChange="Javascript:top.oxid.admin.changeLstrt()" [{ $readonly }]>
										<option value="-1">[{ oxmultilang ident="ARTICLE_MAIN_NONE" }]</option>
										[{foreach from=$oView->getCategoryList() item=pcat}]
											<option value="[{ $pcat->oxcategories__oxid->value }]">[{ $pcat->oxcategories__oxtitle->value|oxtruncate:40:"..":true }]</option>
										[{/foreach}]
									</select>
									[{ oxinputhelp ident="HELP_" }]
								</td>
							</tr>
						[{/if}]
						</table>
					</div>
				</td>
			</tr>
		</form>
	</table>


[{include file="bottomnaviitem.tpl"}]

[{include file="bottomitem.tpl"}]
