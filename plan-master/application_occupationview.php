<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "application_occupationinfo.php" ?>
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
$application_occupation_view = new capplication_occupation_view();
$Page =& $application_occupation_view;

// Page init
$application_occupation_view->Page_Init();

// Page main
$application_occupation_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($application_occupation->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var application_occupation_view = new ew_Page("application_occupation_view");

// page properties
application_occupation_view.PageID = "view"; // page ID
application_occupation_view.FormID = "fapplication_occupationview"; // form ID
var EW_PAGE_ID = application_occupation_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
application_occupation_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
application_occupation_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
application_occupation_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $application_occupation->TableCaption() ?>
<br><br>
<?php if ($application_occupation->Export == "") { ?>
<a href="<?php echo $application_occupation_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $application_occupation_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $application_occupation_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $application_occupation_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$application_occupation_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($application_occupation->application_occupation_id->Visible) { // application_occupation_id ?>
	<tr<?php echo $application_occupation->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $application_occupation->application_occupation_id->FldCaption() ?></td>
		<td<?php echo $application_occupation->application_occupation_id->CellAttributes() ?>>
<div<?php echo $application_occupation->application_occupation_id->ViewAttributes() ?>><?php echo $application_occupation->application_occupation_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($application_occupation->name->Visible) { // name ?>
	<tr<?php echo $application_occupation->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $application_occupation->name->FldCaption() ?></td>
		<td<?php echo $application_occupation->name->CellAttributes() ?>>
<div<?php echo $application_occupation->name->ViewAttributes() ?>><?php echo $application_occupation->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($application_occupation->description->Visible) { // description ?>
	<tr<?php echo $application_occupation->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $application_occupation->description->FldCaption() ?></td>
		<td<?php echo $application_occupation->description->CellAttributes() ?>>
<div<?php echo $application_occupation->description->ViewAttributes() ?>><?php echo $application_occupation->description->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($application_occupation->app_point->Visible) { // app_point ?>
	<tr<?php echo $application_occupation->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $application_occupation->app_point->FldCaption() ?></td>
		<td<?php echo $application_occupation->app_point->CellAttributes() ?>>
<div<?php echo $application_occupation->app_point->ViewAttributes() ?>><?php echo $application_occupation->app_point->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($application_occupation->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$application_occupation_view->Page_Terminate();
?>
<?php

//
// Page class
//
class capplication_occupation_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'application_occupation';

	// Page object name
	var $PageObjName = 'application_occupation_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $application_occupation;
		if ($application_occupation->UseTokenInUrl) $PageUrl .= "t=" . $application_occupation->TableVar . "&"; // Add page token
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
		global $objForm, $application_occupation;
		if ($application_occupation->UseTokenInUrl) {
			if ($objForm)
				return ($application_occupation->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($application_occupation->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function capplication_occupation_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (application_occupation)
		$GLOBALS["application_occupation"] = new capplication_occupation();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'application_occupation', TRUE);

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
		global $application_occupation;

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
			$this->Page_Terminate("application_occupationlist.php");
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
		global $Language, $application_occupation;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["application_occupation_id"] <> "") {
				$application_occupation->application_occupation_id->setQueryStringValue($_GET["application_occupation_id"]);
				$this->arRecKey["application_occupation_id"] = $application_occupation->application_occupation_id->QueryStringValue;
			} else {
				$sReturnUrl = "application_occupationlist.php"; // Return to list
			}

			// Get action
			$application_occupation->CurrentAction = "I"; // Display form
			switch ($application_occupation->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "application_occupationlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "application_occupationlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$application_occupation->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $application_occupation;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$application_occupation->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$application_occupation->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $application_occupation->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$application_occupation->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$application_occupation->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$application_occupation->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $application_occupation;
		$sFilter = $application_occupation->KeyFilter();

		// Call Row Selecting event
		$application_occupation->Row_Selecting($sFilter);

		// Load SQL based on filter
		$application_occupation->CurrentFilter = $sFilter;
		$sSql = $application_occupation->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$application_occupation->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $application_occupation;
		$application_occupation->application_occupation_id->setDbValue($rs->fields('application_occupation_id'));
		$application_occupation->name->setDbValue($rs->fields('name'));
		$application_occupation->description->setDbValue($rs->fields('description'));
		$application_occupation->app_point->setDbValue($rs->fields('app_point'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $application_occupation;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "application_occupation_id=" . urlencode($application_occupation->application_occupation_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "application_occupation_id=" . urlencode($application_occupation->application_occupation_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "application_occupation_id=" . urlencode($application_occupation->application_occupation_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "application_occupation_id=" . urlencode($application_occupation->application_occupation_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "application_occupation_id=" . urlencode($application_occupation->application_occupation_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "application_occupation_id=" . urlencode($application_occupation->application_occupation_id->CurrentValue);
		$this->AddUrl = $application_occupation->AddUrl();
		$this->EditUrl = $application_occupation->EditUrl();
		$this->CopyUrl = $application_occupation->CopyUrl();
		$this->DeleteUrl = $application_occupation->DeleteUrl();
		$this->ListUrl = $application_occupation->ListUrl();

		// Call Row_Rendering event
		$application_occupation->Row_Rendering();

		// Common render codes for all row types
		// application_occupation_id

		$application_occupation->application_occupation_id->CellCssStyle = ""; $application_occupation->application_occupation_id->CellCssClass = "";
		$application_occupation->application_occupation_id->CellAttrs = array(); $application_occupation->application_occupation_id->ViewAttrs = array(); $application_occupation->application_occupation_id->EditAttrs = array();

		// name
		$application_occupation->name->CellCssStyle = ""; $application_occupation->name->CellCssClass = "";
		$application_occupation->name->CellAttrs = array(); $application_occupation->name->ViewAttrs = array(); $application_occupation->name->EditAttrs = array();

		// description
		$application_occupation->description->CellCssStyle = ""; $application_occupation->description->CellCssClass = "";
		$application_occupation->description->CellAttrs = array(); $application_occupation->description->ViewAttrs = array(); $application_occupation->description->EditAttrs = array();

		// app_point
		$application_occupation->app_point->CellCssStyle = ""; $application_occupation->app_point->CellCssClass = "";
		$application_occupation->app_point->CellAttrs = array(); $application_occupation->app_point->ViewAttrs = array(); $application_occupation->app_point->EditAttrs = array();
		if ($application_occupation->RowType == EW_ROWTYPE_VIEW) { // View row

			// application_occupation_id
			$application_occupation->application_occupation_id->ViewValue = $application_occupation->application_occupation_id->CurrentValue;
			$application_occupation->application_occupation_id->CssStyle = "";
			$application_occupation->application_occupation_id->CssClass = "";
			$application_occupation->application_occupation_id->ViewCustomAttributes = "";

			// name
			$application_occupation->name->ViewValue = $application_occupation->name->CurrentValue;
			$application_occupation->name->CssStyle = "";
			$application_occupation->name->CssClass = "";
			$application_occupation->name->ViewCustomAttributes = "";

			// description
			$application_occupation->description->ViewValue = $application_occupation->description->CurrentValue;
			$application_occupation->description->CssStyle = "";
			$application_occupation->description->CssClass = "";
			$application_occupation->description->ViewCustomAttributes = "";

			// app_point
			$application_occupation->app_point->ViewValue = $application_occupation->app_point->CurrentValue;
			$application_occupation->app_point->CssStyle = "";
			$application_occupation->app_point->CssClass = "";
			$application_occupation->app_point->ViewCustomAttributes = "";

			// application_occupation_id
			$application_occupation->application_occupation_id->HrefValue = "";
			$application_occupation->application_occupation_id->TooltipValue = "";

			// name
			$application_occupation->name->HrefValue = "";
			$application_occupation->name->TooltipValue = "";

			// description
			$application_occupation->description->HrefValue = "";
			$application_occupation->description->TooltipValue = "";

			// app_point
			$application_occupation->app_point->HrefValue = "";
			$application_occupation->app_point->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($application_occupation->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$application_occupation->Row_Rendered();
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
