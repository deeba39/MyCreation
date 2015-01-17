<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "districtsinfo.php" ?>
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
$districts_view = new cdistricts_view();
$Page =& $districts_view;

// Page init
$districts_view->Page_Init();

// Page main
$districts_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($districts->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var districts_view = new ew_Page("districts_view");

// page properties
districts_view.PageID = "view"; // page ID
districts_view.FormID = "fdistrictsview"; // form ID
var EW_PAGE_ID = districts_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
districts_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
districts_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
districts_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $districts->TableCaption() ?>
<br><br>
<?php if ($districts->Export == "") { ?>
<a href="<?php echo $districts_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $districts_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $districts_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $districts_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$districts_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($districts->DistrictID->Visible) { // DistrictID ?>
	<tr<?php echo $districts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $districts->DistrictID->FldCaption() ?></td>
		<td<?php echo $districts->DistrictID->CellAttributes() ?>>
<div<?php echo $districts->DistrictID->ViewAttributes() ?>><?php echo $districts->DistrictID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($districts->District->Visible) { // District ?>
	<tr<?php echo $districts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $districts->District->FldCaption() ?></td>
		<td<?php echo $districts->District->CellAttributes() ?>>
<div<?php echo $districts->District->ViewAttributes() ?>><?php echo $districts->District->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($districts->RegionID->Visible) { // RegionID ?>
	<tr<?php echo $districts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $districts->RegionID->FldCaption() ?></td>
		<td<?php echo $districts->RegionID->CellAttributes() ?>>
<div<?php echo $districts->RegionID->ViewAttributes() ?>><?php echo $districts->RegionID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($districts->programarea_programarea_id->Visible) { // programarea_programarea_id ?>
	<tr<?php echo $districts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $districts->programarea_programarea_id->FldCaption() ?></td>
		<td<?php echo $districts->programarea_programarea_id->CellAttributes() ?>>
<div<?php echo $districts->programarea_programarea_id->ViewAttributes() ?>><?php echo $districts->programarea_programarea_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($districts->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$districts_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cdistricts_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'districts';

	// Page object name
	var $PageObjName = 'districts_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $districts;
		if ($districts->UseTokenInUrl) $PageUrl .= "t=" . $districts->TableVar . "&"; // Add page token
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
		global $objForm, $districts;
		if ($districts->UseTokenInUrl) {
			if ($objForm)
				return ($districts->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($districts->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdistricts_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (districts)
		$GLOBALS["districts"] = new cdistricts();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'districts', TRUE);

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
		global $districts;

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
			$this->Page_Terminate("districtslist.php");
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
		global $Language, $districts;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["DistrictID"] <> "") {
				$districts->DistrictID->setQueryStringValue($_GET["DistrictID"]);
				$this->arRecKey["DistrictID"] = $districts->DistrictID->QueryStringValue;
			} else {
				$sReturnUrl = "districtslist.php"; // Return to list
			}

			// Get action
			$districts->CurrentAction = "I"; // Display form
			switch ($districts->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "districtslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "districtslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$districts->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $districts;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$districts->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$districts->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $districts->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$districts->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$districts->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$districts->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $districts;
		$sFilter = $districts->KeyFilter();

		// Call Row Selecting event
		$districts->Row_Selecting($sFilter);

		// Load SQL based on filter
		$districts->CurrentFilter = $sFilter;
		$sSql = $districts->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$districts->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $districts;
		$districts->DistrictID->setDbValue($rs->fields('DistrictID'));
		$districts->District->setDbValue($rs->fields('District'));
		$districts->RegionID->setDbValue($rs->fields('RegionID'));
		$districts->programarea_programarea_id->setDbValue($rs->fields('programarea_programarea_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $districts;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "DistrictID=" . urlencode($districts->DistrictID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "DistrictID=" . urlencode($districts->DistrictID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "DistrictID=" . urlencode($districts->DistrictID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "DistrictID=" . urlencode($districts->DistrictID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "DistrictID=" . urlencode($districts->DistrictID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "DistrictID=" . urlencode($districts->DistrictID->CurrentValue);
		$this->AddUrl = $districts->AddUrl();
		$this->EditUrl = $districts->EditUrl();
		$this->CopyUrl = $districts->CopyUrl();
		$this->DeleteUrl = $districts->DeleteUrl();
		$this->ListUrl = $districts->ListUrl();

		// Call Row_Rendering event
		$districts->Row_Rendering();

		// Common render codes for all row types
		// DistrictID

		$districts->DistrictID->CellCssStyle = ""; $districts->DistrictID->CellCssClass = "";
		$districts->DistrictID->CellAttrs = array(); $districts->DistrictID->ViewAttrs = array(); $districts->DistrictID->EditAttrs = array();

		// District
		$districts->District->CellCssStyle = ""; $districts->District->CellCssClass = "";
		$districts->District->CellAttrs = array(); $districts->District->ViewAttrs = array(); $districts->District->EditAttrs = array();

		// RegionID
		$districts->RegionID->CellCssStyle = ""; $districts->RegionID->CellCssClass = "";
		$districts->RegionID->CellAttrs = array(); $districts->RegionID->ViewAttrs = array(); $districts->RegionID->EditAttrs = array();

		// programarea_programarea_id
		$districts->programarea_programarea_id->CellCssStyle = ""; $districts->programarea_programarea_id->CellCssClass = "";
		$districts->programarea_programarea_id->CellAttrs = array(); $districts->programarea_programarea_id->ViewAttrs = array(); $districts->programarea_programarea_id->EditAttrs = array();
		if ($districts->RowType == EW_ROWTYPE_VIEW) { // View row

			// DistrictID
			$districts->DistrictID->ViewValue = $districts->DistrictID->CurrentValue;
			$districts->DistrictID->CssStyle = "";
			$districts->DistrictID->CssClass = "";
			$districts->DistrictID->ViewCustomAttributes = "";

			// District
			$districts->District->ViewValue = $districts->District->CurrentValue;
			$districts->District->CssStyle = "";
			$districts->District->CssClass = "";
			$districts->District->ViewCustomAttributes = "";

			// RegionID
			if (strval($districts->RegionID->CurrentValue) <> "") {
				$sFilterWrk = "`RegionID` = " . ew_AdjustSql($districts->RegionID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Region` FROM `regions`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$districts->RegionID->ViewValue = $rswrk->fields('Region');
					$rswrk->Close();
				} else {
					$districts->RegionID->ViewValue = $districts->RegionID->CurrentValue;
				}
			} else {
				$districts->RegionID->ViewValue = NULL;
			}
			$districts->RegionID->CssStyle = "";
			$districts->RegionID->CssClass = "";
			$districts->RegionID->ViewCustomAttributes = "";

			// programarea_programarea_id
			if (strval($districts->programarea_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($districts->programarea_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$districts->programarea_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$districts->programarea_programarea_id->ViewValue = $districts->programarea_programarea_id->CurrentValue;
				}
			} else {
				$districts->programarea_programarea_id->ViewValue = NULL;
			}
			$districts->programarea_programarea_id->CssStyle = "";
			$districts->programarea_programarea_id->CssClass = "";
			$districts->programarea_programarea_id->ViewCustomAttributes = "";

			// DistrictID
			$districts->DistrictID->HrefValue = "";
			$districts->DistrictID->TooltipValue = "";

			// District
			$districts->District->HrefValue = "";
			$districts->District->TooltipValue = "";

			// RegionID
			$districts->RegionID->HrefValue = "";
			$districts->RegionID->TooltipValue = "";

			// programarea_programarea_id
			$districts->programarea_programarea_id->HrefValue = "";
			$districts->programarea_programarea_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($districts->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$districts->Row_Rendered();
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
