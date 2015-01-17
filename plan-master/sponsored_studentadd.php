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
$sponsored_student_add = new csponsored_student_add();
$Page =& $sponsored_student_add;

// Page init
$sponsored_student_add->Page_Init();

// Page main
$sponsored_student_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var sponsored_student_add = new ew_Page("sponsored_student_add");

// page properties
sponsored_student_add.PageID = "add"; // page ID
sponsored_student_add.FormID = "fsponsored_studentadd"; // form ID
var EW_PAGE_ID = sponsored_student_add.PageID; // for backward compatibility

// extend page with ValidateForm function
sponsored_student_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_student_resident_programarea_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sponsored_student->student_resident_programarea_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_group_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sponsored_student->group_id->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
sponsored_student_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
sponsored_student_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sponsored_student_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $sponsored_student->TableCaption() ?><br><br>
<a href="<?php echo $sponsored_student->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$sponsored_student_add->ShowMessage();
?>
<form name="fsponsored_studentadd" id="fsponsored_studentadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return sponsored_student_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="sponsored_student">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($sponsored_student->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_resident_programarea_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student->student_resident_programarea_id->CellAttributes() ?>><span id="el_student_resident_programarea_id">
<input type="text" name="x_student_resident_programarea_id" id="x_student_resident_programarea_id" title="<?php echo $sponsored_student->student_resident_programarea_id->FldTitle() ?>" size="30" value="<?php echo $sponsored_student->student_resident_programarea_id->EditValue ?>"<?php echo $sponsored_student->student_resident_programarea_id->EditAttributes() ?>>
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
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$sponsored_student_add->Page_Terminate();
?>
<?php

//
// Page class
//
class csponsored_student_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'sponsored_student';

	// Page object name
	var $PageObjName = 'sponsored_student_add';

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
	function csponsored_student_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (sponsored_student)
		$GLOBALS["sponsored_student"] = new csponsored_student();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $sponsored_student;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["sponsored_student_id"] != "") {
		  $sponsored_student->sponsored_student_id->setQueryStringValue($_GET["sponsored_student_id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $sponsored_student->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$sponsored_student->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $sponsored_student->CurrentAction = "C"; // Copy record
		  } else {
		    $sponsored_student->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($sponsored_student->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("sponsored_studentlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$sponsored_student->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $sponsored_student->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$sponsored_student->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $sponsored_student;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $sponsored_student;
		$sponsored_student->group_id->CurrentValue = CurrentUserID();
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $sponsored_student;
		$sponsored_student->student_resident_programarea_id->setFormValue($objForm->GetValue("x_student_resident_programarea_id"));
		$sponsored_student->group_id->setFormValue($objForm->GetValue("x_group_id"));
		$sponsored_student->sponsored_student_id->setFormValue($objForm->GetValue("x_sponsored_student_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $sponsored_student;
		$sponsored_student->sponsored_student_id->CurrentValue = $sponsored_student->sponsored_student_id->FormValue;
		$sponsored_student->student_resident_programarea_id->CurrentValue = $sponsored_student->student_resident_programarea_id->FormValue;
		$sponsored_student->group_id->CurrentValue = $sponsored_student->group_id->FormValue;
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
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $sponsored_student;

		// Initialize URLs
		// Call Row_Rendering event

		$sponsored_student->Row_Rendering();

		// Common render codes for all row types
		// student_resident_programarea_id

		$sponsored_student->student_resident_programarea_id->CellCssStyle = ""; $sponsored_student->student_resident_programarea_id->CellCssClass = "";
		$sponsored_student->student_resident_programarea_id->CellAttrs = array(); $sponsored_student->student_resident_programarea_id->ViewAttrs = array(); $sponsored_student->student_resident_programarea_id->EditAttrs = array();

		// group_id
		$sponsored_student->group_id->CellCssStyle = ""; $sponsored_student->group_id->CellCssClass = "";
		$sponsored_student->group_id->CellAttrs = array(); $sponsored_student->group_id->ViewAttrs = array(); $sponsored_student->group_id->EditAttrs = array();
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
			$sponsored_student->student_resident_programarea_id->ViewValue = $sponsored_student->student_resident_programarea_id->CurrentValue;
			$sponsored_student->student_resident_programarea_id->CssStyle = "";
			$sponsored_student->student_resident_programarea_id->CssClass = "";
			$sponsored_student->student_resident_programarea_id->ViewCustomAttributes = "";

			// group_id
			$sponsored_student->group_id->ViewValue = $sponsored_student->group_id->CurrentValue;
			$sponsored_student->group_id->CssStyle = "";
			$sponsored_student->group_id->CssClass = "";
			$sponsored_student->group_id->ViewCustomAttributes = "";

			// student_resident_programarea_id
			$sponsored_student->student_resident_programarea_id->HrefValue = "";
			$sponsored_student->student_resident_programarea_id->TooltipValue = "";

			// group_id
			$sponsored_student->group_id->HrefValue = "";
			$sponsored_student->group_id->TooltipValue = "";
		} elseif ($sponsored_student->RowType == EW_ROWTYPE_ADD) { // Add row

			// student_resident_programarea_id
			$sponsored_student->student_resident_programarea_id->EditCustomAttributes = "";
			$sponsored_student->student_resident_programarea_id->EditValue = ew_HtmlEncode($sponsored_student->student_resident_programarea_id->CurrentValue);

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

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($sponsored_student->student_resident_programarea_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $sponsored_student->student_resident_programarea_id->FldErrMsg();
		}
		if (!ew_CheckInteger($sponsored_student->group_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $sponsored_student->group_id->FldErrMsg();
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

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $sponsored_student;

		// Check if valid User ID
		$bValidUser = FALSE;
		if ($Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			$bValidUser = $Security->IsValidUserID($sponsored_student->group_id->CurrentValue);
			if (!$bValidUser) {
				$sUserIdMsg = str_replace("%c", CurrentUserID(), $Language->Phrase("UnAuthorizedUserID"));
				$sUserIdMsg = str_replace("%u", $sponsored_student->group_id->CurrentValue, $sUserIdMsg);
				$this->setMessage($sUserIdMsg);				
				return FALSE;
			}
		}
		$rsnew = array();

		// student_resident_programarea_id
		$sponsored_student->student_resident_programarea_id->SetDbValueDef($rsnew, $sponsored_student->student_resident_programarea_id->CurrentValue, NULL, FALSE);

		// group_id
		$sponsored_student->group_id->SetDbValueDef($rsnew, $sponsored_student->group_id->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $sponsored_student->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($sponsored_student->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($sponsored_student->CancelMessage <> "") {
				$this->setMessage($sponsored_student->CancelMessage);
				$sponsored_student->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$sponsored_student->sponsored_student_id->setDbValue($conn->Insert_ID());
			$rsnew['sponsored_student_id'] = $sponsored_student->sponsored_student_id->DbValue;

			// Call Row Inserted event
			$sponsored_student->Row_Inserted($rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'sponsored_student';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $sponsored_student;
		$table = 'sponsored_student';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['sponsored_student_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if ($sponsored_student->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($sponsored_student->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					$newvalue = "<MEMO>"; // Memo Field
				} elseif ($sponsored_student->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$newvalue = "<XML>"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
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
