<?php

// Call Row_Rendering event
$sponsored_student->Row_Rendering();

// sponsored_student_id
$sponsored_student->sponsored_student_id->CellCssStyle = ""; $sponsored_student->sponsored_student_id->CellCssClass = "";
$sponsored_student->sponsored_student_id->CellAttrs = array(); $sponsored_student->sponsored_student_id->ViewAttrs = array(); $sponsored_student->sponsored_student_id->EditAttrs = array();

// student_firstname
$sponsored_student->student_firstname->CellCssStyle = ""; $sponsored_student->student_firstname->CellCssClass = "";
$sponsored_student->student_firstname->CellAttrs = array(); $sponsored_student->student_firstname->ViewAttrs = array(); $sponsored_student->student_firstname->EditAttrs = array();

// student_middlename
$sponsored_student->student_middlename->CellCssStyle = ""; $sponsored_student->student_middlename->CellCssClass = "";
$sponsored_student->student_middlename->CellAttrs = array(); $sponsored_student->student_middlename->ViewAttrs = array(); $sponsored_student->student_middlename->EditAttrs = array();

// student_lastname
$sponsored_student->student_lastname->CellCssStyle = ""; $sponsored_student->student_lastname->CellCssClass = "";
$sponsored_student->student_lastname->CellAttrs = array(); $sponsored_student->student_lastname->ViewAttrs = array(); $sponsored_student->student_lastname->EditAttrs = array();

// student_applicant_student_applicant_id
$sponsored_student->student_applicant_student_applicant_id->CellCssStyle = ""; $sponsored_student->student_applicant_student_applicant_id->CellCssClass = "";
$sponsored_student->student_applicant_student_applicant_id->CellAttrs = array(); $sponsored_student->student_applicant_student_applicant_id->ViewAttrs = array(); $sponsored_student->student_applicant_student_applicant_id->EditAttrs = array();

// student_resident_programarea_id
$sponsored_student->student_resident_programarea_id->CellCssStyle = ""; $sponsored_student->student_resident_programarea_id->CellCssClass = "";
$sponsored_student->student_resident_programarea_id->CellAttrs = array(); $sponsored_student->student_resident_programarea_id->ViewAttrs = array(); $sponsored_student->student_resident_programarea_id->EditAttrs = array();

// Call Row_Rendered event
$sponsored_student->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $sponsored_student->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $sponsored_student->sponsored_student_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student->student_firstname->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student->student_middlename->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student->student_lastname->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student->student_applicant_student_applicant_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $sponsored_student->student_resident_programarea_id->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $sponsored_student->sponsored_student_id->CellAttributes() ?>>
<div<?php echo $sponsored_student->sponsored_student_id->ViewAttributes() ?>><?php echo $sponsored_student->sponsored_student_id->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student->student_firstname->CellAttributes() ?>>
<div<?php echo $sponsored_student->student_firstname->ViewAttributes() ?>><?php echo $sponsored_student->student_firstname->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student->student_middlename->CellAttributes() ?>>
<div<?php echo $sponsored_student->student_middlename->ViewAttributes() ?>><?php echo $sponsored_student->student_middlename->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student->student_lastname->CellAttributes() ?>>
<div<?php echo $sponsored_student->student_lastname->ViewAttributes() ?>><?php echo $sponsored_student->student_lastname->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student->student_applicant_student_applicant_id->CellAttributes() ?>>
<div<?php echo $sponsored_student->student_applicant_student_applicant_id->ViewAttributes() ?>><?php echo $sponsored_student->student_applicant_student_applicant_id->ListViewValue() ?></div></td>
			<td<?php echo $sponsored_student->student_resident_programarea_id->CellAttributes() ?>>
<div<?php echo $sponsored_student->student_resident_programarea_id->ViewAttributes() ?>><?php echo $sponsored_student->student_resident_programarea_id->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
