<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "selection_grade_pointinfo.php" ?>
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
$selection_grade_point_view = new cselection_grade_point_view();
$Page =& $selection_grade_point_view;

// Page init
$selection_grade_point_view->Page_Init();

// Page main
$selection_grade_point_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($selection_grade_point->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var selection_grade_point_view = new ew_Page("selection_grade_point_view");

// page properties
selection_grade_point_view.PageID = "view"; // page ID
selection_grade_point_view.FormID = "fselection_grade_pointview"; // form ID
var EW_PAGE_ID = selection_grade_point_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
selection_grade_point_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
selection_grade_point_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
selection_grade_point_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $selection_grade_point->TableCaption() ?>
<br><br>
<?php if ($selection_grade_point->Export == "") { ?>
<a href="<?php echo $selection_grade_point_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $selection_grade_point_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $selection_grade_point_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $selection_grade_point_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $selection_grade_point_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$selection_grade_point_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($selection_grade_point->selection_grade_points_id->Visible) { // selection_grade_points_id ?>
	<tr<?php echo $selection_grade_point->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $selection_grade_point->selection_grade_points_id->FldCaption() ?></td>
		<td<?php echo $selection_grade_point->selection_grade_points_id->CellAttributes() ?>>
<div<?php echo $selection_grade_point->selection_grade_points_id->ViewAttributes() ?>><?php echo $selection_grade_point->selection_grade_points_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($selection_grade_point->grade_point->Visible) { // grade_point ?>
	<tr<?php echo $selection_grade_point->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $selection_grade_point->grade_point->FldCaption() ?></td>
		<td<?php echo $selection_grade_point->grade_point->CellAttributes() ?>>
<div<?php echo $selection_grade_point->grade_point->ViewAttributes() ?>><?php echo $selection_grade_point->grade_point->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($selection_grade_point->min_grade->Visible) { // min_grade ?>
	<tr<?php echo $selection_grade_point->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $selection_grade_point->min_grade->FldCaption() ?></td>
		<td<?php echo $selection_grade_point->min_grade->CellAttributes() ?>>
<div<?php echo $selection_grade_point->min_grade->ViewAttributes() ?>><?php echo $selection_grade_point->min_grade->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($selection_grade_point->max_grade->Visible) { // max_grade ?>
	<tr<?php echo $selection_grade_point->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $selection_grade_point->max_grade->FldCaption() ?></td>
		<td<?php echo $selection_grade_point->max_grade->CellAttributes() ?>>
<div<?php echo $selection_grade_point->max_grade->ViewAttributes() ?>><?php echo $selection_grade_point->max_grade->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($selection_grade_point->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$selection_grade_point_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cselection_grade_point_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'selection_grade_point';

	// Page object name
	var $PageObjName = 'selection_grade_point_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $selection_grade_point;
		if ($selection_grade_point->UseTokenInUrl) $PageUrl .= "t=" . $selection_grade_point->TableVar . "&"; // Add page token
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
		global $objForm, $selection_grade_point;
		if ($selection_grade_point->UseTokenInUrl) {
			if ($objForm)
				return ($selection_grade_point->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($selection_grade_point->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cselection_grade_point_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (selection_grade_point)
		$GLOBALS["selection_grade_point"] = new cselection_grade_point();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'selection_grade_point', TRUE);

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
		global $selection_grade_point;

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
			$this->Page_Terminate("selection_grade_pointlist.php");
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
		global $Language, $selection_grade_point;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["selection_grade_points_id"] <> "") {
				$selection_grade_point->selection_grade_points_id->setQueryStringValue($_GET["selection_grade_points_id"]);
				$this->arRecKey["selection_grade_points_id"] = $selection_grade_point->selection_grade_points_id->QueryStringValue;
			} else {
				$sReturnUrl = "selection_grade_pointlist.php"; // Return to list
			}

			// Get action
			$selection_grade_point->CurrentAction = "I"; // Display form
			switch ($selection_grade_point->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "selection_grade_pointlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "selection_grade_pointlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$selection_grade_point->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $selection_grade_point;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$selection_grade_point->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$selection_grade_point->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $selection_grade_point->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$selection_grade_point->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$selection_grade_point->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$selection_grade_point->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $selection_grade_point;
		$sFilter = $selection_grade_point->KeyFilter();

		// Call Row Selecting event
		$selection_grade_point->Row_Selecting($sFilter);

		// Load SQL based on filter
		$selection_grade_point->CurrentFilter = $sFilter;
		$sSql = $selection_grade_point->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$selection_grade_point->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $selection_grade_point;
		$selection_grade_point->selection_grade_points_id->setDbValue($rs->fields('selection_grade_points_id'));
		$selection_grade_point->grade_point->setDbValue($rs->fields('grade_point'));
		$selection_grade_point->min_grade->setDbValue($rs->fields('min_grade'));
		$selection_grade_point->max_grade->setDbValue($rs->fields('max_grade'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $selection_grade_point;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "selection_grade_points_id=" . urlencode($selection_grade_point->selection_grade_points_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "selection_grade_points_id=" . urlencode($selection_grade_point->selection_grade_points_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "selection_grade_points_id=" . urlencode($selection_grade_point->selection_grade_points_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "selection_grade_points_id=" . urlencode($selection_grade_point->selection_grade_points_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "selection_grade_points_id=" . urlencode($selection_grade_point->selection_grade_points_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "selection_grade_points_id=" . urlencode($selection_grade_point->selection_grade_points_id->CurrentValue);
		$this->AddUrl = $selection_grade_point->AddUrl();
		$this->EditUrl = $selection_grade_point->EditUrl();
		$this->CopyUrl = $selection_grade_point->CopyUrl();
		$this->DeleteUrl = $selection_grade_point->DeleteUrl();
		$this->ListUrl = $selection_grade_point->ListUrl();

		// Call Row_Rendering event
		$selection_grade_point->Row_Rendering();

		// Common render codes for all row types
		// selection_grade_points_id

		$selection_grade_point->selection_grade_points_id->CellCssStyle = ""; $selection_grade_point->selection_grade_points_id->CellCssClass = "";
		$selection_grade_point->selection_grade_points_id->CellAttrs = array(); $selection_grade_point->selection_grade_points_id->ViewAttrs = array(); $selection_grade_point->selection_grade_points_id->EditAttrs = array();

		// grade_point
		$selection_grade_point->grade_point->CellCssStyle = ""; $selection_grade_point->grade_point->CellCssClass = "";
		$selection_grade_point->grade_point->CellAttrs = array(); $selection_grade_point->grade_point->ViewAttrs = array(); $selection_grade_point->grade_point->EditAttrs = array();

		// min_grade
		$selection_grade_point->min_grade->CellCssStyle = ""; $selection_grade_point->min_grade->CellCssClass = "";
		$selection_grade_point->min_grade->CellAttrs = array(); $selection_grade_point->min_grade->ViewAttrs = array(); $selection_grade_point->min_grade->EditAttrs = array();

		// max_grade
		$selection_grade_point->max_grade->CellCssStyle = ""; $selection_grade_point->max_grade->CellCssClass = "";
		$selection_grade_point->max_grade->CellAttrs = array(); $selection_grade_point->max_grade->ViewAttrs = array(); $selection_grade_point->max_grade->EditAttrs = array();
		if ($selection_grade_point->RowType == EW_ROWTYPE_VIEW) { // View row

			// selection_grade_points_id
			$selection_grade_point->selection_grade_points_id->ViewValue = $selection_grade_point->selection_grade_points_id->CurrentValue;
			$selection_grade_point->selection_grade_points_id->CssStyle = "";
			$selection_grade_point->selection_grade_points_id->CssClass = "";
			$selection_grade_point->selection_grade_points_id->ViewCustomAttributes = "";

			// grade_point
			$selection_grade_point->grade_point->ViewValue = $selection_grade_point->grade_point->CurrentValue;
			$selection_grade_point->grade_point->CssStyle = "";
			$selection_grade_point->grade_point->CssClass = "";
			$selection_grade_point->grade_point->ViewCustomAttributes = "";

			// min_grade
			$selection_grade_point->min_grade->ViewValue = $selection_grade_point->min_grade->CurrentValue;
			$selection_grade_point->min_grade->CssStyle = "";
			$selection_grade_point->min_grade->CssClass = "";
			$selection_grade_point->min_grade->ViewCustomAttributes = "";

			// max_grade
			$selection_grade_point->max_grade->ViewValue = $selection_grade_point->max_grade->CurrentValue;
			$selection_grade_point->max_grade->CssStyle = "";
			$selection_grade_point->max_grade->CssClass = "";
			$selection_grade_point->max_grade->ViewCustomAttributes = "";

			// selection_grade_points_id
			$selection_grade_point->selection_grade_points_id->HrefValue = "";
			$selection_grade_point->selection_grade_points_id->TooltipValue = "";

			// grade_point
			$selection_grade_point->grade_point->HrefValue = "";
			$selection_grade_point->grade_point->TooltipValue = "";

			// min_grade
			$selection_grade_point->min_grade->HrefValue = "";
			$selection_grade_point->min_grade->TooltipValue = "";

			// max_grade
			$selection_grade_point->max_grade->HrefValue = "";
			$selection_grade_point->max_grade->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($selection_grade_point->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$selection_grade_point->Row_Rendered();
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
