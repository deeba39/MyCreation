<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "academic_yearinfo.php" ?>
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
$academic_year_view = new cacademic_year_view();
$Page =& $academic_year_view;

// Page init
$academic_year_view->Page_Init();

// Page main
$academic_year_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($academic_year->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var academic_year_view = new ew_Page("academic_year_view");

// page properties
academic_year_view.PageID = "view"; // page ID
academic_year_view.FormID = "facademic_yearview"; // form ID
var EW_PAGE_ID = academic_year_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
academic_year_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
academic_year_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
academic_year_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $academic_year->TableCaption() ?>
<br><br>
<?php if ($academic_year->Export == "") { ?>
<a href="<?php echo $academic_year_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $academic_year_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $academic_year_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $academic_year_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $academic_year_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$academic_year_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($academic_year->app_year->Visible) { // app_year ?>
	<tr<?php echo $academic_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $academic_year->app_year->FldCaption() ?></td>
		<td<?php echo $academic_year->app_year->CellAttributes() ?>>
<div<?php echo $academic_year->app_year->ViewAttributes() ?>><?php echo $academic_year->app_year->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($academic_year->active->Visible) { // active ?>
	<tr<?php echo $academic_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $academic_year->active->FldCaption() ?></td>
		<td<?php echo $academic_year->active->CellAttributes() ?>>
<div<?php echo $academic_year->active->ViewAttributes() ?>><?php echo $academic_year->active->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($academic_year->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$academic_year_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cacademic_year_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'academic_year';

	// Page object name
	var $PageObjName = 'academic_year_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $academic_year;
		if ($academic_year->UseTokenInUrl) $PageUrl .= "t=" . $academic_year->TableVar . "&"; // Add page token
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
		global $objForm, $academic_year;
		if ($academic_year->UseTokenInUrl) {
			if ($objForm)
				return ($academic_year->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($academic_year->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cacademic_year_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (academic_year)
		$GLOBALS["academic_year"] = new cacademic_year();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'academic_year', TRUE);

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
		global $academic_year;

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
			$this->Page_Terminate("academic_yearlist.php");
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
		global $Language, $academic_year;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["app_year"] <> "") {
				$academic_year->app_year->setQueryStringValue($_GET["app_year"]);
				$this->arRecKey["app_year"] = $academic_year->app_year->QueryStringValue;
			} else {
				$sReturnUrl = "academic_yearlist.php"; // Return to list
			}

			// Get action
			$academic_year->CurrentAction = "I"; // Display form
			switch ($academic_year->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "academic_yearlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "academic_yearlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$academic_year->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $academic_year;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$academic_year->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$academic_year->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $academic_year->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$academic_year->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$academic_year->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$academic_year->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $academic_year;
		$sFilter = $academic_year->KeyFilter();

		// Call Row Selecting event
		$academic_year->Row_Selecting($sFilter);

		// Load SQL based on filter
		$academic_year->CurrentFilter = $sFilter;
		$sSql = $academic_year->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$academic_year->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $academic_year;
		$academic_year->app_year->setDbValue($rs->fields('app_year'));
		$academic_year->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $academic_year;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "app_year=" . urlencode($academic_year->app_year->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "app_year=" . urlencode($academic_year->app_year->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "app_year=" . urlencode($academic_year->app_year->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "app_year=" . urlencode($academic_year->app_year->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "app_year=" . urlencode($academic_year->app_year->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "app_year=" . urlencode($academic_year->app_year->CurrentValue);
		$this->AddUrl = $academic_year->AddUrl();
		$this->EditUrl = $academic_year->EditUrl();
		$this->CopyUrl = $academic_year->CopyUrl();
		$this->DeleteUrl = $academic_year->DeleteUrl();
		$this->ListUrl = $academic_year->ListUrl();

		// Call Row_Rendering event
		$academic_year->Row_Rendering();

		// Common render codes for all row types
		// app_year

		$academic_year->app_year->CellCssStyle = ""; $academic_year->app_year->CellCssClass = "";
		$academic_year->app_year->CellAttrs = array(); $academic_year->app_year->ViewAttrs = array(); $academic_year->app_year->EditAttrs = array();

		// active
		$academic_year->active->CellCssStyle = ""; $academic_year->active->CellCssClass = "";
		$academic_year->active->CellAttrs = array(); $academic_year->active->ViewAttrs = array(); $academic_year->active->EditAttrs = array();
		if ($academic_year->RowType == EW_ROWTYPE_VIEW) { // View row

			// app_year
			$academic_year->app_year->ViewValue = $academic_year->app_year->CurrentValue;
			$academic_year->app_year->CssStyle = "";
			$academic_year->app_year->CssClass = "";
			$academic_year->app_year->ViewCustomAttributes = "";

			// active
			if (strval($academic_year->active->CurrentValue) <> "") {
				switch ($academic_year->active->CurrentValue) {
					case "ADMISSION":
						$academic_year->active->ViewValue = "ADMISSION";
						break;
					case "GRADE_RECORDING":
						$academic_year->active->ViewValue = "GRADE_RECORDING";
						break;
					case "INACTIVE":
						$academic_year->active->ViewValue = "INACTIVE";
						break;
					default:
						$academic_year->active->ViewValue = $academic_year->active->CurrentValue;
				}
			} else {
				$academic_year->active->ViewValue = NULL;
			}
			$academic_year->active->CssStyle = "";
			$academic_year->active->CssClass = "";
			$academic_year->active->ViewCustomAttributes = "";

			// app_year
			$academic_year->app_year->HrefValue = "";
			$academic_year->app_year->TooltipValue = "";

			// active
			$academic_year->active->HrefValue = "";
			$academic_year->active->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($academic_year->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$academic_year->Row_Rendered();
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
