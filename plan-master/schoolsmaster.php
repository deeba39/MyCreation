<?php

// Call Row_Rendering event
$schools->Row_Rendering();

// school_id
$schools->school_id->CellCssStyle = ""; $schools->school_id->CellCssClass = "";
$schools->school_id->CellAttrs = array(); $schools->school_id->ViewAttrs = array(); $schools->school_id->EditAttrs = array();

// school_name
$schools->school_name->CellCssStyle = ""; $schools->school_name->CellCssClass = "";
$schools->school_name->CellAttrs = array(); $schools->school_name->ViewAttrs = array(); $schools->school_name->EditAttrs = array();

// address
$schools->address->CellCssStyle = ""; $schools->address->CellCssClass = "";
$schools->address->CellAttrs = array(); $schools->address->ViewAttrs = array(); $schools->address->EditAttrs = array();

// towncity
$schools->towncity->CellCssStyle = ""; $schools->towncity->CellCssClass = "";
$schools->towncity->CellAttrs = array(); $schools->towncity->ViewAttrs = array(); $schools->towncity->EditAttrs = array();

// school_type
$schools->school_type->CellCssStyle = ""; $schools->school_type->CellCssClass = "";
$schools->school_type->CellAttrs = array(); $schools->school_type->ViewAttrs = array(); $schools->school_type->EditAttrs = array();

// contact_person_name
$schools->contact_person_name->CellCssStyle = ""; $schools->contact_person_name->CellCssClass = "";
$schools->contact_person_name->CellAttrs = array(); $schools->contact_person_name->ViewAttrs = array(); $schools->contact_person_name->EditAttrs = array();

// telephone
$schools->telephone->CellCssStyle = ""; $schools->telephone->CellCssClass = "";
$schools->telephone->CellAttrs = array(); $schools->telephone->ViewAttrs = array(); $schools->telephone->EditAttrs = array();

// bankname
$schools->bankname->CellCssStyle = ""; $schools->bankname->CellCssClass = "";
$schools->bankname->CellAttrs = array(); $schools->bankname->ViewAttrs = array(); $schools->bankname->EditAttrs = array();

// account_no
$schools->account_no->CellCssStyle = ""; $schools->account_no->CellCssClass = "";
$schools->account_no->CellAttrs = array(); $schools->account_no->ViewAttrs = array(); $schools->account_no->EditAttrs = array();

// programarea_programarea_id
$schools->programarea_programarea_id->CellCssStyle = ""; $schools->programarea_programarea_id->CellCssClass = "";
$schools->programarea_programarea_id->CellAttrs = array(); $schools->programarea_programarea_id->ViewAttrs = array(); $schools->programarea_programarea_id->EditAttrs = array();

// Call Row_Rendered event
$schools->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $schools->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $schools->school_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $schools->school_name->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $schools->address->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $schools->towncity->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $schools->school_type->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $schools->contact_person_name->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $schools->telephone->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $schools->bankname->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $schools->account_no->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $schools->programarea_programarea_id->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $schools->school_id->CellAttributes() ?>>
<div<?php echo $schools->school_id->ViewAttributes() ?>><?php echo $schools->school_id->ListViewValue() ?></div></td>
			<td<?php echo $schools->school_name->CellAttributes() ?>>
<div<?php echo $schools->school_name->ViewAttributes() ?>><?php echo $schools->school_name->ListViewValue() ?></div></td>
			<td<?php echo $schools->address->CellAttributes() ?>>
<div<?php echo $schools->address->ViewAttributes() ?>><?php echo $schools->address->ListViewValue() ?></div></td>
			<td<?php echo $schools->towncity->CellAttributes() ?>>
<div<?php echo $schools->towncity->ViewAttributes() ?>><?php echo $schools->towncity->ListViewValue() ?></div></td>
			<td<?php echo $schools->school_type->CellAttributes() ?>>
<div<?php echo $schools->school_type->ViewAttributes() ?>><?php echo $schools->school_type->ListViewValue() ?></div></td>
			<td<?php echo $schools->contact_person_name->CellAttributes() ?>>
<div<?php echo $schools->contact_person_name->ViewAttributes() ?>><?php echo $schools->contact_person_name->ListViewValue() ?></div></td>
			<td<?php echo $schools->telephone->CellAttributes() ?>>
<div<?php echo $schools->telephone->ViewAttributes() ?>><?php echo $schools->telephone->ListViewValue() ?></div></td>
			<td<?php echo $schools->bankname->CellAttributes() ?>>
<div<?php echo $schools->bankname->ViewAttributes() ?>><?php echo $schools->bankname->ListViewValue() ?></div></td>
			<td<?php echo $schools->account_no->CellAttributes() ?>>
<div<?php echo $schools->account_no->ViewAttributes() ?>><?php echo $schools->account_no->ListViewValue() ?></div></td>
			<td<?php echo $schools->programarea_programarea_id->CellAttributes() ?>>
<div<?php echo $schools->programarea_programarea_id->ViewAttributes() ?>><?php echo $schools->programarea_programarea_id->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
