<?php

// Call Row_Rendering event
$community->Row_Rendering();

// community
$community->community_1->CellCssStyle = ""; $community->community_1->CellCssClass = "";
$community->community_1->CellAttrs = array(); $community->community_1->ViewAttrs = array(); $community->community_1->EditAttrs = array();

// programarea_programarea_id
$community->programarea_programarea_id->CellCssStyle = ""; $community->programarea_programarea_id->CellCssClass = "";
$community->programarea_programarea_id->CellAttrs = array(); $community->programarea_programarea_id->ViewAttrs = array(); $community->programarea_programarea_id->EditAttrs = array();

// community_category_community_category_id
$community->community_category_community_category_id->CellCssStyle = ""; $community->community_category_community_category_id->CellCssClass = "";
$community->community_category_community_category_id->CellAttrs = array(); $community->community_category_community_category_id->ViewAttrs = array(); $community->community_category_community_category_id->EditAttrs = array();

// community_districts_DistrictID
$community->community_districts_DistrictID->CellCssStyle = ""; $community->community_districts_DistrictID->CellCssClass = "";
$community->community_districts_DistrictID->CellAttrs = array(); $community->community_districts_DistrictID->ViewAttrs = array(); $community->community_districts_DistrictID->EditAttrs = array();

// Call Row_Rendered event
$community->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $community->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $community->community_1->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $community->programarea_programarea_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $community->community_category_community_category_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $community->community_districts_DistrictID->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $community->community_1->CellAttributes() ?>>
<div<?php echo $community->community_1->ViewAttributes() ?>><?php echo $community->community_1->ListViewValue() ?></div></td>
			<td<?php echo $community->programarea_programarea_id->CellAttributes() ?>>
<div<?php echo $community->programarea_programarea_id->ViewAttributes() ?>><?php echo $community->programarea_programarea_id->ListViewValue() ?></div></td>
			<td<?php echo $community->community_category_community_category_id->CellAttributes() ?>>
<div<?php echo $community->community_category_community_category_id->ViewAttributes() ?>><?php echo $community->community_category_community_category_id->ListViewValue() ?></div></td>
			<td<?php echo $community->community_districts_DistrictID->CellAttributes() ?>>
<div<?php echo $community->community_districts_DistrictID->ViewAttributes() ?>><?php echo $community->community_districts_DistrictID->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
