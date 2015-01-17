<?php

// Call Row_Rendering event
$grant_package->Row_Rendering();

// name
$grant_package->name->CellCssStyle = ""; $grant_package->name->CellCssClass = "";
$grant_package->name->CellAttrs = array(); $grant_package->name->ViewAttrs = array(); $grant_package->name->EditAttrs = array();

// code
$grant_package->code->CellCssStyle = ""; $grant_package->code->CellCssClass = "";
$grant_package->code->CellAttrs = array(); $grant_package->code->ViewAttrs = array(); $grant_package->code->EditAttrs = array();

// annual_amount
$grant_package->annual_amount->CellCssStyle = ""; $grant_package->annual_amount->CellCssClass = "";
$grant_package->annual_amount->CellAttrs = array(); $grant_package->annual_amount->ViewAttrs = array(); $grant_package->annual_amount->EditAttrs = array();

// Call Row_Rendered event
$grant_package->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $grant_package->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $grant_package->name->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $grant_package->code->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $grant_package->annual_amount->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $grant_package->name->CellAttributes() ?>>
<div<?php echo $grant_package->name->ViewAttributes() ?>><?php echo $grant_package->name->ListViewValue() ?></div></td>
			<td<?php echo $grant_package->code->CellAttributes() ?>>
<div<?php echo $grant_package->code->ViewAttributes() ?>><?php echo $grant_package->code->ListViewValue() ?></div></td>
			<td<?php echo $grant_package->annual_amount->CellAttributes() ?>>
<div<?php echo $grant_package->annual_amount->ViewAttributes() ?>><?php echo $grant_package->annual_amount->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
