<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "sponsored_studentinfo.php" ?>
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
$sponsored_student_edit = new csponsored_student_edit();
$Page =& $sponsored_student_edit;

// Page init
$sponsored_student_edit->Page_Init();

// Page main
$sponsored_student_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var sponsored_student_edit = new ew_Page("sponsored_student_edit");

// page properties
sponsored_student_edit.PageID = "edit"; // page ID
sponsored_student_edit.FormID = "fsponsored_studentedit"; // form ID
var EW_PAGE_ID = sponsored_student_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
sponsored_student_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_student_firstname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($sponsored_student->student_firstname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_student_lastname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($sponsored_student->student_lastname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_student_picture"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_group_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sponsored_student->group_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_community_community_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sponsored_student->community_community_id->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
sponsored_student_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
sponsored_student_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sponsored_student_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $sponsored_student->TableCaption() ?><br><br>
<a href="<?php echo $sponsored_student->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$sponsored_student_edit->ShowMessage();
?>
<form name="fsponsored_studentedit" id="fsponsored_studentedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return sponsored_student_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="sponsored_student">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($sponsored_student->student_firstname->Visible) { // student_firstname ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_firstname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $sponsored_student->student_firstname->CellAttributes() ?>><span id="el_student_firstname">
<input type="text" name="x_student_firstname" id="x_student_firstname" title="<?php echo $sponsored_student->student_firstname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student->student_firstname->EditValue ?>"<?php echo $sponsored_student->student_firstname->EditAttributes() ?>>
</span><?php echo $sponsored_student->student_firstname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student->student_middlename->Visible) { // student_middlename ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_middlename->FldCaption() ?></td>
		<td<?php echo $sponsored_student->student_middlename->CellAttributes() ?>><span id="el_student_middlename">
<input type="text" name="x_student_middlename" id="x_student_middlename" title="<?php echo $sponsored_student->student_middlename->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student->student_middlename->EditValue ?>"<?php echo $sponsored_student->student_middlename->EditAttributes() ?>>
</span><?php echo $sponsored_student->student_middlename->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student->student_lastname->Visible) { // student_lastname ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_lastname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $sponsored_student->student_lastname->CellAttributes() ?>><span id="el_student_lastname">
<input type="text" name="x_student_lastname" id="x_student_lastname" title="<?php echo $sponsored_student->student_lastname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student->student_lastname->EditValue ?>"<?php echo $sponsored_student->student_lastname->EditAttributes() ?>>
</span><?php echo $sponsored_student->student_lastname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student->student_picture->Visible) { // student_picture ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_picture->FldCaption() ?></td>
		<td<?php echo $sponsored_student->student_picture->CellAttributes() ?>><span id="el_student_picture">
<div id="old_x_student_picture">
<?php if ($sponsored_student->student_picture->HrefValue <> "" || $sponsored_student->student_picture->TooltipValue <> "") { ?>
<?php if (!empty($sponsored_student->student_picture->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $sponsored_student->student_picture->UploadPath) . $sponsored_student->student_picture->Upload->DbValue ?>" border=0<?php echo $sponsored_student->student_picture->ViewAttributes() ?>>
<?php } elseif (!in_array($sponsored_student->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($sponsored_student->student_picture->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $sponsored_student->student_picture->UploadPath) . $sponsored_student->student_picture->Upload->DbValue ?>" border=0<?php echo $sponsored_student->student_picture->ViewAttributes() ?>>
<?php } elseif (!in_array($sponsored_student->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_student_picture">
<?php if (!empty($sponsored_student->student_picture->Upload->DbValue)) { ?>
<label><input type="radio" name="a_student_picture" id="a_student_picture" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_student_picture" id="a_student_picture" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_student_picture" id="a_student_picture" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $sponsored_student->student_picture->EditAttrs["onchange"] = "this.form.a_student_picture[2].checked=true;" . @$sponsored_student->student_picture->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_student_picture" id="a_student_picture" value="3">
<?php } ?>
<input type="file" name="x_student_picture" id="x_student_picture" title="<?php echo $sponsored_student->student_picture->FldTitle() ?>" size="30"<?php echo $sponsored_student->student_picture->EditAttributes() ?>>
</div>
</span><?php echo $sponsored_student->student_picture->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student->student_grades->Visible) { // student_grades ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_grades->FldCaption() ?></td>
		<td<?php echo $sponsored_student->student_grades->CellAttributes() ?>><span id="el_student_grades">
<input type="text" name="x_student_grades" id="x_student_grades" title="<?php echo $sponsored_student->student_grades->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student->student_grades->EditValue ?>"<?php echo $sponsored_student->student_grades->EditAttributes() ?>>
</span><?php echo $sponsored_student->student_grades->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_resident_programarea_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student->student_resident_programarea_id->CellAttributes() ?>><span id="el_student_resident_programarea_id">
<select id="x_student_resident_programarea_id" name="x_student_resident_programarea_id" title="<?php echo $sponsored_student->student_resident_programarea_id->FldTitle() ?>"<?php echo $sponsored_student->student_resident_programarea_id->EditAttributes() ?>>
<?php
if (is_array($sponsored_student->student_resident_programarea_id->EditValue)) {
	$arwrk = $sponsored_student->student_resident_programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($sponsored_student->student_resident_programarea_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $sponsored_student->student_resident_programarea_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student->group_id->Visible) { // group_id ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->group_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student->group_id->CellAttributes() ?>><span id="el_group_id">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_group_id" name="x_group_id" title="<?php echo $sponsored_student->group_id->FldTitle() ?>"<?php echo $sponsored_student->group_id->EditAttributes() ?>>
<?php
if (is_array($sponsored_student->group_id->EditValue)) {
	$arwrk = $sponsored_student->group_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($sponsored_student->group_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } else { ?>
<input type="text" name="x_group_id" id="x_group_id" title="<?php echo $sponsored_student->group_id->FldTitle() ?>" size="30" value="<?php echo $sponsored_student->group_id->EditValue ?>"<?php echo $sponsored_student->group_id->EditAttributes() ?>>
<?php } ?>
</span><?php echo $sponsored_student->group_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student->community_community_id->Visible) { // community_community_id ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->community_community_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $sponsored_student->community_community_id->CellAttributes() ?>><span id="el_community_community_id">
<input type="text" name="x_community_community_id" id="x_community_community_id" title="<?php echo $sponsored_student->community_community_id->FldTitle() ?>" size="30" value="<?php echo $sponsored_student->community_community_id->EditValue ?>"<?php echo $sponsored_student->community_community_id->EditAttributes() ?>>
</span><?php echo $sponsored_student->community_community_id->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_sponsored_student_id" id="x_sponsored_student_id" value="<?php echo ew_HtmlEncode($sponsored_student->sponsored_student_id->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$sponsored_student_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class csponsored_student_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'sponsored_student';

	// Page object name
	var $PageObjName = 'sponsored_student_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $sponsored_student;
		if ($sponsored_student->UseTokenInUrl) $PageUrl .= "t=" . $sponsored_student->TableVar . "&"; // Add page token
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
		global $objForm, $sponsored_student;
		if ($sponsored_student->UseTokenInUrl) {
			if ($objForm)
				return ($sponsored_student->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($sponsored_student->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csponsored_student_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (sponsored_student)
		$GLOBALS["sponsored_student"] = new csponsored_student();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'sponsored_student', TRUE);

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
		global $sponsored_student;

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
			$this->Page_Terminate("sponsored_studentlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("sponsored_studentlist.php");
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
		global $objForm, $Language, $gsFormError, $sponsored_student;

		// Load key from QueryString
		if (@$_GET["sponsored_student_id"] <> "")
			$sponsored_student->sponsored_student_id->setQueryStringValue($_GET["sponsored_student_id"]);
		if (@$_POST["a_edit"] <> "") {
			$sponsored_student->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$sponsored_student->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$sponsored_student->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$sponsored_student->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($sponsored_student->sponsored_student_id->CurrentValue == "")
			$this->Page_Terminate("sponsored_studentlist.php"); // Invalid key, return to list
		switch ($sponsored_student->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("sponsored_studentlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sponsored_student->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $sponsored_student->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$sponsored_student->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$sponsored_student->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $sponsored_student;

		// Get upload data
			if ($sponsored_student->student_picture->Upload->UploadFile()) {

				// No action required
			} else {
				echo $sponsored_student->student_picture->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $sponsored_student;
		$sponsored_student->student_firstname->setFormValue($objForm->GetValue("x_student_firstname"));
		$sponsored_student->student_middlename->setFormValue($objForm->GetValue("x_student_middlename"));
		$sponsored_student->student_lastname->setFormValue($objForm->GetValue("x_student_lastname"));
		$sponsored_student->student_grades->setFormValue($objForm->GetValue("x_student_grades"));
		$sponsored_student->student_resident_programarea_id->setFormValue($objForm->GetValue("x_student_resident_programarea_id"));
		$sponsored_student->group_id->setFormValue($objForm->GetValue("x_group_id"));
		$sponsored_student->community_community_id->setFormValue($objForm->GetValue("x_community_community_id"));
		$sponsored_student->sponsored_student_id->setFormValue($objForm->GetValue("x_sponsored_student_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $sponsored_student;
		$sponsored_student->sponsored_student_id->CurrentValue = $sponsored_student->sponsored_student_id->FormValue;
		$this->LoadRow();
		$sponsored_student->student_firstname->CurrentValue = $sponsored_student->student_firstname->FormValue;
		$sponsored_student->student_middlename->CurrentValue = $sponsored_student->student_middlename->FormValue;
		$sponsored_student->student_lastname->CurrentValue = $sponsored_student->student_lastname->FormValue;
		$sponsored_student->student_grades->CurrentValue = $sponsored_student->student_grades->FormValue;
		$sponsored_student->student_resident_programarea_id->CurrentValue = $sponsored_student->student_resident_programarea_id->FormValue;
		$sponsored_student->group_id->CurrentValue = $sponsored_student->group_id->FormValue;
		$sponsored_student->community_community_id->CurrentValue = $sponsored_student->community_community_id->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $sponsored_student;
		$sFilter = $sponsored_student->KeyFilter();

		// Call Row Selecting event
		$sponsored_student->Row_Selecting($sFilter);

		// Load SQL based on filter
		$sponsored_student->CurrentFilter = $sFilter;
		$sSql = $sponsored_student->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$sponsored_student->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $sponsored_student;
		$sponsored_student->sponsored_student_id->setDbValue($rs->fields('sponsored_student_id'));
		$sponsored_student->student_firstname->setDbValue($rs->fields('student_firstname'));
		$sponsored_student->student_middlename->setDbValue($rs->fields('student_middlename'));
		$sponsored_student->student_lastname->setDbValue($rs->fields('student_lastname'));
		$sponsored_student->student_picture->Upload->DbValue = $rs->fields('student_picture');
		$sponsored_student->student_grades->setDbValue($rs->fields('student_grades'));
		$sponsored_student->student_applicant_student_applicant_id->setDbValue($rs->fields('student_applicant_student_applicant_id'));
		$sponsored_student->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
		$sponsored_student->group_id->setDbValue($rs->fields('group_id'));
		$sponsored_student->community_community_id->setDbValue($rs->fields('community_community_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $sponsored_student;

		// Initialize URLs
		// Call Row_Rendering event

		$sponsored_student->Row_Rendering();

		// Common render codes for all row types
		// student_firstname

		$sponsored_student->student_firstname->CellCssStyle = ""; $sponsored_student->student_firstname->CellCssClass = "";
		$sponsored_student->student_firstname->CellAttrs = array(); $sponsored_student->student_firstname->ViewAttrs = array(); $sponsored_student->student_firstname->EditAttrs = array();

		// student_middlename
		$sponsored_student->student_middlename->CellCssStyle = ""; $sponsored_student->student_middlename->CellCssClass = "";
		$sponsored_student->student_middlename->CellAttrs = array(); $sponsored_student->student_middlename->ViewAttrs = array(); $sponsored_student->student_middlename->EditAttrs = array();

		// student_lastname
		$sponsored_student->student_lastname->CellCssStyle = ""; $sponsored_student->student_lastname->CellCssClass = "";
		$sponsored_student->student_lastname->CellAttrs = array(); $sponsored_student->student_lastname->ViewAttrs = array(); $sponsored_student->student_lastname->EditAttrs = array();

		// student_picture
		$sponsored_student->student_picture->CellCssStyle = ""; $sponsored_student->student_picture->CellCssClass = "";
		$sponsored_student->student_picture->CellAttrs = array(); $sponsored_student->student_picture->ViewAttrs = array(); $sponsored_student->student_picture->EditAttrs = array();

		// student_grades
		$sponsored_student->student_grades->CellCssStyle = ""; $sponsored_student->student_grades->CellCssClass = "";
		$sponsored_student->student_grades->CellAttrs = array(); $sponsored_student->student_grades->ViewAttrs = array(); $sponsored_student->student_grades->EditAttrs = array();

		// student_resident_programarea_id
		$sponsored_student->student_resident_programarea_id->CellCssStyle = ""; $sponsored_student->student_resident_programarea_id->CellCssClass = "";
		$sponsored_student->student_resident_programarea_id->CellAttrs = array(); $sponsored_student->student_resident_programarea_id->ViewAttrs = array(); $sponsored_student->student_resident_programarea_id->EditAttrs = array();

		// group_id
		$sponsored_student->group_id->CellCssStyle = ""; $sponsored_student->group_id->CellCssClass = "";
		$sponsored_student->group_id->CellAttrs = array(); $sponsored_student->group_id->ViewAttrs = array(); $sponsored_student->group_id->EditAttrs = array();

		// community_community_id
		$sponsored_student->community_community_id->CellCssStyle = ""; $sponsored_student->community_community_id->CellCssClass = "";
		$sponsored_student->community_community_id->CellAttrs = array(); $sponsored_student->community_community_id->ViewAttrs = array(); $sponsored_student->community_community_id->EditAttrs = array();
		if ($sponsored_student->RowType == EW_ROWTYPE_VIEW) { // View row

			// sponsored_student_id
			$sponsored_student->sponsored_student_id->ViewValue = $sponsored_student->sponsored_student_id->CurrentValue;
			$sponsored_student->sponsored_student_id->CssStyle = "";
			$sponsored_student->sponsored_student_id->CssClass = "";
			$sponsored_student->sponsored_student_id->ViewCustomAttributes = "";

			// student_firstname
			$sponsored_student->student_firstname->ViewValue = $sponsored_student->student_firstname->CurrentValue;
			$sponsored_student->student_firstname->CssStyle = "";
			$sponsored_student->student_firstname->CssClass = "";
			$sponsored_student->student_firstname->ViewCustomAttributes = "";

			// student_middlename
			$sponsored_student->student_middlename->ViewValue = $sponsored_student->student_middlename->CurrentValue;
			$sponsored_student->student_middlename->CssStyle = "";
			$sponsored_student->student_middlename->CssClass = "";
			$sponsored_student->student_middlename->ViewCustomAttributes = "";

			// student_lastname
			$sponsored_student->student_lastname->ViewValue = $sponsored_student->student_lastname->CurrentValue;
			$sponsored_student->student_lastname->CssStyle = "";
			$sponsored_student->student_lastname->CssClass = "";
			$sponsored_student->student_lastname->ViewCustomAttributes = "";

			// student_picture
			if (!ew_Empty($sponsored_student->student_picture->Upload->DbValue)) {
				$sponsored_student->student_picture->ViewValue = $sponsored_student->student_picture->Upload->DbValue;
				$sponsored_student->student_picture->ImageAlt = $sponsored_student->student_picture->FldAlt();
			} else {
				$sponsored_student->student_picture->ViewValue = "";
			}
			$sponsored_student->student_picture->CssStyle = "";
			$sponsored_student->student_picture->CssClass = "";
			$sponsored_student->student_picture->ViewCustomAttributes = "";

			// student_grades
			$sponsored_student->student_grades->ViewValue = $sponsored_student->student_grades->CurrentValue;
			$sponsored_student->student_grades->CssStyle = "";
			$sponsored_student->student_grades->CssClass = "";
			$sponsored_student->student_grades->ViewCustomAttributes = "";

			// student_applicant_student_applicant_id
			$sponsored_student->student_applicant_student_applicant_id->ViewValue = $sponsored_student->student_applicant_student_applicant_id->CurrentValue;
			if (strval($sponsored_student->student_applicant_student_applicant_id->CurrentValue) <> "") {
				$sFilterWrk = "`student_applicant_id` = " . ew_AdjustSql($sponsored_student->student_applicant_student_applicant_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `student_lastname`, `student_firstname` FROM `student_applicant`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sponsored_student->student_applicant_student_applicant_id->ViewValue = $rswrk->fields('student_lastname');
					$sponsored_student->student_applicant_student_applicant_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('student_firstname');
					$rswrk->Close();
				} else {
					$sponsored_student->student_applicant_student_applicant_id->ViewValue = $sponsored_student->student_applicant_student_applicant_id->CurrentValue;
				}
			} else {
				$sponsored_student->student_applicant_student_applicant_id->ViewValue = NULL;
			}
			$sponsored_student->student_applicant_student_applicant_id->CssStyle = "";
			$sponsored_student->student_applicant_student_applicant_id->CssClass = "";
			$sponsored_student->student_applicant_student_applicant_id->ViewCustomAttributes = "";

			// student_resident_programarea_id
			if (strval($sponsored_student->student_resident_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($sponsored_student->student_resident_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sponsored_student->student_resident_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$sponsored_student->student_resident_programarea_id->ViewValue = $sponsored_student->student_resident_programarea_id->CurrentValue;
				}
			} else {
				$sponsored_student->student_resident_programarea_id->ViewValue = NULL;
			}
			$sponsored_student->student_resident_programarea_id->CssStyle = "";
			$sponsored_student->student_resident_programarea_id->CssClass = "";
			$sponsored_student->student_resident_programarea_id->ViewCustomAttributes = "";

			// group_id
			$sponsored_student->group_id->ViewValue = $sponsored_student->group_id->CurrentValue;
			$sponsored_student->group_id->CssStyle = "";
			$sponsored_student->group_id->CssClass = "";
			$sponsored_student->group_id->ViewCustomAttributes = "";

			// community_community_id
			$sponsored_student->community_community_id->ViewValue = $sponsored_student->community_community_id->CurrentValue;
			$sponsored_student->community_community_id->CssStyle = "";
			$sponsored_student->community_community_id->CssClass = "";
			$sponsored_student->community_community_id->ViewCustomAttributes = "";

			// student_firstname
			$sponsored_student->student_firstname->HrefValue = "";
			$sponsored_student->student_firstname->TooltipValue = "";

			// student_middlename
			$sponsored_student->student_middlename->HrefValue = "";
			$sponsored_student->student_middlename->TooltipValue = "";

			// student_lastname
			$sponsored_student->student_lastname->HrefValue = "";
			$sponsored_student->student_lastname->TooltipValue = "";

			// student_picture
			$sponsored_student->student_picture->HrefValue = "";
			$sponsored_student->student_picture->TooltipValue = "";

			// student_grades
			$sponsored_student->student_grades->HrefValue = "";
			$sponsored_student->student_grades->TooltipValue = "";

			// student_resident_programarea_id
			$sponsored_student->student_resident_programarea_id->HrefValue = "";
			$sponsored_student->student_resident_programarea_id->TooltipValue = "";

			// group_id
			$sponsored_student->group_id->HrefValue = "";
			$sponsored_student->group_id->TooltipValue = "";

			// community_community_id
			$sponsored_student->community_community_id->HrefValue = "";
			$sponsored_student->community_community_id->TooltipValue = "";
		} elseif ($sponsored_student->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// student_firstname
			$sponsored_student->student_firstname->EditCustomAttributes = "";
			$sponsored_student->student_firstname->EditValue = ew_HtmlEncode($sponsored_student->student_firstname->CurrentValue);

			// student_middlename
			$sponsored_student->student_middlename->EditCustomAttributes = "";
			$sponsored_student->student_middlename->EditValue = ew_HtmlEncode($sponsored_student->student_middlename->CurrentValue);

			// student_lastname
			$sponsored_student->student_lastname->EditCustomAttributes = "";
			$sponsored_student->student_lastname->EditValue = ew_HtmlEncode($sponsored_student->student_lastname->CurrentValue);

			// student_picture
			$sponsored_student->student_picture->EditCustomAttributes = "";
			if (!ew_Empty($sponsored_student->student_picture->Upload->DbValue)) {
				$sponsored_student->student_picture->EditValue = $sponsored_student->student_picture->Upload->DbValue;
				$sponsored_student->student_picture->ImageAlt = $sponsored_student->student_picture->FldAlt();
			} else {
				$sponsored_student->student_picture->EditValue = "";
			}

			// student_grades
			$sponsored_student->student_grades->EditCustomAttributes = "";
			$sponsored_student->student_grades->EditValue = ew_HtmlEncode($sponsored_student->student_grades->CurrentValue);

			// student_resident_programarea_id
			$sponsored_student->student_resident_programarea_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `programarea_id`, `programarea_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$sponsored_student->student_resident_programarea_id->EditValue = $arwrk;

			// group_id
			$sponsored_student->group_id->EditCustomAttributes = "";
			if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
			$sFilterWrk = "";
			$sFilterWrk = $GLOBALS["users"]->AddUserIDFilter("");
			$sSqlWrk = "SELECT `userlevelid`, `userlevelid` FROM `users`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$sponsored_student->group_id->EditValue = $arwrk;
			} else {
			$sponsored_student->group_id->EditValue = ew_HtmlEncode($sponsored_student->group_id->CurrentValue);
			}

			// community_community_id
			$sponsored_student->community_community_id->EditCustomAttributes = "";
			$sponsored_student->community_community_id->EditValue = ew_HtmlEncode($sponsored_student->community_community_id->CurrentValue);

			// Edit refer script
			// student_firstname

			$sponsored_student->student_firstname->HrefValue = "";

			// student_middlename
			$sponsored_student->student_middlename->HrefValue = "";

			// student_lastname
			$sponsored_student->student_lastname->HrefValue = "";

			// student_picture
			$sponsored_student->student_picture->HrefValue = "";

			// student_grades
			$sponsored_student->student_grades->HrefValue = "";

			// student_resident_programarea_id
			$sponsored_student->student_resident_programarea_id->HrefValue = "";

			// group_id
			$sponsored_student->group_id->HrefValue = "";

			// community_community_id
			$sponsored_student->community_community_id->HrefValue = "";
		}

		// Call Row Rendered event
		if ($sponsored_student->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$sponsored_student->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $sponsored_student;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($sponsored_student->student_picture->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($sponsored_student->student_picture->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $sponsored_student->student_picture->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}
		if (in_array($sponsored_student->student_picture->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("PhpUploadErr" . $sponsored_student->student_picture->Upload->Error);
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($sponsored_student->student_firstname->FormValue) && $sponsored_student->student_firstname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $sponsored_student->student_firstname->FldCaption();
		}
		if (!is_null($sponsored_student->student_lastname->FormValue) && $sponsored_student->student_lastname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $sponsored_student->student_lastname->FldCaption();
		}
		if (!ew_CheckInteger($sponsored_student->group_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $sponsored_student->group_id->FldErrMsg();
		}
		if (!ew_CheckInteger($sponsored_student->community_community_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $sponsored_student->community_community_id->FldErrMsg();
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
		global $conn, $Security, $Language, $sponsored_student;
		$sFilter = $sponsored_student->KeyFilter();
		$sponsored_student->CurrentFilter = $sFilter;
		$sSql = $sponsored_student->SQL();
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

			// student_firstname
			$sponsored_student->student_firstname->SetDbValueDef($rsnew, $sponsored_student->student_firstname->CurrentValue, NULL, FALSE);

			// student_middlename
			$sponsored_student->student_middlename->SetDbValueDef($rsnew, $sponsored_student->student_middlename->CurrentValue, NULL, FALSE);

			// student_lastname
			$sponsored_student->student_lastname->SetDbValueDef($rsnew, $sponsored_student->student_lastname->CurrentValue, NULL, FALSE);

			// student_picture
			$sponsored_student->student_picture->Upload->SaveToSession(); // Save file value to Session
						if ($sponsored_student->student_picture->Upload->Action == "2" || $sponsored_student->student_picture->Upload->Action == "3") { // Update/Remove
			$sponsored_student->student_picture->Upload->DbValue = $rs->fields('student_picture'); // Get original value
			if (is_null($sponsored_student->student_picture->Upload->Value)) {
				$rsnew['student_picture'] = NULL;
			} else {
				$rsnew['student_picture'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $sponsored_student->student_picture->UploadPath), $sponsored_student->student_picture->Upload->FileName);
			}
			}

			// student_grades
			$sponsored_student->student_grades->SetDbValueDef($rsnew, $sponsored_student->student_grades->CurrentValue, NULL, FALSE);

			// student_resident_programarea_id
			$sponsored_student->student_resident_programarea_id->SetDbValueDef($rsnew, $sponsored_student->student_resident_programarea_id->CurrentValue, NULL, FALSE);

			// group_id
			$sponsored_student->group_id->SetDbValueDef($rsnew, $sponsored_student->group_id->CurrentValue, NULL, FALSE);

			// community_community_id
			$sponsored_student->community_community_id->SetDbValueDef($rsnew, $sponsored_student->community_community_id->CurrentValue, 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $sponsored_student->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($sponsored_student->student_picture->Upload->Value)) {
				$sponsored_student->student_picture->Upload->SaveToFile($sponsored_student->student_picture->UploadPath, $rsnew['student_picture'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($sponsored_student->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($sponsored_student->CancelMessage <> "") {
					$this->setMessage($sponsored_student->CancelMessage);
					$sponsored_student->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$sponsored_student->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();

		// student_picture
		$sponsored_student->student_picture->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'sponsored_student';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $sponsored_student;
		$table = 'sponsored_student';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['sponsored_student_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if ($sponsored_student->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($sponsored_student->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($sponsored_student->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						$oldvalue = "<MEMO>";
						$newvalue = "<MEMO>";
					} elseif ($sponsored_student->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
