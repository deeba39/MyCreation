<?php

// Call Row_Rendering event
$scholarship_package->Row_Rendering();

// scholarship_package_id
$scholarship_package->scholarship_package_id->CellCssStyle = ""; $scholarship_package->scholarship_package_id->CellCssClass = "";
$scholarship_package->scholarship_package_id->CellAttrs = array(); $scholarship_package->scholarship_package_id->ViewAttrs = array(); $scholarship_package->scholarship_package_id->EditAttrs = array();

// start_date
$scholarship_package->start_date->CellCssStyle = ""; $scholarship_package->start_date->CellCssClass = "";
$scholarship_package->start_date->CellAttrs = array(); $scholarship_package->start_date->ViewAttrs = array(); $scholarship_package->start_date->EditAttrs = array();

// end_date
$scholarship_package->end_date->CellCssStyle = ""; $scholarship_package->end_date->CellCssClass = "";
$scholarship_package->end_date->CellAttrs = array(); $scholarship_package->end_date->ViewAttrs = array(); $scholarship_package->end_date->EditAttrs = array();

// status
$scholarship_package->status->CellCssStyle = ""; $scholarship_package->status->CellCssClass = "";
$scholarship_package->status->CellAttrs = array(); $scholarship_package->status->ViewAttrs = array(); $scholarship_package->status->EditAttrs = array();

// annual_amount
$scholarship_package->annual_amount->CellCssStyle = ""; $scholarship_package->annual_amount->CellCssClass = "";
$scholarship_package->annual_amount->CellAttrs = array(); $scholarship_package->annual_amount->ViewAttrs = array(); $scholarship_package->annual_amount->EditAttrs = array();

// grant_package_grant_package_id
$scholarship_package->grant_package_grant_package_id->CellCssStyle = ""; $scholarship_package->grant_package_grant_package_id->CellCssClass = "";
$scholarship_package->grant_package_grant_package_id->CellAttrs = array(); $scholarship_package->grant_package_grant_package_id->ViewAttrs = array(); $scholarship_package->grant_package_grant_package_id->EditAttrs = array();

// sponsored_student_sponsored_student_id
$scholarship_package->sponsored_student_sponsored_student_id->CellCssStyle = ""; $scholarship_package->sponsored_student_sponsored_student_id->CellCssClass = "";
$scholarship_package->sponsored_student_sponsored_student_id->CellAttrs = array(); $scholarship_package->sponsored_student_sponsored_student_id->ViewAttrs = array(); $scholarship_package->sponsored_student_sponsored_student_id->EditAttrs = array();

// scholarship_type
$scholarship_package->scholarship_type->CellCssStyle = ""; $scholarship_package->scholarship_type->CellCssClass = "";
$scholarship_package->scholarship_type->CellAttrs = array(); $scholarship_package->scholarship_type->ViewAttrs = array(); $scholarship_package->scholarship_type->EditAttrs = array();

// scholarship_type_scholarship_type
$scholarship_package->scholarship_type_scholarship_type->CellCssStyle = ""; $scholarship_package->scholarship_type_scholarship_type->CellCssClass = "";
$scholarship_package->scholarship_type_scholarship_type->CellAttrs = array(); $scholarship_package->scholarship_type_scholarship_type->ViewAttrs = array(); $scholarship_package->scholarship_type_scholarship_type->EditAttrs = array();

// Call Row_Rendered event
$scholarship_package->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $scholarship_package->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $scholarship_package->scholarship_package_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $scholarship_package->start_date->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $scholarship_package->end_date->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $scholarship_package->status->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $scholarship_package->annual_amount->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $scholarship_package->grant_package_grant_package_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $scholarship_package->sponsored_student_sponsored_student_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $scholarship_package->scholarship_type->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $scholarship_package->scholarship_type_scholarship_type->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $scholarship_package->scholarship_package_id->CellAttributes() ?>>
<div<?php echo $scholarship_package->scholarship_package_id->ViewAttributes() ?>><?php echo $scholarship_package->scholarship_package_id->ListViewValue() ?></div></td>
			<td<?php echo $scholarship_package->start_date->CellAttributes() ?>>
<div<?php echo $scholarship_package->start_date->ViewAttributes() ?>><?php echo $scholarship_package->start_date->ListViewValue() ?></div></td>
			<td<?php echo $scholarship_package->end_date->CellAttributes() ?>>
<div<?php echo $scholarship_package->end_date->ViewAttributes() ?>><?php echo $scholarship_package->end_date->ListViewValue() ?></div></td>
			<td<?php echo $scholarship_package->status->CellAttributes() ?>>
<div<?php echo $scholarship_package->status->ViewAttributes() ?>><?php echo $scholarship_package->status->ListViewValue() ?></div></td>
			<td<?php echo $scholarship_package->annual_amount->CellAttributes() ?>>
<div<?php echo $scholarship_package->annual_amount->ViewAttributes() ?>><?php echo $scholarship_package->annual_amount->ListViewValue() ?></div></td>
			<td<?php echo $scholarship_package->grant_package_grant_package_id->CellAttributes() ?>>
<div<?php echo $scholarship_package->grant_package_grant_package_id->ViewAttributes() ?>><?php echo $scholarship_package->grant_package_grant_package_id->ListViewValue() ?></div></td>
			<td<?php echo $scholarship_package->sponsored_student_sponsored_student_id->CellAttributes() ?>>
<div<?php echo $scholarship_package->sponsored_student_sponsored_student_id->ViewAttributes() ?>><?php echo $scholarship_package->sponsored_student_sponsored_student_id->ListViewValue() ?></div></td>
			<td<?php echo $scholarship_package->scholarship_type->CellAttributes() ?>>
<div<?php echo $scholarship_package->scholarship_type->ViewAttributes() ?>><?php echo $scholarship_package->scholarship_type->ListViewValue() ?></div></td>
			<td<?php echo $scholarship_package->scholarship_type_scholarship_type->CellAttributes() ?>>
<div<?php echo $scholarship_package->scholarship_type_scholarship_type->ViewAttributes() ?>><?php echo $scholarship_package->scholarship_type_scholarship_type->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
