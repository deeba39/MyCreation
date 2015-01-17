<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "applicant_schoolinfo.php" ?>
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
$applicant_school_view = new capplicant_school_view();
$Page =& $applicant_school_view;

// Page init
$applicant_school_view->Page_Init();

// Page main
$applicant_school_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($applicant_school->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var applicant_school_view = new ew_Page("applicant_school_view");

// page properties
applicant_school_view.PageID = "view"; // page ID
applicant_school_view.FormID = "fapplicant_schoolview"; // form ID
var EW_PAGE_ID = applicant_school_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
applicant_school_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
applicant_school_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
applicant_school_view.ValidateRequired = false; // no JavaScript validation
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
<?php } ?>
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $applicant_school->TableCaption() ?>
<br><br>
<?php if ($applicant_school->Export == "") { ?>
<a href="<?php echo $applicant_school_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $applicant_school_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $applicant_school_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $applicant_school_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$applicant_school_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($applicant_school->applicant_school_id->Visible) { // applicant_school_id ?>
	<tr<?php echo $applicant_school->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $applicant_school->applicant_school_id->FldCaption() ?></td>
		<td<?php echo $applicant_school->applicant_school_id->CellAttributes() ?>>
<div<?php echo $applicant_school->applicant_school_id->ViewAttributes() ?>><?php echo $applicant_school->applicant_school_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($applicant_school->applicant_school_name->Visible) { // applicant_school_name ?>
	<tr<?php echo $applicant_school->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $applicant_school->applicant_school_name->FldCaption() ?></td>
		<td<?php echo $applicant_school->applicant_school_name->CellAttributes() ?>>
<div<?php echo $applicant_school->applicant_school_name->ViewAttributes() ?>><?php echo $applicant_school->applicant_school_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($applicant_school->applicant_school_type->Visible) { // applicant_school_type ?>
	<tr<?php echo $applicant_school->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $applicant_school->applicant_school_type->FldCaption() ?></td>
		<td<?php echo $applicant_school->applicant_school_type->CellAttributes() ?>>
<div<?php echo $applicant_school->applicant_school_type->ViewAttributes() ?>><?php echo $applicant_school->applicant_school_type->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($applicant_school->applicant_school_category_applicant_school_category_id->Visible) { // applicant_school_category_applicant_school_category_id ?>
	<tr<?php echo $applicant_school->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $applicant_school->applicant_school_category_applicant_school_category_id->FldCaption() ?></td>
		<td<?php echo $applicant_school->applicant_school_category_applicant_school_category_id->CellAttributes() ?>>
<div<?php echo $applicant_school->applicant_school_category_applicant_school_category_id->ViewAttributes() ?>><?php echo $applicant_school->applicant_school_category_applicant_school_category_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($applicant_school->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$applicant_school_view->Page_Terminate();
?>
<?php

//
// Page class
//
class capplicant_school_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'applicant_school';

	// Page object name
	var $PageObjName = 'applicant_school_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $applicant_school;
		if ($applicant_school->UseTokenInUrl) $PageUrl .= "t=" . $applicant_school->TableVar . "&"; // Add page token
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
		global $objForm, $applicant_school;
		if ($applicant_school->UseTokenInUrl) {
			if ($objForm)
				return ($applicant_school->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($applicant_school->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function capplicant_school_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (applicant_school)
		$GLOBALS["applicant_school"] = new capplicant_school();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'applicant_school', TRUE);

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
		global $applicant_school;

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
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("applicant_schoollist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

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
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $applicant_school;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["applicant_school_id"] <> "") {
				$applicant_school->applicant_school_id->setQueryStringValue($_GET["applicant_school_id"]);
				$this->arRecKey["applicant_school_id"] = $applicant_school->applicant_school_id->QueryStringValue;
			} else {
				$sReturnUrl = "applicant_schoollist.php"; // Return to list
			}

			// Get action
			$applicant_school->CurrentAction = "I"; // Display form
			switch ($applicant_school->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "applicant_schoollist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "applicant_schoollist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$applicant_school->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $applicant_school;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$applicant_school->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$applicant_school->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $applicant_school->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$applicant_school->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$applicant_school->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$applicant_school->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $applicant_school;
		$sFilter = $applicant_school->KeyFilter();

		// Call Row Selecting event
		$applicant_school->Row_Selecting($sFilter);

		// Load SQL based on filter
		$applicant_school->CurrentFilter = $sFilter;
		$sSql = $applicant_school->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$applicant_school->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $applicant_school;
		$applicant_school->applicant_school_id->setDbValue($rs->fields('applicant_school_id'));
		$applicant_school->applicant_school_name->setDbValue($rs->fields('applicant_school_name'));
		$applicant_school->applicant_school_type->setDbValue($rs->fields('applicant_school_type'));
		$applicant_school->applicant_school_category_applicant_school_category_id->setDbValue($rs->fields('applicant_school_category_applicant_school_category_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $applicant_school;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "applicant_school_id=" . urlencode($applicant_school->applicant_school_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "applicant_school_id=" . urlencode($applicant_school->applicant_school_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "applicant_school_id=" . urlencode($applicant_school->applicant_school_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "applicant_school_id=" . urlencode($applicant_school->applicant_school_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "applicant_school_id=" . urlencode($applicant_school->applicant_school_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "applicant_school_id=" . urlencode($applicant_school->applicant_school_id->CurrentValue);
		$this->AddUrl = $applicant_school->AddUrl();
		$this->EditUrl = $applicant_school->EditUrl();
		$this->CopyUrl = $applicant_school->CopyUrl();
		$this->DeleteUrl = $applicant_school->DeleteUrl();
		$this->ListUrl = $applicant_school->ListUrl();

		// Call Row_Rendering event
		$applicant_school->Row_Rendering();

		// Common render codes for all row types
		// applicant_school_id

		$applicant_school->applicant_school_id->CellCssStyle = ""; $applicant_school->applicant_school_id->CellCssClass = "";
		$applicant_school->applicant_school_id->CellAttrs = array(); $applicant_school->applicant_school_id->ViewAttrs = array(); $applicant_school->applicant_school_id->EditAttrs = array();

		// applicant_school_name
		$applicant_school->applicant_school_name->CellCssStyle = ""; $applicant_school->applicant_school_name->CellCssClass = "";
		$applicant_school->applicant_school_name->CellAttrs = array(); $applicant_school->applicant_school_name->ViewAttrs = array(); $applicant_school->applicant_school_name->EditAttrs = array();

		// applicant_school_type
		$applicant_school->applicant_school_type->CellCssStyle = ""; $applicant_school->applicant_school_type->CellCssClass = "";
		$applicant_school->applicant_school_type->CellAttrs = array(); $applicant_school->applicant_school_type->ViewAttrs = array(); $applicant_school->applicant_school_type->EditAttrs = array();

		// applicant_school_category_applicant_school_category_id
		$applicant_school->applicant_school_category_applicant_school_category_id->CellCssStyle = ""; $applicant_school->applicant_school_category_applicant_school_category_id->CellCssClass = "";
		$applicant_school->applicant_school_category_applicant_school_category_id->CellAttrs = array(); $applicant_school->applicant_school_category_applicant_school_category_id->ViewAttrs = array(); $applicant_school->applicant_school_category_applicant_school_category_id->EditAttrs = array();
		if ($applicant_school->RowType == EW_ROWTYPE_VIEW) { // View row

			// applicant_school_id
			$applicant_school->applicant_school_id->ViewValue = $applicant_school->applicant_school_id->CurrentValue;
			if (strval($applicant_school->applicant_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_category_id` = " . ew_AdjustSql($applicant_school->applicant_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_category_name` FROM `applicant_school_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$applicant_school->applicant_school_id->ViewValue = $rswrk->fields('applicant_school_category_name');
					$rswrk->Close();
				} else {
					$applicant_school->applicant_school_id->ViewValue = $applicant_school->applicant_school_id->CurrentValue;
				}
			} else {
				$applicant_school->applicant_school_id->ViewValue = NULL;
			}
			$applicant_school->applicant_school_id->CssStyle = "";
			$applicant_school->applicant_school_id->CssClass = "";
			$applicant_school->applicant_school_id->ViewCustomAttributes = "";

			// applicant_school_name
			$applicant_school->applicant_school_name->ViewValue = $applicant_school->applicant_school_name->CurrentValue;
			$applicant_school->applicant_school_name->CssStyle = "";
			$applicant_school->applicant_school_name->CssClass = "";
			$applicant_school->applicant_school_name->ViewCustomAttributes = "";

			// applicant_school_type
			if (strval($applicant_school->applicant_school_type->CurrentValue) <> "") {
				$sFilterWrk = "`school_type_id` = " . ew_AdjustSql($applicant_school->applicant_school_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_type` FROM `school_type`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$applicant_school->applicant_school_type->ViewValue = $rswrk->fields('school_type');
					$rswrk->Close();
				} else {
					$applicant_school->applicant_school_type->ViewValue = $applicant_school->applicant_school_type->CurrentValue;
				}
			} else {
				$applicant_school->applicant_school_type->ViewValue = NULL;
			}
			$applicant_school->applicant_school_type->CssStyle = "";
			$applicant_school->applicant_school_type->CssClass = "";
			$applicant_school->applicant_school_type->ViewCustomAttributes = "";

			// applicant_school_category_applicant_school_category_id
			$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = $applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue;
			if (strval($applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_category_id` = " . ew_AdjustSql($applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_category_name` FROM `applicant_school_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = $rswrk->fields('applicant_school_category_name');
					$rswrk->Close();
				} else {
					$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = $applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue;
				}
			} else {
				$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = NULL;
			}
			$applicant_school->applicant_school_category_applicant_school_category_id->CssStyle = "";
			$applicant_school->applicant_school_category_applicant_school_category_id->CssClass = "";
			$applicant_school->applicant_school_category_applicant_school_category_id->ViewCustomAttributes = "";

			// applicant_school_id
			$applicant_school->applicant_school_id->HrefValue = "";
			$applicant_school->applicant_school_id->TooltipValue = "";

			// applicant_school_name
			$applicant_school->applicant_school_name->HrefValue = "";
			$applicant_school->applicant_school_name->TooltipValue = "";

			// applicant_school_type
			$applicant_school->applicant_school_type->HrefValue = "";
			$applicant_school->applicant_school_type->TooltipValue = "";

			// applicant_school_category_applicant_school_category_id
			$applicant_school->applicant_school_category_applicant_school_category_id->HrefValue = "";
			$applicant_school->applicant_school_category_applicant_school_category_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($applicant_school->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$applicant_school->Row_Rendered();
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
}
?>
