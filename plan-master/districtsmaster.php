<?php

// Call Row_Rendering event
$districts->Row_Rendering();

// DistrictID
$districts->DistrictID->CellCssStyle = ""; $districts->DistrictID->CellCssClass = "";
$districts->DistrictID->CellAttrs = array(); $districts->DistrictID->ViewAttrs = array(); $districts->DistrictID->EditAttrs = array();

// District
$districts->District->CellCssStyle = ""; $districts->District->CellCssClass = "";
$districts->District->CellAttrs = array(); $districts->District->ViewAttrs = array(); $districts->District->EditAttrs = array();

// RegionID
$districts->RegionID->CellCssStyle = ""; $districts->RegionID->CellCssClass = "";
$districts->RegionID->CellAttrs = array(); $districts->RegionID->ViewAttrs = array(); $districts->RegionID->EditAttrs = array();

// programarea_programarea_id
$districts->programarea_programarea_id->CellCssStyle = ""; $districts->programarea_programarea_id->CellCssClass = "";
$districts->programarea_programarea_id->CellAttrs = array(); $districts->programarea_programarea_id->ViewAttrs = array(); $districts->programarea_programarea_id->EditAttrs = array();

// Call Row_Rendered event
$districts->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $districts->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $districts->DistrictID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $districts->District->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $districts->RegionID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $districts->programarea_programarea_id->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $districts->DistrictID->CellAttributes() ?>>
<div<?php echo $districts->DistrictID->ViewAttributes() ?>><?php echo $districts->DistrictID->ListViewValue() ?></div></td>
			<td<?php echo $districts->District->CellAttributes() ?>>
<div<?php echo $districts->District->ViewAttributes() ?>><?php echo $districts->District->ListViewValue() ?></div></td>
			<td<?php echo $districts->RegionID->CellAttributes() ?>>
<div<?php echo $districts->RegionID->ViewAttributes() ?>><?php echo $districts->RegionID->ListViewValue() ?></div></td>
			<td<?php echo $districts->programarea_programarea_id->CellAttributes() ?>>
<div<?php echo $districts->programarea_programarea_id->ViewAttributes() ?>><?php echo $districts->programarea_programarea_id->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
