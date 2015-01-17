<?php

// Call Row_Rendering event
$sponsored_student_detail->Row_Rendering();

// student_firstname
$sponsored_student_detail->student_firstname->CellCssStyle = ""; $sponsored_student_detail->student_firstname->CellCssClass = "";
$sponsored_student_detail->student_firstname->CellAttrs = array(); $sponsored_student_detail->student_firstname->ViewAttrs = array(); $sponsored_student_detail->student_firstname->EditAttrs = array();

// student_middlename
$sponsored_student_detail->student_middlename->CellCssStyle = ""; $sponsored_student_detail->student_middlename->CellCssClass = "";
$sponsored_student_detail->student_middlename->CellAttrs = array(); $sponsored_student_detail->student_middlename->ViewAttrs = array(); $sponsored_student_detail->student_middlename->EditAttrs = array();

// student_lastname
$sponsored_student_detail->student_lastname->CellCssStyle = ""; $sponsored_student_detail->student_lastname->CellCssClass = "";
$sponsored_student_detail->student_lastname->CellAttrs = array(); $sponsored_student_detail->student_lastname->ViewAttrs = array(); $sponsored_student_detail->student_lastname->EditAttrs = array();

// student_telephone_1
$sponsored_student_detail->student_telephone_1->CellCssStyle = ""; $sponsored_student_detail->student_telephone_1->CellCssClass = "";
$sponsored_student_detail->student_telephone_1->CellAttrs = array(); $sponsored_student_detail->student_telephone_1->ViewAttrs = array(); $sponsored_student_detail->student_telephone_1->EditAttrs = array();

// student_telephone_2
$sponsored_student_detail->student_telephone_2->CellCssStyle = ""; $sponsored_student_detail->student_telephone_2->CellCssClass = "";
$sponsored_student_detail->student_telephone_2->CellAttrs = array(); $sponsored_student_detail->student_telephone_2->ViewAttrs = array(); $sponsored_student_detail->student_telephone_2->EditAttrs = array();

// student_dob
$sponsored_student_detail->student_dob->CellCssStyle = ""; $sponsored_student_detail->student_dob->CellCssClass = "";
$sponsored_student_detail->student_dob->CellAttrs = array(); $sponsored_student_detail->student_dob->ViewAttrs = array(); $sponsored_student_detail->student_dob->EditAttrs = array();

// age
$sponsored_student_detail->age->CellCssStyle = ""; $sponsored_student_detail->age->CellCssClass = "";
$sponsored_student_detail->age->CellAttrs = array(); $sponsored_student_detail->age->ViewAttrs = array(); $sponsored_student_detail->age->EditAttrs = array();

// student_gender
$sponsored_student_detail->student_gender->CellCssStyle = ""; $sponsored_student_detail->student_gender->CellCssClass = "";
$sponsored_student_detail->student_gender->CellAttrs = array(); $sponsored_student_detail->student_gender->ViewAttrs = array(); $sponsored_student_detail->student_gender->EditAttrs = array();

// student_address
$sponsored_student_detail->student_address->CellCssStyle = ""; $sponsored_student_detail->student_address->CellCssClass = "";
$sponsored_student_detail->student_address->CellAttrs = array(); $sponsored_student_detail->student_address->ViewAttrs = array(); $sponsored_student_detail->student_address->EditAttrs = array();

// app_submission_year
$sponsored_student_detail->app_submission_year->CellCssStyle = ""; $sponsored_student_detail->app_submission_year->CellCssClass = "";
$sponsored_student_detail->app_submission_year->CellAttrs = array(); $sponsored_student_detail->app_submission_year->ViewAttrs = array(); $sponsored_student_detail->app_submission_year->EditAttrs = array();

// community
$sponsored_student_detail->community->CellCssStyle = ""; $sponsored_student_detail->community->CellCssClass = "";
$sponsored_student_detail->community->CellAttrs = array(); $sponsored_student_detail->community->ViewAttrs = array(); $sponsored_student_detail->community->EditAttrs = array();

// student_resident_programarea_id
$sponsored_student_detail->student_resident_programarea_id->CellCssStyle = ""; $sponsored_student_detail->student_resident_programarea_id->CellCssClass = "";
$sponsored_student_detail->student_resident_programarea_id->CellAttrs = array(); $sponsored_student_detail->student_resident_programarea_id->ViewAttrs = array(); $sponsored_student_detail->student_resident_programarea_id->EditAttrs = array();

// District
$sponsored_student_detail->District->CellCssStyle = ""; $sponsored_student_detail->District->CellCssClass = "";
$sponsored_student_detail->District->CellAttrs = array(); $sponsored_student_detail->District->ViewAttrs = array(); $sponsored_student_detail->District->EditAttrs = array();

// Call Row_Rendered event
$sponsored_student_detail->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $sponsored_student_detail->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_firstname->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_middlename->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_lastname->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_telephone_1->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_telephone_2->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_dob->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student_detail->age->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_gender->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_address->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student_detail->app_submission_year->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student_detail->community->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_resident_programarea_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student_detail->District->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $sponsored_student_detail->student_firstname->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_firstname->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_firstname->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student_detail->student_middlename->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_middlename->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_middlename->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student_detail->student_lastname->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_lastname->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_lastname->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student_detail->student_telephone_1->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_telephone_1->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_telephone_1->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student_detail->student_telephone_2->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_telephone_2->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_telephone_2->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student_detail->student_dob->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_dob->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_dob->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student_detail->age->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->age->ViewAttributes() ?>><?php echo $sponsored_student_detail->age->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student_detail->student_gender->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_gender->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_gender->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student_detail->student_address->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_address->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_address->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student_detail->app_submission_year->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->app_submission_year->ViewAttributes() ?>><?php echo $sponsored_student_detail->app_submission_year->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student_detail->community->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->community->ViewAttributes() ?>><?php echo $sponsored_student_detail->community->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student_detail->student_resident_programarea_id->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_resident_programarea_id->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_resident_programarea_id->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student_detail->District->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->District->ViewAttributes() ?>><?php echo $sponsored_student_detail->District->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
