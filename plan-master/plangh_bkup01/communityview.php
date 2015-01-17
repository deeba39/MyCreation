<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "communityinfo.php" ?>
<?php include "programareainfo.php" ?>
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
$community_view = new ccommunity_view();
$Page =& $community_view;

// Page init
$community_view->Page_Init();

// Page main
$community_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($community->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var community_view = new ew_Page("community_view");

// page properties
community_view.PageID = "view"; // page ID
community_view.FormID = "fcommunityview"; // form ID
var EW_PAGE_ID = community_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
community_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
community_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
community_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $community->TableCaption() ?>
<br><br>
<?php if ($community->Export == "") { ?>
<a href="<?php echo $community_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $community_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $community_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $community_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('schools')) { ?>
<a href="schoolslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=community&community_id=<?php echo urlencode(strval($community->community_id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("schools", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$community_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($community->community_id->Visible) { // community_id ?>
	<tr<?php echo $community->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $community->community_id->FldCaption() ?></td>
		<td<?php echo $community->community_id->CellAttributes() ?>>
<div<?php echo $community->community_id->ViewAttributes() ?>><?php echo $community->community_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($community->community_1->Visible) { // community ?>
	<tr<?php echo $community->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $community->community_1->FldCaption() ?></td>
		<td<?php echo $community->community_1->CellAttributes() ?>>
<div<?php echo $community->community_1->ViewAttributes() ?>><?php echo $community->community_1->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($community->programarea_programarea_id->Visible) { // programarea_programarea_id ?>
	<tr<?php echo $community->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $community->programarea_programarea_id->FldCaption() ?></td>
		<td<?php echo $community->programarea_programarea_id->CellAttributes() ?>>
<div<?php echo $community->programarea_programarea_id->ViewAttributes() ?>><?php echo $community->programarea_programarea_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($community->community_category_community_category_id->Visible) { // community_category_community_category_id ?>
	<tr<?php echo $community->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $community->community_category_community_category_id->FldCaption() ?></td>
		<td<?php echo $community->community_category_community_category_id->CellAttributes() ?>>
<div<?php echo $community->community_category_community_category_id->ViewAttributes() ?>><?php echo $community->community_category_community_category_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($community->community_districts_DistrictID->Visible) { // community_districts_DistrictID ?>
	<tr<?php echo $community->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $community->community_districts_DistrictID->FldCaption() ?></td>
		<td<?php echo $community->community_districts_DistrictID->CellAttributes() ?>>
<div<?php echo $community->community_districts_DistrictID->ViewAttributes() ?>><?php echo $community->community_districts_DistrictID->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($community->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$community_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ccommunity_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'community';

	// Page object name
	var $PageObjName = 'community_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $community;
		if ($community->UseTokenInUrl) $PageUrl .= "t=" . $community->TableVar . "&"; // Add page token
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
		global $objForm, $community;
		if ($community->UseTokenInUrl) {
			if ($objForm)
				return ($community->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($community->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccommunity_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (community)
		$GLOBALS["community"] = new ccommunity();

		// Table object (programarea)
		$GLOBALS['programarea'] = new cprogramarea();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'community', TRUE);

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
		global $community;

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
			$this->Page_Terminate("communitylist.php");
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
		global $Language, $community;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["community_id"] <> "") {
				$community->community_id->setQueryStringValue($_GET["community_id"]);
				$this->arRecKey["community_id"] = $community->community_id->QueryStringValue;
			} else {
				$sReturnUrl = "communitylist.php"; // Return to list
			}

			// Get action
			$community->CurrentAction = "I"; // Display form
			switch ($community->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "communitylist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "communitylist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$community->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $community;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$community->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$community->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $community->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$community->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$community->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$community->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $community;
		$sFilter = $community->KeyFilter();

		// Call Row Selecting event
		$community->Row_Selecting($sFilter);

		// Load SQL based on filter
		$community->CurrentFilter = $sFilter;
		$sSql = $community->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$community->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $community;
		$community->community_id->setDbValue($rs->fields('community_id'));
		$community->community_1->setDbValue($rs->fields('community'));
		$community->programarea_programarea_id->setDbValue($rs->fields('programarea_programarea_id'));
		$community->community_category_community_category_id->setDbValue($rs->fields('community_category_community_category_id'));
		$community->community_districts_DistrictID->setDbValue($rs->fields('community_districts_DistrictID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $community;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "community_id=" . urlencode($community->community_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "community_id=" . urlencode($community->community_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "community_id=" . urlencode($community->community_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "community_id=" . urlencode($community->community_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "community_id=" . urlencode($community->community_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "community_id=" . urlencode($community->community_id->CurrentValue);
		$this->AddUrl = $community->AddUrl();
		$this->EditUrl = $community->EditUrl();
		$this->CopyUrl = $community->CopyUrl();
		$this->DeleteUrl = $community->DeleteUrl();
		$this->ListUrl = $community->ListUrl();

		// Call Row_Rendering event
		$community->Row_Rendering();

		// Common render codes for all row types
		// community_id

		$community->community_id->CellCssStyle = ""; $community->community_id->CellCssClass = "";
		$community->community_id->CellAttrs = array(); $community->community_id->ViewAttrs = array(); $community->community_id->EditAttrs = array();

		// community
		$community->community_1->CellCssStyle = ""; $community->community_1->CellCssClass = "";
		$community->community_1->CellAttrs = array(); $community->community_1->ViewAttrs = array(); $community->community_1->EditAttrs = array();

		// programarea_programarea_id
		$community->programarea_programarea_id->CellCssStyle = ""; $community->programarea_programarea_id->CellCssClass = "";
		$community->programarea_programarea_id->CellAttrs = array(); $community->programarea_programarea_id->ViewAttrs = array(); $community->programarea_programarea_id->EditAttrs = array();

		// community_category_community_category_id
		$community->community_category_community_category_id->CellCssStyle = ""; $community->community_category_community_category_id->CellCssClass = "";
		$community->community_category_community_category_id->CellAttrs = array(); $community->community_category_community_category_id->ViewAttrs = array(); $community->community_category_community_category_id->EditAttrs = array();

		// community_districts_DistrictID
		$community->community_districts_DistrictID->CellCssStyle = ""; $community->community_districts_DistrictID->CellCssClass = "";
		$community->community_districts_DistrictID->CellAttrs = array(); $community->community_districts_DistrictID->ViewAttrs = array(); $community->community_districts_DistrictID->EditAttrs = array();
		if ($community->RowType == EW_ROWTYPE_VIEW) { // View row

			// community_id
			$community->community_id->ViewValue = $community->community_id->CurrentValue;
			$community->community_id->CssStyle = "";
			$community->community_id->CssClass = "";
			$community->community_id->ViewCustomAttributes = "";

			// community
			$community->community_1->ViewValue = $community->community_1->CurrentValue;
			$community->community_1->CssStyle = "";
			$community->community_1->CssClass = "";
			$community->community_1->ViewCustomAttributes = "";

			// programarea_programarea_id
			if (strval($community->programarea_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($community->programarea_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->programarea_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$community->programarea_programarea_id->ViewValue = $community->programarea_programarea_id->CurrentValue;
				}
			} else {
				$community->programarea_programarea_id->ViewValue = NULL;
			}
			$community->programarea_programarea_id->CssStyle = "";
			$community->programarea_programarea_id->CssClass = "";
			$community->programarea_programarea_id->ViewCustomAttributes = "";

			// community_category_community_category_id
			if (strval($community->community_category_community_category_id->CurrentValue) <> "") {
				$sFilterWrk = "`community_category_id` = " . ew_AdjustSql($community->community_category_community_category_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `community_category_name` FROM `community_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->community_category_community_category_id->ViewValue = $rswrk->fields('community_category_name');
					$rswrk->Close();
				} else {
					$community->community_category_community_category_id->ViewValue = $community->community_category_community_category_id->CurrentValue;
				}
			} else {
				$community->community_category_community_category_id->ViewValue = NULL;
			}
			$community->community_category_community_category_id->CssStyle = "";
			$community->community_category_community_category_id->CssClass = "";
			$community->community_category_community_category_id->ViewCustomAttributes = "";

			// community_districts_DistrictID
			if (strval($community->community_districts_DistrictID->CurrentValue) <> "") {
				$sFilterWrk = "`DistrictID` = " . ew_AdjustSql($community->community_districts_DistrictID->CurrentValue) . "";
			$sSqlWrk = "SELECT `District` FROM `districts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->community_districts_DistrictID->ViewValue = $rswrk->fields('District');
					$rswrk->Close();
				} else {
					$community->community_districts_DistrictID->ViewValue = $community->community_districts_DistrictID->CurrentValue;
				}
			} else {
				$community->community_districts_DistrictID->ViewValue = NULL;
			}
			$community->community_districts_DistrictID->CssStyle = "";
			$community->community_districts_DistrictID->CssClass = "";
			$community->community_districts_DistrictID->ViewCustomAttributes = "";

			// community_id
			$community->community_id->HrefValue = "";
			$community->community_id->TooltipValue = "";

			// community
			$community->community_1->HrefValue = "";
			$community->community_1->TooltipValue = "";

			// programarea_programarea_id
			$community->programarea_programarea_id->HrefValue = "";
			$community->programarea_programarea_id->TooltipValue = "";

			// community_category_community_category_id
			$community->community_category_community_category_id->HrefValue = "";
			$community->community_category_community_category_id->TooltipValue = "";

			// community_districts_DistrictID
			$community->community_districts_DistrictID->HrefValue = "";
			$community->community_districts_DistrictID->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($community->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$community->Row_Rendered();
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
