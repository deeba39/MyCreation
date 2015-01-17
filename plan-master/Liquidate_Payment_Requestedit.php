<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "Liquidate_Payment_Requestinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$Liquidate_Payment_Request_edit = new cLiquidate_Payment_Request_edit();
$Page =& $Liquidate_Payment_Request_edit;

// Page init
$Liquidate_Payment_Request_edit->Page_Init();

// Page main
$Liquidate_Payment_Request_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var Liquidate_Payment_Request_edit = new ew_Page("Liquidate_Payment_Request_edit");

// page properties
Liquidate_Payment_Request_edit.PageID = "edit"; // page ID
Liquidate_Payment_Request_edit.FormID = "fLiquidate_Payment_Requestedit"; // form ID
var EW_PAGE_ID = Liquidate_Payment_Request_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
Liquidate_Payment_Request_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_liquidationdoc"];
		aelm = fobj.elements["a" + infix + "_liquidationdoc"];
		var chk_liquidationdoc = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_liquidationdoc && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Liquidate_Payment_Request->liquidationdoc->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_liquidationdoc"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
Liquidate_Payment_Request_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
Liquidate_Payment_Request_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Liquidate_Payment_Request_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $Liquidate_Payment_Request->TableCaption() ?><br><br>
<a href="<?php echo $Liquidate_Payment_Request->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$Liquidate_Payment_Request_edit->ShowMessage();
?>
<form name="fLiquidate_Payment_Requestedit" id="fLiquidate_Payment_Requestedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return Liquidate_Payment_Request_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="Liquidate_Payment_Request">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($Liquidate_Payment_Request->CurrentAction == "F") { // Confirm page ?>
<input type="hidden" name="a_confirm" id="a_confirm" value="F">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($Liquidate_Payment_Request->payment_request_id->Visible) { // payment_request_id ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->payment_request_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $Liquidate_Payment_Request->payment_request_id->CellAttributes() ?>><span id="el_payment_request_id">
<?php if ($Liquidate_Payment_Request->CurrentAction <> "F") { ?>
<div<?php echo $Liquidate_Payment_Request->payment_request_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->payment_request_id->EditValue ?></div><input type="hidden" name="x_payment_request_id" id="x_payment_request_id" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->payment_request_id->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $Liquidate_Payment_Request->payment_request_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->payment_request_id->ViewValue ?></div>
<input type="hidden" name="x_payment_request_id" id="x_payment_request_id" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->payment_request_id->FormValue) ?>">
<?php } ?>
</span><?php echo $Liquidate_Payment_Request->payment_request_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->year->Visible) { // year ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->year->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->year->CellAttributes() ?>><span id="el_year">
<?php if ($Liquidate_Payment_Request->CurrentAction <> "F") { ?>
<div<?php echo $Liquidate_Payment_Request->year->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->year->EditValue ?></div><input type="hidden" name="x_year" id="x_year" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->year->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $Liquidate_Payment_Request->year->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->year->ViewValue ?></div>
<input type="hidden" name="x_year" id="x_year" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->year->FormValue) ?>">
<?php } ?>
</span><?php echo $Liquidate_Payment_Request->year->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->request_date->Visible) { // request_date ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->request_date->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->request_date->CellAttributes() ?>><span id="el_request_date">
<?php if ($Liquidate_Payment_Request->CurrentAction <> "F") { ?>
<div<?php echo $Liquidate_Payment_Request->request_date->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->request_date->EditValue ?></div><input type="hidden" name="x_request_date" id="x_request_date" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->request_date->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $Liquidate_Payment_Request->request_date->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->request_date->ViewValue ?></div>
<input type="hidden" name="x_request_date" id="x_request_date" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->request_date->FormValue) ?>">
<?php } ?>
</span><?php echo $Liquidate_Payment_Request->request_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->programarea_id->Visible) { // programarea_id ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->programarea_id->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->programarea_id->CellAttributes() ?>><span id="el_programarea_id">
<?php if ($Liquidate_Payment_Request->CurrentAction <> "F") { ?>
<div<?php echo $Liquidate_Payment_Request->programarea_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->programarea_id->EditValue ?></div><input type="hidden" name="x_programarea_id" id="x_programarea_id" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->programarea_id->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $Liquidate_Payment_Request->programarea_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->programarea_id->ViewValue ?></div>
<input type="hidden" name="x_programarea_id" id="x_programarea_id" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->programarea_id->FormValue) ?>">
<?php } ?>
</span><?php echo $Liquidate_Payment_Request->programarea_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->request_status->Visible) { // request_status ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->request_status->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->request_status->CellAttributes() ?>><span id="el_request_status">
<?php if ($Liquidate_Payment_Request->CurrentAction <> "F") { ?>
<div id="tp_x_request_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_request_status" id="x_request_status" title="<?php echo $Liquidate_Payment_Request->request_status->FldTitle() ?>" value="{value}"<?php echo $Liquidate_Payment_Request->request_status->EditAttributes() ?>></label></div>
<div id="dsl_x_request_status" repeatcolumn="5">
<?php
$arwrk = $Liquidate_Payment_Request->request_status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Liquidate_Payment_Request->request_status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_request_status" id="x_request_status" title="<?php echo $Liquidate_Payment_Request->request_status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $Liquidate_Payment_Request->request_status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
<?php } else { ?>
<div<?php echo $Liquidate_Payment_Request->request_status->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->request_status->ViewValue ?></div>
<input type="hidden" name="x_request_status" id="x_request_status" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->request_status->FormValue) ?>">
<?php } ?>
</span><?php echo $Liquidate_Payment_Request->request_status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->code->Visible) { // code ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->code->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->code->CellAttributes() ?>><span id="el_code">
<?php if ($Liquidate_Payment_Request->CurrentAction <> "F") { ?>
<div<?php echo $Liquidate_Payment_Request->code->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->code->EditValue ?></div><input type="hidden" name="x_code" id="x_code" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->code->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $Liquidate_Payment_Request->code->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->code->ViewValue ?></div>
<input type="hidden" name="x_code" id="x_code" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->code->FormValue) ?>">
<?php } ?>
</span><?php echo $Liquidate_Payment_Request->code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->CellAttributes() ?>><span id="el_financial_year_financial_year_id">
<?php if ($Liquidate_Payment_Request->CurrentAction <> "F") { ?>
<div<?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->EditValue ?></div><input type="hidden" name="x_financial_year_financial_year_id" id="x_financial_year_financial_year_id" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->ViewValue ?></div>
<input type="hidden" name="x_financial_year_financial_year_id" id="x_financial_year_financial_year_id" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->financial_year_financial_year_id->FormValue) ?>">
<?php } ?>
</span><?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->amount->Visible) { // amount ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->amount->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->amount->CellAttributes() ?>><span id="el_amount">
<?php if ($Liquidate_Payment_Request->CurrentAction <> "F") { ?>
<div<?php echo $Liquidate_Payment_Request->amount->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->amount->EditValue ?></div><input type="hidden" name="x_amount" id="x_amount" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->amount->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $Liquidate_Payment_Request->amount->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->amount->ViewValue ?></div>
<input type="hidden" name="x_amount" id="x_amount" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->amount->FormValue) ?>">
<?php } ?>
</span><?php echo $Liquidate_Payment_Request->amount->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->group_id->Visible) { // group_id ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->group_id->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->group_id->CellAttributes() ?>><span id="el_group_id">
<?php if ($Liquidate_Payment_Request->CurrentAction <> "F") { ?>
<div<?php echo $Liquidate_Payment_Request->group_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->group_id->EditValue ?></div><input type="hidden" name="x_group_id" id="x_group_id" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->group_id->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $Liquidate_Payment_Request->group_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->group_id->ViewValue ?></div>
<input type="hidden" name="x_group_id" id="x_group_id" value="<?php echo ew_HtmlEncode($Liquidate_Payment_Request->group_id->FormValue) ?>">
<?php } ?>
</span><?php echo $Liquidate_Payment_Request->group_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->liquidationdoc->Visible) { // liquidationdoc ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->liquidationdoc->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $Liquidate_Payment_Request->liquidationdoc->CellAttributes() ?>><span id="el_liquidationdoc">
<?php if ($Liquidate_Payment_Request->CurrentAction <> "F") { ?>
<div id="old_x_liquidationdoc">
<?php if ($Liquidate_Payment_Request->liquidationdoc->HrefValue <> "" || $Liquidate_Payment_Request->liquidationdoc->TooltipValue <> "") { ?>
<?php if (!empty($Liquidate_Payment_Request->liquidationdoc->Upload->DbValue)) { ?>
<a href="<?php echo $Liquidate_Payment_Request->liquidationdoc->HrefValue ?>"><?php echo $Liquidate_Payment_Request->liquidationdoc->EditValue ?></a>
<?php } elseif (!in_array($Liquidate_Payment_Request->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($Liquidate_Payment_Request->liquidationdoc->Upload->DbValue)) { ?>
<?php echo $Liquidate_Payment_Request->liquidationdoc->EditValue ?>
<?php } elseif (!in_array($Liquidate_Payment_Request->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_liquidationdoc">
<?php if (!empty($Liquidate_Payment_Request->liquidationdoc->Upload->DbValue)) { ?>
<label><input type="radio" name="a_liquidationdoc" id="a_liquidationdoc" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_liquidationdoc" id="a_liquidationdoc" value="2" disabled="disabled"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_liquidationdoc" id="a_liquidationdoc" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $Liquidate_Payment_Request->liquidationdoc->EditAttrs["onchange"] = "this.form.a_liquidationdoc[2].checked=true;" . @$Liquidate_Payment_Request->liquidationdoc->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_liquidationdoc" id="a_liquidationdoc" value="3">
<?php } ?>
<input type="file" name="x_liquidationdoc" id="x_liquidationdoc" title="<?php echo $Liquidate_Payment_Request->liquidationdoc->FldTitle() ?>" size="30"<?php echo $Liquidate_Payment_Request->liquidationdoc->EditAttributes() ?>>
</div>
<?php } else { ?>
<div id="old_x_liquidationdoc">
<?php if ($Liquidate_Payment_Request->liquidationdoc->HrefValue <> "" || $Liquidate_Payment_Request->liquidationdoc->TooltipValue <> "") { ?>
<?php if (!empty($Liquidate_Payment_Request->liquidationdoc->Upload->DbValue)) { ?>
<a href="<?php echo $Liquidate_Payment_Request->liquidationdoc->HrefValue ?>"><?php echo $Liquidate_Payment_Request->liquidationdoc->ViewValue ?></a>
<?php } elseif (!in_array($Liquidate_Payment_Request->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($Liquidate_Payment_Request->liquidationdoc->Upload->DbValue)) { ?>
<?php echo $Liquidate_Payment_Request->liquidationdoc->ViewValue ?>
<?php } elseif (!in_array($Liquidate_Payment_Request->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
<?php if (!ew_Empty($Liquidate_Payment_Request->liquidationdoc->Upload->DbValue) && $Liquidate_Payment_Request->liquidationdoc->Upload->Action == "3") echo "[" . $Language->Phrase("Old") . "]"; ?>
</div>
<div id="new_x_liquidationdoc">
<input type="hidden" name="a_liquidationdoc" id="a_liquidationdoc" value="<?php echo $Liquidate_Payment_Request->liquidationdoc->Upload->Action ?>">
<?php
if ($Liquidate_Payment_Request->liquidationdoc->Upload->Action == "1") {
	echo "[" . $Language->Phrase("Keep") . "]";
} elseif ($Liquidate_Payment_Request->liquidationdoc->Upload->Action == "2") {
	echo "[" . $Language->Phrase("Remove") . "]";
} else {
	if (!ew_Empty($Liquidate_Payment_Request->liquidationdoc->Upload->Value)) {
?>
<a href="ewbv7.php?tbl=<?php echo $Liquidate_Payment_Request->TableVar ?>&fld=x_liquidationdoc&rnd=<?php echo ew_Random() ?>" target="_blank"><?php echo $Liquidate_Payment_Request->liquidationdoc->Upload->FileName ?></a>
<?php
	}
}
?>
<?php if (!ew_Empty($Liquidate_Payment_Request->liquidationdoc->Upload->DbValue) && $Liquidate_Payment_Request->liquidationdoc->Upload->Action == "3") echo "[" . $Language->Phrase("New") . "]"; ?>
</div>
<?php } ?>
</span><?php echo $Liquidate_Payment_Request->liquidationdoc->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($Liquidate_Payment_Request->CurrentAction <> "F") { // Confirm page ?>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>" onclick="this.form.a_edit.value='F';">
<?php } else { ?>
<input type="submit" name="btnCancel" id="btnCancel" value="<?php echo ew_BtnCaption($Language->Phrase("CancelBtn")) ?>" onclick="this.form.a_edit.value='X';">
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("ConfirmBtn")) ?>">
<?php } ?>
</form>
<?php if ($Liquidate_Payment_Request->CurrentAction <> "F") { ?>
<?php } ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$Liquidate_Payment_Request_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cLiquidate_Payment_Request_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'Liquidate Payment Request';

	// Page object name
	var $PageObjName = 'Liquidate_Payment_Request_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $Liquidate_Payment_Request;
		if ($Liquidate_Payment_Request->UseTokenInUrl) $PageUrl .= "t=" . $Liquidate_Payment_Request->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $Liquidate_Payment_Request;
		if ($Liquidate_Payment_Request->UseTokenInUrl) {
			if ($objForm)
				return ($Liquidate_Payment_Request->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($Liquidate_Payment_Request->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cLiquidate_Payment_Request_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (Liquidate_Payment_Request)
		$GLOBALS["Liquidate_Payment_Request"] = new cLiquidate_Payment_Request();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'Liquidate Payment Request', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $Liquidate_Payment_Request;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("Liquidate_Payment_Requestlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("Liquidate_Payment_Requestlist.php");
		}

		// Create form object
		$objForm = new cFormObj();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $Liquidate_Payment_Request;

		// Load key from QueryString
		if (@$_GET["payment_request_id"] <> "")
			$Liquidate_Payment_Request->payment_request_id->setQueryStringValue($_GET["payment_request_id"]);
		if (@$_POST["a_edit"] <> "") {
			$Liquidate_Payment_Request->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$Liquidate_Payment_Request->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$Liquidate_Payment_Request->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$Liquidate_Payment_Request->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($Liquidate_Payment_Request->payment_request_id->CurrentValue == "")
			$this->Page_Terminate("Liquidate_Payment_Requestlist.php"); // Invalid key, return to list
		switch ($Liquidate_Payment_Request->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("Liquidate_Payment_Requestlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$Liquidate_Payment_Request->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $Liquidate_Payment_Request->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$Liquidate_Payment_Request->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		if ($Liquidate_Payment_Request->CurrentAction == "F") { // Confirm page
			$Liquidate_Payment_Request->RowType = EW_ROWTYPE_VIEW; // Render as View
		} else {
			$Liquidate_Payment_Request->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		}
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Liquidate_Payment_Request;

		// Get upload data
		$Liquidate_Payment_Request->liquidationdoc->Upload->RestoreDbFromSession();
		if ($Liquidate_Payment_Request->CurrentAction == "F") {
			if ($Liquidate_Payment_Request->liquidationdoc->Upload->UploadFile()) {

				// No action required
			} else {
				echo $Liquidate_Payment_Request->liquidationdoc->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$Liquidate_Payment_Request->liquidationdoc->Upload->SaveToSession();
		} else {
			$Liquidate_Payment_Request->liquidationdoc->Upload->RestoreFromSession();
		}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $Liquidate_Payment_Request;
		$Liquidate_Payment_Request->payment_request_id->setFormValue($objForm->GetValue("x_payment_request_id"));
		$Liquidate_Payment_Request->year->setFormValue($objForm->GetValue("x_year"));
		$Liquidate_Payment_Request->request_date->setFormValue($objForm->GetValue("x_request_date"));
		$Liquidate_Payment_Request->request_date->CurrentValue = ew_UnFormatDateTime($Liquidate_Payment_Request->request_date->CurrentValue, 7);
		$Liquidate_Payment_Request->programarea_id->setFormValue($objForm->GetValue("x_programarea_id"));
		$Liquidate_Payment_Request->request_status->setFormValue($objForm->GetValue("x_request_status"));
		$Liquidate_Payment_Request->code->setFormValue($objForm->GetValue("x_code"));
		$Liquidate_Payment_Request->financial_year_financial_year_id->setFormValue($objForm->GetValue("x_financial_year_financial_year_id"));
		$Liquidate_Payment_Request->amount->setFormValue($objForm->GetValue("x_amount"));
		$Liquidate_Payment_Request->group_id->setFormValue($objForm->GetValue("x_group_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $Liquidate_Payment_Request;
		$this->LoadRow();
		$Liquidate_Payment_Request->payment_request_id->CurrentValue = $Liquidate_Payment_Request->payment_request_id->FormValue;
		$Liquidate_Payment_Request->year->CurrentValue = $Liquidate_Payment_Request->year->FormValue;
		$Liquidate_Payment_Request->request_date->CurrentValue = $Liquidate_Payment_Request->request_date->FormValue;
		$Liquidate_Payment_Request->request_date->CurrentValue = ew_UnFormatDateTime($Liquidate_Payment_Request->request_date->CurrentValue, 7);
		$Liquidate_Payment_Request->programarea_id->CurrentValue = $Liquidate_Payment_Request->programarea_id->FormValue;
		$Liquidate_Payment_Request->request_status->CurrentValue = $Liquidate_Payment_Request->request_status->FormValue;
		$Liquidate_Payment_Request->code->CurrentValue = $Liquidate_Payment_Request->code->FormValue;
		$Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue = $Liquidate_Payment_Request->financial_year_financial_year_id->FormValue;
		$Liquidate_Payment_Request->amount->CurrentValue = $Liquidate_Payment_Request->amount->FormValue;
		$Liquidate_Payment_Request->group_id->CurrentValue = $Liquidate_Payment_Request->group_id->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $Liquidate_Payment_Request;
		$sFilter = $Liquidate_Payment_Request->KeyFilter();

		// Call Row Selecting event
		$Liquidate_Payment_Request->Row_Selecting($sFilter);

		// Load SQL based on filter
		$Liquidate_Payment_Request->CurrentFilter = $sFilter;
		$sSql = $Liquidate_Payment_Request->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$Liquidate_Payment_Request->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $Liquidate_Payment_Request;
		$Liquidate_Payment_Request->payment_request_id->setDbValue($rs->fields('payment_request_id'));
		$Liquidate_Payment_Request->year->setDbValue($rs->fields('year'));
		$Liquidate_Payment_Request->request_date->setDbValue($rs->fields('request_date'));
		$Liquidate_Payment_Request->programarea_id->setDbValue($rs->fields('programarea_id'));
		$Liquidate_Payment_Request->request_status->setDbValue($rs->fields('request_status'));
		$Liquidate_Payment_Request->code->setDbValue($rs->fields('code'));
		$Liquidate_Payment_Request->financial_year_financial_year_id->setDbValue($rs->fields('financial_year_financial_year_id'));
		$Liquidate_Payment_Request->amount->setDbValue($rs->fields('amount'));
		$Liquidate_Payment_Request->group_id->setDbValue($rs->fields('group_id'));
		$Liquidate_Payment_Request->liquidationdoc->Upload->DbValue = $rs->fields('liquidationdoc');
		$Liquidate_Payment_Request->liquidationdoc->Upload->SaveDbToSession();
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $Liquidate_Payment_Request;

		// Initialize URLs
		// Call Row_Rendering event

		$Liquidate_Payment_Request->Row_Rendering();

		// Common render codes for all row types
		// payment_request_id

		$Liquidate_Payment_Request->payment_request_id->CellCssStyle = ""; $Liquidate_Payment_Request->payment_request_id->CellCssClass = "";
		$Liquidate_Payment_Request->payment_request_id->CellAttrs = array(); $Liquidate_Payment_Request->payment_request_id->ViewAttrs = array(); $Liquidate_Payment_Request->payment_request_id->EditAttrs = array();

		// year
		$Liquidate_Payment_Request->year->CellCssStyle = ""; $Liquidate_Payment_Request->year->CellCssClass = "";
		$Liquidate_Payment_Request->year->CellAttrs = array(); $Liquidate_Payment_Request->year->ViewAttrs = array(); $Liquidate_Payment_Request->year->EditAttrs = array();

		// request_date
		$Liquidate_Payment_Request->request_date->CellCssStyle = ""; $Liquidate_Payment_Request->request_date->CellCssClass = "";
		$Liquidate_Payment_Request->request_date->CellAttrs = array(); $Liquidate_Payment_Request->request_date->ViewAttrs = array(); $Liquidate_Payment_Request->request_date->EditAttrs = array();

		// programarea_id
		$Liquidate_Payment_Request->programarea_id->CellCssStyle = ""; $Liquidate_Payment_Request->programarea_id->CellCssClass = "";
		$Liquidate_Payment_Request->programarea_id->CellAttrs = array(); $Liquidate_Payment_Request->programarea_id->ViewAttrs = array(); $Liquidate_Payment_Request->programarea_id->EditAttrs = array();

		// request_status
		$Liquidate_Payment_Request->request_status->CellCssStyle = ""; $Liquidate_Payment_Request->request_status->CellCssClass = "";
		$Liquidate_Payment_Request->request_status->CellAttrs = array(); $Liquidate_Payment_Request->request_status->ViewAttrs = array(); $Liquidate_Payment_Request->request_status->EditAttrs = array();

		// code
		$Liquidate_Payment_Request->code->CellCssStyle = ""; $Liquidate_Payment_Request->code->CellCssClass = "";
		$Liquidate_Payment_Request->code->CellAttrs = array(); $Liquidate_Payment_Request->code->ViewAttrs = array(); $Liquidate_Payment_Request->code->EditAttrs = array();

		// financial_year_financial_year_id
		$Liquidate_Payment_Request->financial_year_financial_year_id->CellCssStyle = ""; $Liquidate_Payment_Request->financial_year_financial_year_id->CellCssClass = "";
		$Liquidate_Payment_Request->financial_year_financial_year_id->CellAttrs = array(); $Liquidate_Payment_Request->financial_year_financial_year_id->ViewAttrs = array(); $Liquidate_Payment_Request->financial_year_financial_year_id->EditAttrs = array();

		// amount
		$Liquidate_Payment_Request->amount->CellCssStyle = ""; $Liquidate_Payment_Request->amount->CellCssClass = "";
		$Liquidate_Payment_Request->amount->CellAttrs = array(); $Liquidate_Payment_Request->amount->ViewAttrs = array(); $Liquidate_Payment_Request->amount->EditAttrs = array();

		// group_id
		$Liquidate_Payment_Request->group_id->CellCssStyle = ""; $Liquidate_Payment_Request->group_id->CellCssClass = "";
		$Liquidate_Payment_Request->group_id->CellAttrs = array(); $Liquidate_Payment_Request->group_id->ViewAttrs = array(); $Liquidate_Payment_Request->group_id->EditAttrs = array();

		// liquidationdoc
		$Liquidate_Payment_Request->liquidationdoc->CellCssStyle = ""; $Liquidate_Payment_Request->liquidationdoc->CellCssClass = "";
		$Liquidate_Payment_Request->liquidationdoc->CellAttrs = array(); $Liquidate_Payment_Request->liquidationdoc->ViewAttrs = array(); $Liquidate_Payment_Request->liquidationdoc->EditAttrs = array();
		if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$Liquidate_Payment_Request->payment_request_id->ViewValue = $Liquidate_Payment_Request->payment_request_id->CurrentValue;
			$Liquidate_Payment_Request->payment_request_id->CssStyle = "";
			$Liquidate_Payment_Request->payment_request_id->CssClass = "";
			$Liquidate_Payment_Request->payment_request_id->ViewCustomAttributes = "";

			// year
			$Liquidate_Payment_Request->year->ViewValue = $Liquidate_Payment_Request->year->CurrentValue;
			$Liquidate_Payment_Request->year->CssStyle = "";
			$Liquidate_Payment_Request->year->CssClass = "";
			$Liquidate_Payment_Request->year->ViewCustomAttributes = "";

			// request_date
			$Liquidate_Payment_Request->request_date->ViewValue = $Liquidate_Payment_Request->request_date->CurrentValue;
			$Liquidate_Payment_Request->request_date->ViewValue = ew_FormatDateTime($Liquidate_Payment_Request->request_date->ViewValue, 7);
			$Liquidate_Payment_Request->request_date->CssStyle = "";
			$Liquidate_Payment_Request->request_date->CssClass = "";
			$Liquidate_Payment_Request->request_date->ViewCustomAttributes = "";

			// programarea_id
			if (strval($Liquidate_Payment_Request->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Liquidate_Payment_Request->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Liquidate_Payment_Request->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Liquidate_Payment_Request->programarea_id->ViewValue = $Liquidate_Payment_Request->programarea_id->CurrentValue;
				}
			} else {
				$Liquidate_Payment_Request->programarea_id->ViewValue = NULL;
			}
			$Liquidate_Payment_Request->programarea_id->CssStyle = "";
			$Liquidate_Payment_Request->programarea_id->CssClass = "";
			$Liquidate_Payment_Request->programarea_id->ViewCustomAttributes = "";

			// request_status
			if (strval($Liquidate_Payment_Request->request_status->CurrentValue) <> "") {
				switch ($Liquidate_Payment_Request->request_status->CurrentValue) {
					case "DISBURSED":
						$Liquidate_Payment_Request->request_status->ViewValue = "DISBURSED";
						break;
					case "LIQUIDATED":
						$Liquidate_Payment_Request->request_status->ViewValue = "LIQUIDATED";
						break;
					default:
						$Liquidate_Payment_Request->request_status->ViewValue = $Liquidate_Payment_Request->request_status->CurrentValue;
				}
			} else {
				$Liquidate_Payment_Request->request_status->ViewValue = NULL;
			}
			$Liquidate_Payment_Request->request_status->CssStyle = "";
			$Liquidate_Payment_Request->request_status->CssClass = "";
			$Liquidate_Payment_Request->request_status->ViewCustomAttributes = "";

			// code
			$Liquidate_Payment_Request->code->ViewValue = $Liquidate_Payment_Request->code->CurrentValue;
			$Liquidate_Payment_Request->code->CssStyle = "";
			$Liquidate_Payment_Request->code->CssClass = "";
			$Liquidate_Payment_Request->code->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			if (strval($Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Liquidate_Payment_Request->financial_year_financial_year_id->ViewValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$Liquidate_Payment_Request->financial_year_financial_year_id->ViewValue = $Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$Liquidate_Payment_Request->financial_year_financial_year_id->ViewValue = NULL;
			}
			$Liquidate_Payment_Request->financial_year_financial_year_id->CssStyle = "";
			$Liquidate_Payment_Request->financial_year_financial_year_id->CssClass = "";
			$Liquidate_Payment_Request->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$Liquidate_Payment_Request->amount->ViewValue = $Liquidate_Payment_Request->amount->CurrentValue;
			$Liquidate_Payment_Request->amount->CssStyle = "";
			$Liquidate_Payment_Request->amount->CssClass = "";
			$Liquidate_Payment_Request->amount->ViewCustomAttributes = "";

			// group_id
			$Liquidate_Payment_Request->group_id->ViewValue = $Liquidate_Payment_Request->group_id->CurrentValue;
			$Liquidate_Payment_Request->group_id->CssStyle = "";
			$Liquidate_Payment_Request->group_id->CssClass = "";
			$Liquidate_Payment_Request->group_id->ViewCustomAttributes = "";

			// liquidationdoc
			if (!ew_Empty($Liquidate_Payment_Request->liquidationdoc->Upload->DbValue)) {
				$Liquidate_Payment_Request->liquidationdoc->ViewValue = $Liquidate_Payment_Request->liquidationdoc->Upload->DbValue;
			} else {
				$Liquidate_Payment_Request->liquidationdoc->ViewValue = "";
			}
			$Liquidate_Payment_Request->liquidationdoc->CssStyle = "";
			$Liquidate_Payment_Request->liquidationdoc->CssClass = "";
			$Liquidate_Payment_Request->liquidationdoc->ViewCustomAttributes = "";

			// payment_request_id
			$Liquidate_Payment_Request->payment_request_id->HrefValue = "";
			$Liquidate_Payment_Request->payment_request_id->TooltipValue = "";

			// year
			$Liquidate_Payment_Request->year->HrefValue = "";
			$Liquidate_Payment_Request->year->TooltipValue = "";

			// request_date
			$Liquidate_Payment_Request->request_date->HrefValue = "";
			$Liquidate_Payment_Request->request_date->TooltipValue = "";

			// programarea_id
			$Liquidate_Payment_Request->programarea_id->HrefValue = "";
			$Liquidate_Payment_Request->programarea_id->TooltipValue = "";

			// request_status
			$Liquidate_Payment_Request->request_status->HrefValue = "";
			$Liquidate_Payment_Request->request_status->TooltipValue = "";

			// code
			$Liquidate_Payment_Request->code->HrefValue = "";
			$Liquidate_Payment_Request->code->TooltipValue = "";

			// financial_year_financial_year_id
			$Liquidate_Payment_Request->financial_year_financial_year_id->HrefValue = "";
			$Liquidate_Payment_Request->financial_year_financial_year_id->TooltipValue = "";

			// amount
			$Liquidate_Payment_Request->amount->HrefValue = "";
			$Liquidate_Payment_Request->amount->TooltipValue = "";

			// group_id
			$Liquidate_Payment_Request->group_id->HrefValue = "";
			$Liquidate_Payment_Request->group_id->TooltipValue = "";

			// liquidationdoc
			if (!ew_Empty($Liquidate_Payment_Request->liquidationdoc->Upload->DbValue)) {
				$Liquidate_Payment_Request->liquidationdoc->HrefValue = ew_UploadPathEx(FALSE, $Liquidate_Payment_Request->liquidationdoc->UploadPath) . ((!empty($Liquidate_Payment_Request->liquidationdoc->ViewValue)) ? $Liquidate_Payment_Request->liquidationdoc->ViewValue : $Liquidate_Payment_Request->liquidationdoc->CurrentValue);
				if ($Liquidate_Payment_Request->Export <> "") $Liquidate_Payment_Request->liquidationdoc->HrefValue = ew_ConvertFullUrl($Liquidate_Payment_Request->liquidationdoc->HrefValue);
			} else {
				$Liquidate_Payment_Request->liquidationdoc->HrefValue = "";
			}
			$Liquidate_Payment_Request->liquidationdoc->TooltipValue = "";
		} elseif ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// payment_request_id
			$Liquidate_Payment_Request->payment_request_id->EditCustomAttributes = "";
			$Liquidate_Payment_Request->payment_request_id->EditValue = $Liquidate_Payment_Request->payment_request_id->CurrentValue;
			$Liquidate_Payment_Request->payment_request_id->CssStyle = "";
			$Liquidate_Payment_Request->payment_request_id->CssClass = "";
			$Liquidate_Payment_Request->payment_request_id->ViewCustomAttributes = "";

			// year
			$Liquidate_Payment_Request->year->EditCustomAttributes = "";
			$Liquidate_Payment_Request->year->EditValue = $Liquidate_Payment_Request->year->CurrentValue;
			$Liquidate_Payment_Request->year->CssStyle = "";
			$Liquidate_Payment_Request->year->CssClass = "";
			$Liquidate_Payment_Request->year->ViewCustomAttributes = "";

			// request_date
			$Liquidate_Payment_Request->request_date->EditCustomAttributes = "";
			$Liquidate_Payment_Request->request_date->EditValue = $Liquidate_Payment_Request->request_date->CurrentValue;
			$Liquidate_Payment_Request->request_date->EditValue = ew_FormatDateTime($Liquidate_Payment_Request->request_date->EditValue, 7);
			$Liquidate_Payment_Request->request_date->CssStyle = "";
			$Liquidate_Payment_Request->request_date->CssClass = "";
			$Liquidate_Payment_Request->request_date->ViewCustomAttributes = "";

			// programarea_id
			$Liquidate_Payment_Request->programarea_id->EditCustomAttributes = "";
			if (strval($Liquidate_Payment_Request->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Liquidate_Payment_Request->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Liquidate_Payment_Request->programarea_id->EditValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Liquidate_Payment_Request->programarea_id->EditValue = $Liquidate_Payment_Request->programarea_id->CurrentValue;
				}
			} else {
				$Liquidate_Payment_Request->programarea_id->EditValue = NULL;
			}
			$Liquidate_Payment_Request->programarea_id->CssStyle = "";
			$Liquidate_Payment_Request->programarea_id->CssClass = "";
			$Liquidate_Payment_Request->programarea_id->ViewCustomAttributes = "";

			// request_status
			$Liquidate_Payment_Request->request_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("DISBURSED", "DISBURSED");
			$arwrk[] = array("LIQUIDATED", "LIQUIDATED");
			$Liquidate_Payment_Request->request_status->EditValue = $arwrk;

			// code
			$Liquidate_Payment_Request->code->EditCustomAttributes = "";
			$Liquidate_Payment_Request->code->EditValue = $Liquidate_Payment_Request->code->CurrentValue;
			$Liquidate_Payment_Request->code->CssStyle = "";
			$Liquidate_Payment_Request->code->CssClass = "";
			$Liquidate_Payment_Request->code->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			$Liquidate_Payment_Request->financial_year_financial_year_id->EditCustomAttributes = "";
			if (strval($Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Liquidate_Payment_Request->financial_year_financial_year_id->EditValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$Liquidate_Payment_Request->financial_year_financial_year_id->EditValue = $Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$Liquidate_Payment_Request->financial_year_financial_year_id->EditValue = NULL;
			}
			$Liquidate_Payment_Request->financial_year_financial_year_id->CssStyle = "";
			$Liquidate_Payment_Request->financial_year_financial_year_id->CssClass = "";
			$Liquidate_Payment_Request->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$Liquidate_Payment_Request->amount->EditCustomAttributes = "";
			$Liquidate_Payment_Request->amount->EditValue = $Liquidate_Payment_Request->amount->CurrentValue;
			$Liquidate_Payment_Request->amount->CssStyle = "";
			$Liquidate_Payment_Request->amount->CssClass = "";
			$Liquidate_Payment_Request->amount->ViewCustomAttributes = "";

			// group_id
			$Liquidate_Payment_Request->group_id->EditCustomAttributes = "";
			$Liquidate_Payment_Request->group_id->EditValue = $Liquidate_Payment_Request->group_id->CurrentValue;
			$Liquidate_Payment_Request->group_id->CssStyle = "";
			$Liquidate_Payment_Request->group_id->CssClass = "";
			$Liquidate_Payment_Request->group_id->ViewCustomAttributes = "";

			// liquidationdoc
			$Liquidate_Payment_Request->liquidationdoc->EditCustomAttributes = "";
			if (!ew_Empty($Liquidate_Payment_Request->liquidationdoc->Upload->DbValue)) {
				$Liquidate_Payment_Request->liquidationdoc->EditValue = $Liquidate_Payment_Request->liquidationdoc->Upload->DbValue;
			} else {
				$Liquidate_Payment_Request->liquidationdoc->EditValue = "";
			}

			// Edit refer script
			// payment_request_id

			$Liquidate_Payment_Request->payment_request_id->HrefValue = "";

			// year
			$Liquidate_Payment_Request->year->HrefValue = "";

			// request_date
			$Liquidate_Payment_Request->request_date->HrefValue = "";

			// programarea_id
			$Liquidate_Payment_Request->programarea_id->HrefValue = "";

			// request_status
			$Liquidate_Payment_Request->request_status->HrefValue = "";

			// code
			$Liquidate_Payment_Request->code->HrefValue = "";

			// financial_year_financial_year_id
			$Liquidate_Payment_Request->financial_year_financial_year_id->HrefValue = "";

			// amount
			$Liquidate_Payment_Request->amount->HrefValue = "";

			// group_id
			$Liquidate_Payment_Request->group_id->HrefValue = "";

			// liquidationdoc
			if (!ew_Empty($Liquidate_Payment_Request->liquidationdoc->Upload->DbValue)) {
				$Liquidate_Payment_Request->liquidationdoc->HrefValue = ew_UploadPathEx(FALSE, $Liquidate_Payment_Request->liquidationdoc->UploadPath) . ((!empty($Liquidate_Payment_Request->liquidationdoc->EditValue)) ? $Liquidate_Payment_Request->liquidationdoc->EditValue : $Liquidate_Payment_Request->liquidationdoc->CurrentValue);
				if ($Liquidate_Payment_Request->Export <> "") $Liquidate_Payment_Request->liquidationdoc->HrefValue = ew_ConvertFullUrl($Liquidate_Payment_Request->liquidationdoc->HrefValue);
			} else {
				$Liquidate_Payment_Request->liquidationdoc->HrefValue = "";
			}
		}

		// Call Row Rendered event
		if ($Liquidate_Payment_Request->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$Liquidate_Payment_Request->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $Liquidate_Payment_Request;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($Liquidate_Payment_Request->liquidationdoc->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($Liquidate_Payment_Request->liquidationdoc->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $Liquidate_Payment_Request->liquidationdoc->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}
		if (in_array($Liquidate_Payment_Request->liquidationdoc->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("PhpUploadErr" . $Liquidate_Payment_Request->liquidationdoc->Upload->Error);
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($Liquidate_Payment_Request->liquidationdoc->Upload->Action == "3" && is_null($Liquidate_Payment_Request->liquidationdoc->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $Liquidate_Payment_Request->liquidationdoc->FldCaption();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $Liquidate_Payment_Request;
		$sFilter = $Liquidate_Payment_Request->KeyFilter();
		$Liquidate_Payment_Request->CurrentFilter = $sFilter;
		$sSql = $Liquidate_Payment_Request->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// request_status
			$Liquidate_Payment_Request->request_status->SetDbValueDef($rsnew, $Liquidate_Payment_Request->request_status->CurrentValue, NULL, FALSE);

			// liquidationdoc
			$Liquidate_Payment_Request->liquidationdoc->Upload->SaveToSession(); // Save file value to Session
						if ($Liquidate_Payment_Request->liquidationdoc->Upload->Action == "2" || $Liquidate_Payment_Request->liquidationdoc->Upload->Action == "3") { // Update/Remove
			$Liquidate_Payment_Request->liquidationdoc->Upload->DbValue = $rs->fields('liquidationdoc'); // Get original value
			if (is_null($Liquidate_Payment_Request->liquidationdoc->Upload->Value)) {
				$rsnew['liquidationdoc'] = NULL;
			} else {
				$rsnew['liquidationdoc'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $Liquidate_Payment_Request->liquidationdoc->UploadPath), $Liquidate_Payment_Request->liquidationdoc->Upload->FileName);
			}
			}

			// Call Row Updating event
			$bUpdateRow = $Liquidate_Payment_Request->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($Liquidate_Payment_Request->liquidationdoc->Upload->Value)) {
				$Liquidate_Payment_Request->liquidationdoc->Upload->SaveToFile($Liquidate_Payment_Request->liquidationdoc->UploadPath, $rsnew['liquidationdoc'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($Liquidate_Payment_Request->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($Liquidate_Payment_Request->CancelMessage <> "") {
					$this->setMessage($Liquidate_Payment_Request->CancelMessage);
					$Liquidate_Payment_Request->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$Liquidate_Payment_Request->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();

		// liquidationdoc
		$Liquidate_Payment_Request->liquidationdoc->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'Liquidate Payment Request';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $Liquidate_Payment_Request;
		$table = 'Liquidate Payment Request';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['payment_request_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if ($Liquidate_Payment_Request->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($Liquidate_Payment_Request->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($Liquidate_Payment_Request->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						$oldvalue = "<MEMO>";
						$newvalue = "<MEMO>";
					} elseif ($Liquidate_Payment_Request->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "<XML>";
						$newvalue = "<XML>";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
