<?php

// Call Row_Rendering event
$school_attendance->Row_Rendering();

// start_date
$school_attendance->start_date->CellCssStyle = ""; $school_attendance->start_date->CellCssClass = "";
$school_attendance->start_date->CellAttrs = array(); $school_attendance->start_date->ViewAttrs = array(); $school_attendance->start_date->EditAttrs = array();

// end_date
$school_attendance->end_date->CellCssStyle = ""; $school_attendance->end_date->CellCssClass = "";
$school_attendance->end_date->CellAttrs = array(); $school_attendance->end_date->ViewAttrs = array(); $school_attendance->end_date->EditAttrs = array();

// schools_school_id
$school_attendance->schools_school_id->CellCssStyle = ""; $school_attendance->schools_school_id->CellCssClass = "";
$school_attendance->schools_school_id->CellAttrs = array(); $school_attendance->schools_school_id->ViewAttrs = array(); $school_attendance->schools_school_id->EditAttrs = array();

// entry_level
$school_attendance->entry_level->CellCssStyle = ""; $school_attendance->entry_level->CellCssClass = "";
$school_attendance->entry_level->CellAttrs = array(); $school_attendance->entry_level->ViewAttrs = array(); $school_attendance->entry_level->EditAttrs = array();

// sponsored_student_sponsored_student_id
$school_attendance->sponsored_student_sponsored_student_id->CellCssStyle = ""; $school_attendance->sponsored_student_sponsored_student_id->CellCssClass = "";
$school_attendance->sponsored_student_sponsored_student_id->CellAttrs = array(); $school_attendance->sponsored_student_sponsored_student_id->ViewAttrs = array(); $school_attendance->sponsored_student_sponsored_student_id->EditAttrs = array();

// program
$school_attendance->program->CellCssStyle = ""; $school_attendance->program->CellCssClass = "";
$school_attendance->program->CellAttrs = array(); $school_attendance->program->ViewAttrs = array(); $school_attendance->program->EditAttrs = array();

// attendance_type
$school_attendance->attendance_type->CellCssStyle = ""; $school_attendance->attendance_type->CellCssClass = "";
$school_attendance->attendance_type->CellAttrs = array(); $school_attendance->attendance_type->ViewAttrs = array(); $school_attendance->attendance_type->EditAttrs = array();

// group_id
$school_attendance->group_id->CellCssStyle = ""; $school_attendance->group_id->CellCssClass = "";
$school_attendance->group_id->CellAttrs = array(); $school_attendance->group_id->ViewAttrs = array(); $school_attendance->group_id->EditAttrs = array();

// Call Row_Rendered event
$school_attendance->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $school_attendance->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $school_attendance->start_date->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $school_attendance->end_date->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $school_attendance->schools_school_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $school_attendance->entry_level->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $school_attendance->sponsored_student_sponsored_student_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $school_attendance->program->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $school_attendance->attendance_type->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $school_attendance->group_id->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $school_attendance->start_date->CellAttributes() ?>>
<div<?php echo $school_attendance->start_date->ViewAttributes() ?>><?php echo $school_attendance->start_date->ListViewValue() ?></div></td>
			<td<?php echo $school_attendance->end_date->CellAttributes() ?>>
<div<?php echo $school_attendance->end_date->ViewAttributes() ?>><?php echo $school_attendance->end_date->ListViewValue() ?></div></td>
			<td<?php echo $school_attendance->schools_school_id->CellAttributes() ?>>
<div<?php echo $school_attendance->schools_school_id->ViewAttributes() ?>><?php echo $school_attendance->schools_school_id->ListViewValue() ?></div></td>
			<td<?php echo $school_attendance->entry_level->CellAttributes() ?>>
<div<?php echo $school_attendance->entry_level->ViewAttributes() ?>><?php echo $school_attendance->entry_level->ListViewValue() ?></div></td>
			<td<?php echo $school_attendance->sponsored_student_sponsored_student_id->CellAttributes() ?>>
<div<?php echo $school_attendance->sponsored_student_sponsored_student_id->ViewAttributes() ?>><?php echo $school_attendance->sponsored_student_sponsored_student_id->ListViewValue() ?></div></td>
			<td<?php echo $school_attendance->program->CellAttributes() ?>>
<div<?php echo $school_attendance->program->ViewAttributes() ?>><?php echo $school_attendance->program->ListViewValue() ?></div></td>
			<td<?php echo $school_attendance->attendance_type->CellAttributes() ?>>
<div<?php echo $school_attendance->attendance_type->ViewAttributes() ?>><?php echo $school_attendance->attendance_type->ListViewValue() ?></div></td>
			<td<?php echo $school_attendance->group_id->CellAttributes() ?>>
<div<?php echo $school_attendance->group_id->ViewAttributes() ?>><?php echo $school_attendance->group_id->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
