<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "payment_requestinfo.php" ?>
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
$payment_request_add = new cpayment_request_add();
$Page =& $payment_request_add;

// Page init
$payment_request_add->Page_Init();

// Page main
$payment_request_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var payment_request_add = new ew_Page("payment_request_add");

// page properties
payment_request_add.PageID = "add"; // page ID
payment_request_add.FormID = "fpayment_requestadd"; // form ID
var EW_PAGE_ID = payment_request_add.PageID; // for backward compatibility

// extend page with ValidateForm function
payment_request_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_financial_year_financial_year_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($payment_request->financial_year_financial_year_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_group_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($payment_request->group_id->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
payment_request_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
payment_request_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
payment_request_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $payment_request->TableCaption() ?><br><br>
<a href="<?php echo $payment_request->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$payment_request_add->ShowMessage();
?>
<form name="fpayment_requestadd" id="fpayment_requestadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return payment_request_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="payment_request">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($payment_request->programarea_id->Visible) { // programarea_id ?>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->programarea_id->FldCaption() ?></td>
		<td<?php echo $payment_request->programarea_id->CellAttributes() ?>><span id="el_programarea_id">
<?php 
$programarea_id=$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"];
if($programarea_id!=0){ 
?>
<input type="hidden" id="x_programarea_id" name="x_programarea_id" value="<?php echo $programarea_id ?>">
<?php
echo $_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA_NAME"];
}else{
?>		
<select id="x_programarea_id" name="x_programarea_id" title="<?php echo $payment_request->programarea_id->FldTitle() ?>"<?php echo $payment_request->programarea_id->EditAttributes() ?>>
<?php
if (is_array($payment_request->programarea_id->EditValue)) {
	$arwrk = $payment_request->programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($payment_request->programarea_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
</span><?php echo $payment_request->programarea_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($payment_request->code->Visible) { // code ?>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->code->FldCaption() ?></td>
		<td<?php echo $payment_request->code->CellAttributes() ?>><span id="el_code">
<input type="text" name="x_code" id="x_code" title="<?php echo $payment_request->code->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $payment_request->code->EditValue ?>"<?php echo $payment_request->code->EditAttributes() ?>>
</span><?php echo $payment_request->code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($payment_request->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->financial_year_financial_year_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $payment_request->financial_year_financial_year_id->CellAttributes() ?>><span id="el_financial_year_financial_year_id">
<select id="x_financial_year_financial_year_id" name="x_financial_year_financial_year_id" title="<?php echo $payment_request->financial_year_financial_year_id->FldTitle() ?>"<?php echo $payment_request->financial_year_financial_year_id->EditAttributes() ?>>
<?php
if (is_array($payment_request->financial_year_financial_year_id->EditValue)) {
	$arwrk = $payment_request->financial_year_financial_year_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($payment_request->financial_year_financial_year_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $payment_request->financial_year_financial_year_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($payment_request->group_id->Visible) { // group_id ?>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->group_id->FldCaption() ?></td>
		<td<?php echo $payment_request->group_id->CellAttributes() ?>><span id="el_group_id">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_group_id" name="x_group_id" title="<?php echo $payment_request->group_id->FldTitle() ?>"<?php echo $payment_request->group_id->EditAttributes() ?>>
<?php
if (is_array($payment_request->group_id->EditValue)) {
	$arwrk = $payment_request->group_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($payment_request->group_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<input type="text" name="x_group_id" id="x_group_id" title="<?php echo $payment_request->group_id->FldTitle() ?>" size="30" value="<?php echo $payment_request->group_id->EditValue ?>"<?php echo $payment_request->group_id->EditAttributes() ?>>
<?php } ?>
</span><?php echo $payment_request->group_id->CustomMsg ?></td>
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
$payment_request_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cpayment_request_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'payment_request';

	// Page object name
	var $PageObjName = 'payment_request_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $payment_request;
		if ($payment_request->UseTokenInUrl) $PageUrl .= "t=" . $payment_request->TableVar . "&"; // Add page token
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
		global $objForm, $payment_request;
		if ($payment_request->UseTokenInUrl) {
			if ($objForm)
				return ($payment_request->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($payment_request->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpayment_request_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (payment_request)
		$GLOBALS["payment_request"] = new cpayment_request();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'payment_request', TRUE);

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
		global $payment_request;

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
			$this->Page_Terminate("payment_requestlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("payment_requestlist.php");
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
		global $objForm, $Language, $gsFormError, $payment_request;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["payment_request_id"] != "") {
		  $payment_request->payment_request_id->setQueryStringValue($_GET["payment_request_id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $payment_request->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$payment_request->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $payment_request->CurrentAction = "C"; // Copy record
		  } else {
		    $payment_request->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($payment_request->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("payment_requestlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$payment_request->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $payment_request->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$payment_request->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $payment_request;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $payment_request;
		$payment_request->group_id->CurrentValue = CurrentUserID();
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $payment_request;
		$payment_request->programarea_id->setFormValue($objForm->GetValue("x_programarea_id"));
		$payment_request->code->setFormValue($objForm->GetValue("x_code"));
		$payment_request->financial_year_financial_year_id->setFormValue($objForm->GetValue("x_financial_year_financial_year_id"));
		$payment_request->group_id->setFormValue($objForm->GetValue("x_group_id"));
		$payment_request->payment_request_id->setFormValue($objForm->GetValue("x_payment_request_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $payment_request;
		$payment_request->payment_request_id->CurrentValue = $payment_request->payment_request_id->FormValue;
		$payment_request->programarea_id->CurrentValue = $payment_request->programarea_id->FormValue;
		$payment_request->code->CurrentValue = $payment_request->code->FormValue;
		$payment_request->financial_year_financial_year_id->CurrentValue = $payment_request->financial_year_financial_year_id->FormValue;
		$payment_request->group_id->CurrentValue = $payment_request->group_id->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $payment_request;
		$sFilter = $payment_request->KeyFilter();

		// Call Row Selecting event
		$payment_request->Row_Selecting($sFilter);

		// Load SQL based on filter
		$payment_request->CurrentFilter = $sFilter;
		$sSql = $payment_request->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$payment_request->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $payment_request;
		$payment_request->payment_request_id->setDbValue($rs->fields('payment_request_id'));
		$payment_request->year->setDbValue($rs->fields('year'));
		$payment_request->request_date->setDbValue($rs->fields('request_date'));
		$payment_request->programarea_id->setDbValue($rs->fields('programarea_id'));
		$payment_request->request_status->setDbValue($rs->fields('request_status'));
		$payment_request->code->setDbValue($rs->fields('code'));
		$payment_request->financial_year_financial_year_id->setDbValue($rs->fields('financial_year_financial_year_id'));
		$payment_request->amount->setDbValue($rs->fields('amount'));
		$payment_request->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $payment_request;

		// Initialize URLs
		// Call Row_Rendering event

		$payment_request->Row_Rendering();

		// Common render codes for all row types
		// programarea_id

		$payment_request->programarea_id->CellCssStyle = ""; $payment_request->programarea_id->CellCssClass = "";
		$payment_request->programarea_id->CellAttrs = array(); $payment_request->programarea_id->ViewAttrs = array(); $payment_request->programarea_id->EditAttrs = array();

		// code
		$payment_request->code->CellCssStyle = ""; $payment_request->code->CellCssClass = "";
		$payment_request->code->CellAttrs = array(); $payment_request->code->ViewAttrs = array(); $payment_request->code->EditAttrs = array();

		// financial_year_financial_year_id
		$payment_request->financial_year_financial_year_id->CellCssStyle = ""; $payment_request->financial_year_financial_year_id->CellCssClass = "";
		$payment_request->financial_year_financial_year_id->CellAttrs = array(); $payment_request->financial_year_financial_year_id->ViewAttrs = array(); $payment_request->financial_year_financial_year_id->EditAttrs = array();

		// group_id
		$payment_request->group_id->CellCssStyle = ""; $payment_request->group_id->CellCssClass = "";
		$payment_request->group_id->CellAttrs = array(); $payment_request->group_id->ViewAttrs = array(); $payment_request->group_id->EditAttrs = array();
		if ($payment_request->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$payment_request->payment_request_id->ViewValue = $payment_request->payment_request_id->CurrentValue;
			$payment_request->payment_request_id->CssStyle = "";
			$payment_request->payment_request_id->CssClass = "";
			$payment_request->payment_request_id->ViewCustomAttributes = "";

			// year
			$payment_request->year->ViewValue = $payment_request->year->CurrentValue;
			$payment_request->year->CssStyle = "";
			$payment_request->year->CssClass = "";
			$payment_request->year->ViewCustomAttributes = "";

			// request_date
			$payment_request->request_date->ViewValue = $payment_request->request_date->CurrentValue;
			$payment_request->request_date->ViewValue = ew_FormatDateTime($payment_request->request_date->ViewValue, 7);
			$payment_request->request_date->CssStyle = "";
			$payment_request->request_date->CssClass = "";
			$payment_request->request_date->ViewCustomAttributes = "";

			// programarea_id
			if (strval($payment_request->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($payment_request->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$payment_request->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$payment_request->programarea_id->ViewValue = $payment_request->programarea_id->CurrentValue;
				}
			} else {
				$payment_request->programarea_id->ViewValue = NULL;
			}
			$payment_request->programarea_id->CssStyle = "";
			$payment_request->programarea_id->CssClass = "";
			$payment_request->programarea_id->ViewCustomAttributes = "";

			// request_status
			$payment_request->request_status->ViewValue = $payment_request->request_status->CurrentValue;
			$payment_request->request_status->CssStyle = "";
			$payment_request->request_status->CssClass = "";
			$payment_request->request_status->ViewCustomAttributes = "";

			// code
			$payment_request->code->ViewValue = $payment_request->code->CurrentValue;
			$payment_request->code->CssStyle = "";
			$payment_request->code->CssClass = "";
			$payment_request->code->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			if (strval($payment_request->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($payment_request->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$payment_request->financial_year_financial_year_id->ViewValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$payment_request->financial_year_financial_year_id->ViewValue = $payment_request->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$payment_request->financial_year_financial_year_id->ViewValue = NULL;
			}
			$payment_request->financial_year_financial_year_id->CssStyle = "";
			$payment_request->financial_year_financial_year_id->CssClass = "";
			$payment_request->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$payment_request->amount->ViewValue = $payment_request->amount->CurrentValue;
			$payment_request->amount->CssStyle = "";
			$payment_request->amount->CssClass = "";
			$payment_request->amount->ViewCustomAttributes = "";

			// group_id
			$payment_request->group_id->ViewValue = $payment_request->group_id->CurrentValue;
			$payment_request->group_id->CssStyle = "";
			$payment_request->group_id->CssClass = "";
			$payment_request->group_id->ViewCustomAttributes = "";

			// programarea_id
			$payment_request->programarea_id->HrefValue = "";
			$payment_request->programarea_id->TooltipValue = "";

			// code
			$payment_request->code->HrefValue = "";
			$payment_request->code->TooltipValue = "";

			// financial_year_financial_year_id
			$payment_request->financial_year_financial_year_id->HrefValue = "";
			$payment_request->financial_year_financial_year_id->TooltipValue = "";

			// group_id
			$payment_request->group_id->HrefValue = "";
			$payment_request->group_id->TooltipValue = "";
		} elseif ($payment_request->RowType == EW_ROWTYPE_ADD) { // Add row

			// programarea_id
			$payment_request->programarea_id->EditCustomAttributes = "";
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
			$payment_request->programarea_id->EditValue = $arwrk;

			// code
			$payment_request->code->EditCustomAttributes = "";
			$payment_request->code->EditValue = ew_HtmlEncode($payment_request->code->CurrentValue);

			// financial_year_financial_year_id
			$payment_request->financial_year_financial_year_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `financial_year_id`, `year_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `financial_year`";
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
			$payment_request->financial_year_financial_year_id->EditValue = $arwrk;

			// group_id
			$payment_request->group_id->EditCustomAttributes = "";
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
			$payment_request->group_id->EditValue = $arwrk;
			} else {
			$payment_request->group_id->EditValue = ew_HtmlEncode($payment_request->group_id->CurrentValue);
			}
		}

		// Call Row Rendered event
		if ($payment_request->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$payment_request->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $payment_request;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($payment_request->financial_year_financial_year_id->FormValue) && $payment_request->financial_year_financial_year_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $payment_request->financial_year_financial_year_id->FldCaption();
		}
		if (!ew_CheckInteger($payment_request->group_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $payment_request->group_id->FldErrMsg();
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
		global $conn, $Language, $Security, $payment_request;

		// Check if valid User ID
		$bValidUser = FALSE;
		if ($Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			$bValidUser = $Security->IsValidUserID($payment_request->group_id->CurrentValue);
			if (!$bValidUser) {
				$sUserIdMsg = str_replace("%c", CurrentUserID(), $Language->Phrase("UnAuthorizedUserID"));
				$sUserIdMsg = str_replace("%u", $payment_request->group_id->CurrentValue, $sUserIdMsg);
				$this->setMessage($sUserIdMsg);				
				return FALSE;
			}
		}
		$rsnew = array();

		// programarea_id
		$payment_request->programarea_id->SetDbValueDef($rsnew, $payment_request->programarea_id->CurrentValue, NULL, FALSE);

		// code
		$payment_request->code->SetDbValueDef($rsnew, $payment_request->code->CurrentValue, NULL, FALSE);

		// financial_year_financial_year_id
		$payment_request->financial_year_financial_year_id->SetDbValueDef($rsnew, $payment_request->financial_year_financial_year_id->CurrentValue, 0, FALSE);

		// group_id
		$payment_request->group_id->SetDbValueDef($rsnew, $payment_request->group_id->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $payment_request->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($payment_request->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($payment_request->CancelMessage <> "") {
				$this->setMessage($payment_request->CancelMessage);
				$payment_request->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$payment_request->payment_request_id->setDbValue($conn->Insert_ID());
			$rsnew['payment_request_id'] = $payment_request->payment_request_id->DbValue;

			// Call Row Inserted event
			$payment_request->Row_Inserted($rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'payment_request';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $payment_request;
		$table = 'payment_request';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['payment_request_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if ($payment_request->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($payment_request->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					$newvalue = "<MEMO>"; // Memo Field
				} elseif ($payment_request->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
