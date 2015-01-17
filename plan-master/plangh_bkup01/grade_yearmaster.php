<?php

// Call Row_Rendering event
$grade_year->Row_Rendering();

// class
$grade_year->class->CellCssStyle = ""; $grade_year->class->CellCssClass = "";
$grade_year->class->CellAttrs = array(); $grade_year->class->ViewAttrs = array(); $grade_year->class->EditAttrs = array();

// year
$grade_year->year->CellCssStyle = ""; $grade_year->year->CellCssClass = "";
$grade_year->year->CellAttrs = array(); $grade_year->year->ViewAttrs = array(); $grade_year->year->EditAttrs = array();

// promoted
$grade_year->promoted->CellCssStyle = ""; $grade_year->promoted->CellCssClass = "";
$grade_year->promoted->CellAttrs = array(); $grade_year->promoted->ViewAttrs = array(); $grade_year->promoted->EditAttrs = array();

// programme
$grade_year->programme->CellCssStyle = ""; $grade_year->programme->CellCssClass = "";
$grade_year->programme->CellAttrs = array(); $grade_year->programme->ViewAttrs = array(); $grade_year->programme->EditAttrs = array();

// Call Row_Rendered event
$grade_year->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $grade_year->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $grade_year->class->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $grade_year->year->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $grade_year->promoted->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $grade_year->programme->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $grade_year->class->CellAttributes() ?>>
<div<?php echo $grade_year->class->ViewAttributes() ?>><?php echo $grade_year->class->ListViewValue() ?></div></td>
			<td<?php echo $grade_year->year->CellAttributes() ?>>
<div<?php echo $grade_year->year->ViewAttributes() ?>><?php echo $grade_year->year->ListViewValue() ?></div></td>
			<td<?php echo $grade_year->promoted->CellAttributes() ?>>
<div<?php echo $grade_year->promoted->ViewAttributes() ?>><?php echo $grade_year->promoted->ListViewValue() ?></div></td>
			<td<?php echo $grade_year->programme->CellAttributes() ?>>
<div<?php echo $grade_year->programme->ViewAttributes() ?>><?php echo $grade_year->programme->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
