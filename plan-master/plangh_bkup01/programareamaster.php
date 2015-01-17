<?php

// Call Row_Rendering event
$programarea->Row_Rendering();

// programarea_name
$programarea->programarea_name->CellCssStyle = ""; $programarea->programarea_name->CellCssClass = "";
$programarea->programarea_name->CellAttrs = array(); $programarea->programarea_name->ViewAttrs = array(); $programarea->programarea_name->EditAttrs = array();

// regionID
$programarea->regionID->CellCssStyle = ""; $programarea->regionID->CellCssClass = "";
$programarea->regionID->CellAttrs = array(); $programarea->regionID->ViewAttrs = array(); $programarea->regionID->EditAttrs = array();

// Call Row_Rendered event
$programarea->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $programarea->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $programarea->programarea_name->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $programarea->regionID->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $programarea->programarea_name->CellAttributes() ?>>
<div<?php echo $programarea->programarea_name->ViewAttributes() ?>><?php echo $programarea->programarea_name->ListViewValue() ?></div></td>
			<td<?php echo $programarea->regionID->CellAttributes() ?>>
<div<?php echo $programarea->regionID->ViewAttributes() ?>><?php echo $programarea->regionID->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
