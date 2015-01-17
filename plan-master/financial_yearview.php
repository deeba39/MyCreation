<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "financial_yearinfo.php" ?>
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
$financial_year_view = new cfinancial_year_view();
$Page =& $financial_year_view;

// Page init
$financial_year_view->Page_Init();

// Page main
$financial_year_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($financial_year->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var financial_year_view = new ew_Page("financial_year_view");

// page properties
financial_year_view.PageID = "view"; // page ID
financial_year_view.FormID = "ffinancial_yearview"; // form ID
var EW_PAGE_ID = financial_year_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
financial_year_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
financial_year_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
financial_year_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $financial_year->TableCaption() ?>
<br><br>
<?php if ($financial_year->Export == "") { ?>
<a href="<?php echo $financial_year_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $financial_year_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $financial_year_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $financial_year_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $financial_year_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$financial_year_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($financial_year->financial_year_id->Visible) { // financial_year_id ?>
	<tr<?php echo $financial_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $financial_year->financial_year_id->FldCaption() ?></td>
		<td<?php echo $financial_year->financial_year_id->CellAttributes() ?>>
<div<?php echo $financial_year->financial_year_id->ViewAttributes() ?>><?php echo $financial_year->financial_year_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($financial_year->year_name->Visible) { // year_name ?>
	<tr<?php echo $financial_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $financial_year->year_name->FldCaption() ?></td>
		<td<?php echo $financial_year->year_name->CellAttributes() ?>>
<div<?php echo $financial_year->year_name->ViewAttributes() ?>><?php echo $financial_year->year_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($financial_year->date_start->Visible) { // date_start ?>
	<tr<?php echo $financial_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $financial_year->date_start->FldCaption() ?></td>
		<td<?php echo $financial_year->date_start->CellAttributes() ?>>
<div<?php echo $financial_year->date_start->ViewAttributes() ?>><?php echo $financial_year->date_start->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($financial_year->date_end->Visible) { // date_end ?>
	<tr<?php echo $financial_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $financial_year->date_end->FldCaption() ?></td>
		<td<?php echo $financial_year->date_end->CellAttributes() ?>>
<div<?php echo $financial_year->date_end->ViewAttributes() ?>><?php echo $financial_year->date_end->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($financial_year->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$financial_year_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cfinancial_year_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'financial_year';

	// Page object name
	var $PageObjName = 'financial_year_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $financial_year;
		if ($financial_year->UseTokenInUrl) $PageUrl .= "t=" . $financial_year->TableVar . "&"; // Add page token
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
		global $objForm, $financial_year;
		if ($financial_year->UseTokenInUrl) {
			if ($objForm)
				return ($financial_year->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($financial_year->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfinancial_year_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (financial_year)
		$GLOBALS["financial_year"] = new cfinancial_year();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'financial_year', TRUE);

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
		global $financial_year;

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
			$this->Page_Terminate("financial_yearlist.php");
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
		global $Language, $financial_year;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["financial_year_id"] <> "") {
				$financial_year->financial_year_id->setQueryStringValue($_GET["financial_year_id"]);
				$this->arRecKey["financial_year_id"] = $financial_year->financial_year_id->QueryStringValue;
			} else {
				$sReturnUrl = "financial_yearlist.php"; // Return to list
			}

			// Get action
			$financial_year->CurrentAction = "I"; // Display form
			switch ($financial_year->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "financial_yearlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "financial_yearlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$financial_year->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $financial_year;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$financial_year->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$financial_year->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $financial_year->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$financial_year->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$financial_year->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$financial_year->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $financial_year;
		$sFilter = $financial_year->KeyFilter();

		// Call Row Selecting event
		$financial_year->Row_Selecting($sFilter);

		// Load SQL based on filter
		$financial_year->CurrentFilter = $sFilter;
		$sSql = $financial_year->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$financial_year->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $financial_year;
		$financial_year->financial_year_id->setDbValue($rs->fields('financial_year_id'));
		$financial_year->year_name->setDbValue($rs->fields('year_name'));
		$financial_year->date_start->setDbValue($rs->fields('date_start'));
		$financial_year->date_end->setDbValue($rs->fields('date_end'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $financial_year;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "financial_year_id=" . urlencode($financial_year->financial_year_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "financial_year_id=" . urlencode($financial_year->financial_year_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "financial_year_id=" . urlencode($financial_year->financial_year_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "financial_year_id=" . urlencode($financial_year->financial_year_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "financial_year_id=" . urlencode($financial_year->financial_year_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "financial_year_id=" . urlencode($financial_year->financial_year_id->CurrentValue);
		$this->AddUrl = $financial_year->AddUrl();
		$this->EditUrl = $financial_year->EditUrl();
		$this->CopyUrl = $financial_year->CopyUrl();
		$this->DeleteUrl = $financial_year->DeleteUrl();
		$this->ListUrl = $financial_year->ListUrl();

		// Call Row_Rendering event
		$financial_year->Row_Rendering();

		// Common render codes for all row types
		// financial_year_id

		$financial_year->financial_year_id->CellCssStyle = ""; $financial_year->financial_year_id->CellCssClass = "";
		$financial_year->financial_year_id->CellAttrs = array(); $financial_year->financial_year_id->ViewAttrs = array(); $financial_year->financial_year_id->EditAttrs = array();

		// year_name
		$financial_year->year_name->CellCssStyle = ""; $financial_year->year_name->CellCssClass = "";
		$financial_year->year_name->CellAttrs = array(); $financial_year->year_name->ViewAttrs = array(); $financial_year->year_name->EditAttrs = array();

		// date_start
		$financial_year->date_start->CellCssStyle = ""; $financial_year->date_start->CellCssClass = "";
		$financial_year->date_start->CellAttrs = array(); $financial_year->date_start->ViewAttrs = array(); $financial_year->date_start->EditAttrs = array();

		// date_end
		$financial_year->date_end->CellCssStyle = ""; $financial_year->date_end->CellCssClass = "";
		$financial_year->date_end->CellAttrs = array(); $financial_year->date_end->ViewAttrs = array(); $financial_year->date_end->EditAttrs = array();
		if ($financial_year->RowType == EW_ROWTYPE_VIEW) { // View row

			// financial_year_id
			$financial_year->financial_year_id->ViewValue = $financial_year->financial_year_id->CurrentValue;
			$financial_year->financial_year_id->CssStyle = "";
			$financial_year->financial_year_id->CssClass = "";
			$financial_year->financial_year_id->ViewCustomAttributes = "";

			// year_name
			$financial_year->year_name->ViewValue = $financial_year->year_name->CurrentValue;
			$financial_year->year_name->CssStyle = "";
			$financial_year->year_name->CssClass = "";
			$financial_year->year_name->ViewCustomAttributes = "";

			// date_start
			$financial_year->date_start->ViewValue = $financial_year->date_start->CurrentValue;
			$financial_year->date_start->ViewValue = ew_FormatDateTime($financial_year->date_start->ViewValue, 7);
			$financial_year->date_start->CssStyle = "";
			$financial_year->date_start->CssClass = "";
			$financial_year->date_start->ViewCustomAttributes = "";

			// date_end
			$financial_year->date_end->ViewValue = $financial_year->date_end->CurrentValue;
			$financial_year->date_end->ViewValue = ew_FormatDateTime($financial_year->date_end->ViewValue, 7);
			$financial_year->date_end->CssStyle = "";
			$financial_year->date_end->CssClass = "";
			$financial_year->date_end->ViewCustomAttributes = "";

			// financial_year_id
			$financial_year->financial_year_id->HrefValue = "";
			$financial_year->financial_year_id->TooltipValue = "";

			// year_name
			$financial_year->year_name->HrefValue = "";
			$financial_year->year_name->TooltipValue = "";

			// date_start
			$financial_year->date_start->HrefValue = "";
			$financial_year->date_start->TooltipValue = "";

			// date_end
			$financial_year->date_end->HrefValue = "";
			$financial_year->date_end->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($financial_year->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$financial_year->Row_Rendered();
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
