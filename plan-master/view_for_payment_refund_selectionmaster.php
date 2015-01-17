<?php

// Call Row_Rendering event
$view_for_payment_refund_selection->Row_Rendering();

// sponsored_student_sponsored_student_id
$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->CellCssStyle = ""; $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->CellCssClass = "";
$view_for_payment_refund_selection->sponsored_student_sponsored_student_id->CellAttrs = array(); $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->ViewAttrs = array(); $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->EditAttrs = array();

// scholarship_type_scholarship_type
$view_for_payment_refund_selection->scholarship_type_scholarship_type->CellCssStyle = ""; $view_for_payment_refund_selection->scholarship_type_scholarship_type->CellCssClass = "";
$view_for_payment_refund_selection->scholarship_type_scholarship_type->CellAttrs = array(); $view_for_payment_refund_selection->scholarship_type_scholarship_type->ViewAttrs = array(); $view_for_payment_refund_selection->scholarship_type_scholarship_type->EditAttrs = array();

// grant_package_grant_package_id
$view_for_payment_refund_selection->grant_package_grant_package_id->CellCssStyle = ""; $view_for_payment_refund_selection->grant_package_grant_package_id->CellCssClass = "";
$view_for_payment_refund_selection->grant_package_grant_package_id->CellAttrs = array(); $view_for_payment_refund_selection->grant_package_grant_package_id->ViewAttrs = array(); $view_for_payment_refund_selection->grant_package_grant_package_id->EditAttrs = array();

// schools_school_id
$view_for_payment_refund_selection->schools_school_id->CellCssStyle = ""; $view_for_payment_refund_selection->schools_school_id->CellCssClass = "";
$view_for_payment_refund_selection->schools_school_id->CellAttrs = array(); $view_for_payment_refund_selection->schools_school_id->ViewAttrs = array(); $view_for_payment_refund_selection->schools_school_id->EditAttrs = array();

// programarea_payingarea_id
$view_for_payment_refund_selection->programarea_payingarea_id->CellCssStyle = ""; $view_for_payment_refund_selection->programarea_payingarea_id->CellCssClass = "";
$view_for_payment_refund_selection->programarea_payingarea_id->CellAttrs = array(); $view_for_payment_refund_selection->programarea_payingarea_id->ViewAttrs = array(); $view_for_payment_refund_selection->programarea_payingarea_id->EditAttrs = array();

// programarea_residentarea_id
$view_for_payment_refund_selection->programarea_residentarea_id->CellCssStyle = ""; $view_for_payment_refund_selection->programarea_residentarea_id->CellCssClass = "";
$view_for_payment_refund_selection->programarea_residentarea_id->CellAttrs = array(); $view_for_payment_refund_selection->programarea_residentarea_id->ViewAttrs = array(); $view_for_payment_refund_selection->programarea_residentarea_id->EditAttrs = array();

// payment_request_payment_request_id
$view_for_payment_refund_selection->payment_request_payment_request_id->CellCssStyle = ""; $view_for_payment_refund_selection->payment_request_payment_request_id->CellCssClass = "";
$view_for_payment_refund_selection->payment_request_payment_request_id->CellAttrs = array(); $view_for_payment_refund_selection->payment_request_payment_request_id->ViewAttrs = array(); $view_for_payment_refund_selection->payment_request_payment_request_id->EditAttrs = array();

// scholarship_package_scholarship_package_id
$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->CellCssStyle = ""; $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->CellCssClass = "";
$view_for_payment_refund_selection->scholarship_package_scholarship_package_id->CellAttrs = array(); $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->ViewAttrs = array(); $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->EditAttrs = array();

// scholarship_payment_id
$view_for_payment_refund_selection->scholarship_payment_id->CellCssStyle = ""; $view_for_payment_refund_selection->scholarship_payment_id->CellCssClass = "";
$view_for_payment_refund_selection->scholarship_payment_id->CellAttrs = array(); $view_for_payment_refund_selection->scholarship_payment_id->ViewAttrs = array(); $view_for_payment_refund_selection->scholarship_payment_id->EditAttrs = array();

// Call Row_Rendered event
$view_for_payment_refund_selection->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $view_for_payment_refund_selection->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $view_for_payment_refund_selection->scholarship_type_scholarship_type->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $view_for_payment_refund_selection->grant_package_grant_package_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $view_for_payment_refund_selection->schools_school_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $view_for_payment_refund_selection->programarea_payingarea_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $view_for_payment_refund_selection->programarea_residentarea_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $view_for_payment_refund_selection->payment_request_payment_request_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $view_for_payment_refund_selection->scholarship_payment_id->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->sponsored_student_sponsored_student_id->ListViewValue() ?></div></td>
			<td<?php echo $view_for_payment_refund_selection->scholarship_type_scholarship_type->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->scholarship_type_scholarship_type->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->scholarship_type_scholarship_type->ListViewValue() ?></div></td>
			<td<?php echo $view_for_payment_refund_selection->grant_package_grant_package_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->grant_package_grant_package_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->grant_package_grant_package_id->ListViewValue() ?></div></td>
			<td<?php echo $view_for_payment_refund_selection->schools_school_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->schools_school_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->schools_school_id->ListViewValue() ?></div></td>
			<td<?php echo $view_for_payment_refund_selection->programarea_payingarea_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->programarea_payingarea_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->programarea_payingarea_id->ListViewValue() ?></div></td>
			<td<?php echo $view_for_payment_refund_selection->programarea_residentarea_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->programarea_residentarea_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->programarea_residentarea_id->ListViewValue() ?></div></td>
			<td<?php echo $view_for_payment_refund_selection->payment_request_payment_request_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->payment_request_payment_request_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->payment_request_payment_request_id->ListViewValue() ?></div></td>
			<td<?php echo $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->scholarship_package_scholarship_package_id->ListViewValue() ?></div></td>
			<td<?php echo $view_for_payment_refund_selection->scholarship_payment_id->CellAttributes() ?>>
<div<?php echo $view_for_payment_refund_selection->scholarship_payment_id->ViewAttributes() ?>><?php echo $view_for_payment_refund_selection->scholarship_payment_id->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
