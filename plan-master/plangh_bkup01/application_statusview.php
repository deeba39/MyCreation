<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "application_statusinfo.php" ?>
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
$application_status_view = new capplication_status_view();
$Page =& $application_status_view;

// Page init
$application_status_view->Page_Init();

// Page main
$application_status_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($application_status->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var application_status_view = new ew_Page("application_status_view");

// page properties
application_status_view.PageID = "view"; // page ID
application_status_view.FormID = "fapplication_statusview"; // form ID
var EW_PAGE_ID = application_status_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
application_status_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
application_status_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
application_status_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $application_status->TableCaption() ?>
<br><br>
<?php if ($application_status->Export == "") { ?>
<a href="<?php echo $application_status_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $application_status_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $application_status_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $application_status_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$application_status_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($application_status->application_status_id->Visible) { // application_status_id ?>
	<tr<?php echo $application_status->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $application_status->application_status_id->FldCaption() ?></td>
		<td<?php echo $application_status->application_status_id->CellAttributes() ?>>
<div<?php echo $application_status->application_status_id->ViewAttributes() ?>><?php echo $application_status->application_status_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($application_status->application_status_1->Visible) { // application_status ?>
	<tr<?php echo $application_status->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $application_status->application_status_1->FldCaption() ?></td>
		<td<?php echo $application_status->application_status_1->CellAttributes() ?>>
<div<?php echo $application_status->application_status_1->ViewAttributes() ?>><?php echo $application_status->application_status_1->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($application_status->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$application_status_view->Page_Terminate();
?>
<?php

//
// Page class
//
class capplication_status_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'application_status';

	// Page object name
	var $PageObjName = 'application_status_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $application_status;
		if ($application_status->UseTokenInUrl) $PageUrl .= "t=" . $application_status->TableVar . "&"; // Add page token
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
		global $objForm, $application_status;
		if ($application_status->UseTokenInUrl) {
			if ($objForm)
				return ($application_status->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($application_status->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function capplication_status_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (application_status)
		$GLOBALS["application_status"] = new capplication_status();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'application_status', TRUE);

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
		global $application_status;

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
			$this->Page_Terminate("application_statuslist.php");
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
		global $Language, $application_status;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["application_status_id"] <> "") {
				$application_status->application_status_id->setQueryStringValue($_GET["application_status_id"]);
				$this->arRecKey["application_status_id"] = $application_status->application_status_id->QueryStringValue;
			} else {
				$sReturnUrl = "application_statuslist.php"; // Return to list
			}

			// Get action
			$application_status->CurrentAction = "I"; // Display form
			switch ($application_status->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "application_statuslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "application_statuslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$application_status->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $application_status;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$application_status->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$application_status->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $application_status->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$application_status->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$application_status->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$application_status->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $application_status;
		$sFilter = $application_status->KeyFilter();

		// Call Row Selecting event
		$application_status->Row_Selecting($sFilter);

		// Load SQL based on filter
		$application_status->CurrentFilter = $sFilter;
		$sSql = $application_status->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$application_status->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $application_status;
		$application_status->application_status_id->setDbValue($rs->fields('application_status_id'));
		$application_status->application_status_1->setDbValue($rs->fields('application_status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $application_status;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "application_status_id=" . urlencode($application_status->application_status_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "application_status_id=" . urlencode($application_status->application_status_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "application_status_id=" . urlencode($application_status->application_status_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "application_status_id=" . urlencode($application_status->application_status_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "application_status_id=" . urlencode($application_status->application_status_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "application_status_id=" . urlencode($application_status->application_status_id->CurrentValue);
		$this->AddUrl = $application_status->AddUrl();
		$this->EditUrl = $application_status->EditUrl();
		$this->CopyUrl = $application_status->CopyUrl();
		$this->DeleteUrl = $application_status->DeleteUrl();
		$this->ListUrl = $application_status->ListUrl();

		// Call Row_Rendering event
		$application_status->Row_Rendering();

		// Common render codes for all row types
		// application_status_id

		$application_status->application_status_id->CellCssStyle = ""; $application_status->application_status_id->CellCssClass = "";
		$application_status->application_status_id->CellAttrs = array(); $application_status->application_status_id->ViewAttrs = array(); $application_status->application_status_id->EditAttrs = array();

		// application_status
		$application_status->application_status_1->CellCssStyle = ""; $application_status->application_status_1->CellCssClass = "";
		$application_status->application_status_1->CellAttrs = array(); $application_status->application_status_1->ViewAttrs = array(); $application_status->application_status_1->EditAttrs = array();
		if ($application_status->RowType == EW_ROWTYPE_VIEW) { // View row

			// application_status_id
			$application_status->application_status_id->ViewValue = $application_status->application_status_id->CurrentValue;
			$application_status->application_status_id->CssStyle = "";
			$application_status->application_status_id->CssClass = "";
			$application_status->application_status_id->ViewCustomAttributes = "";

			// application_status
			$application_status->application_status_1->ViewValue = $application_status->application_status_1->CurrentValue;
			$application_status->application_status_1->CssStyle = "";
			$application_status->application_status_1->CssClass = "";
			$application_status->application_status_1->ViewCustomAttributes = "";

			// application_status_id
			$application_status->application_status_id->HrefValue = "";
			$application_status->application_status_id->TooltipValue = "";

			// application_status
			$application_status->application_status_1->HrefValue = "";
			$application_status->application_status_1->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($application_status->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$application_status->Row_Rendered();
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
