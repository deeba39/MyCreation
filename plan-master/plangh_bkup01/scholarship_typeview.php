<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "scholarship_typeinfo.php" ?>
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
$scholarship_type_view = new cscholarship_type_view();
$Page =& $scholarship_type_view;

// Page init
$scholarship_type_view->Page_Init();

// Page main
$scholarship_type_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($scholarship_type->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var scholarship_type_view = new ew_Page("scholarship_type_view");

// page properties
scholarship_type_view.PageID = "view"; // page ID
scholarship_type_view.FormID = "fscholarship_typeview"; // form ID
var EW_PAGE_ID = scholarship_type_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
scholarship_type_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
scholarship_type_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
scholarship_type_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $scholarship_type->TableCaption() ?>
<br><br>
<?php if ($scholarship_type->Export == "") { ?>
<a href="<?php echo $scholarship_type_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $scholarship_type_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $scholarship_type_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $scholarship_type_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $scholarship_type_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$scholarship_type_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($scholarship_type->scholarship_type_id->Visible) { // scholarship_type_id ?>
	<tr<?php echo $scholarship_type->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_type->scholarship_type_id->FldCaption() ?></td>
		<td<?php echo $scholarship_type->scholarship_type_id->CellAttributes() ?>>
<div<?php echo $scholarship_type->scholarship_type_id->ViewAttributes() ?>><?php echo $scholarship_type->scholarship_type_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_type->scholarship_type_name->Visible) { // scholarship_type_name ?>
	<tr<?php echo $scholarship_type->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_type->scholarship_type_name->FldCaption() ?></td>
		<td<?php echo $scholarship_type->scholarship_type_name->CellAttributes() ?>>
<div<?php echo $scholarship_type->scholarship_type_name->ViewAttributes() ?>><?php echo $scholarship_type->scholarship_type_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_type->scholarship_type_scale->Visible) { // scholarship_type_scale ?>
	<tr<?php echo $scholarship_type->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_type->scholarship_type_scale->FldCaption() ?></td>
		<td<?php echo $scholarship_type->scholarship_type_scale->CellAttributes() ?>>
<div<?php echo $scholarship_type->scholarship_type_scale->ViewAttributes() ?>><?php echo $scholarship_type->scholarship_type_scale->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($scholarship_type->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$scholarship_type_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cscholarship_type_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'scholarship_type';

	// Page object name
	var $PageObjName = 'scholarship_type_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $scholarship_type;
		if ($scholarship_type->UseTokenInUrl) $PageUrl .= "t=" . $scholarship_type->TableVar . "&"; // Add page token
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
		global $objForm, $scholarship_type;
		if ($scholarship_type->UseTokenInUrl) {
			if ($objForm)
				return ($scholarship_type->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($scholarship_type->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cscholarship_type_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (scholarship_type)
		$GLOBALS["scholarship_type"] = new cscholarship_type();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'scholarship_type', TRUE);

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
		global $scholarship_type;

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
			$this->Page_Terminate("scholarship_typelist.php");
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
		global $Language, $scholarship_type;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["scholarship_type_id"] <> "") {
				$scholarship_type->scholarship_type_id->setQueryStringValue($_GET["scholarship_type_id"]);
				$this->arRecKey["scholarship_type_id"] = $scholarship_type->scholarship_type_id->QueryStringValue;
			} else {
				$sReturnUrl = "scholarship_typelist.php"; // Return to list
			}

			// Get action
			$scholarship_type->CurrentAction = "I"; // Display form
			switch ($scholarship_type->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "scholarship_typelist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "scholarship_typelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$scholarship_type->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $scholarship_type;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$scholarship_type->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$scholarship_type->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $scholarship_type->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$scholarship_type->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$scholarship_type->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$scholarship_type->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $scholarship_type;
		$sFilter = $scholarship_type->KeyFilter();

		// Call Row Selecting event
		$scholarship_type->Row_Selecting($sFilter);

		// Load SQL based on filter
		$scholarship_type->CurrentFilter = $sFilter;
		$sSql = $scholarship_type->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$scholarship_type->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $scholarship_type;
		$scholarship_type->scholarship_type_id->setDbValue($rs->fields('scholarship_type_id'));
		$scholarship_type->scholarship_type_name->setDbValue($rs->fields('scholarship_type_name'));
		$scholarship_type->scholarship_type_scale->setDbValue($rs->fields('scholarship_type_scale'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $scholarship_type;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "scholarship_type_id=" . urlencode($scholarship_type->scholarship_type_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "scholarship_type_id=" . urlencode($scholarship_type->scholarship_type_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "scholarship_type_id=" . urlencode($scholarship_type->scholarship_type_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "scholarship_type_id=" . urlencode($scholarship_type->scholarship_type_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "scholarship_type_id=" . urlencode($scholarship_type->scholarship_type_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "scholarship_type_id=" . urlencode($scholarship_type->scholarship_type_id->CurrentValue);
		$this->AddUrl = $scholarship_type->AddUrl();
		$this->EditUrl = $scholarship_type->EditUrl();
		$this->CopyUrl = $scholarship_type->CopyUrl();
		$this->DeleteUrl = $scholarship_type->DeleteUrl();
		$this->ListUrl = $scholarship_type->ListUrl();

		// Call Row_Rendering event
		$scholarship_type->Row_Rendering();

		// Common render codes for all row types
		// scholarship_type_id

		$scholarship_type->scholarship_type_id->CellCssStyle = ""; $scholarship_type->scholarship_type_id->CellCssClass = "";
		$scholarship_type->scholarship_type_id->CellAttrs = array(); $scholarship_type->scholarship_type_id->ViewAttrs = array(); $scholarship_type->scholarship_type_id->EditAttrs = array();

		// scholarship_type_name
		$scholarship_type->scholarship_type_name->CellCssStyle = ""; $scholarship_type->scholarship_type_name->CellCssClass = "";
		$scholarship_type->scholarship_type_name->CellAttrs = array(); $scholarship_type->scholarship_type_name->ViewAttrs = array(); $scholarship_type->scholarship_type_name->EditAttrs = array();

		// scholarship_type_scale
		$scholarship_type->scholarship_type_scale->CellCssStyle = ""; $scholarship_type->scholarship_type_scale->CellCssClass = "";
		$scholarship_type->scholarship_type_scale->CellAttrs = array(); $scholarship_type->scholarship_type_scale->ViewAttrs = array(); $scholarship_type->scholarship_type_scale->EditAttrs = array();
		if ($scholarship_type->RowType == EW_ROWTYPE_VIEW) { // View row

			// scholarship_type_id
			$scholarship_type->scholarship_type_id->ViewValue = $scholarship_type->scholarship_type_id->CurrentValue;
			$scholarship_type->scholarship_type_id->CssStyle = "";
			$scholarship_type->scholarship_type_id->CssClass = "";
			$scholarship_type->scholarship_type_id->ViewCustomAttributes = "";

			// scholarship_type_name
			$scholarship_type->scholarship_type_name->ViewValue = $scholarship_type->scholarship_type_name->CurrentValue;
			$scholarship_type->scholarship_type_name->CssStyle = "";
			$scholarship_type->scholarship_type_name->CssClass = "";
			$scholarship_type->scholarship_type_name->ViewCustomAttributes = "";

			// scholarship_type_scale
			$scholarship_type->scholarship_type_scale->ViewValue = $scholarship_type->scholarship_type_scale->CurrentValue;
			$scholarship_type->scholarship_type_scale->CssStyle = "";
			$scholarship_type->scholarship_type_scale->CssClass = "";
			$scholarship_type->scholarship_type_scale->ViewCustomAttributes = "";

			// scholarship_type_id
			$scholarship_type->scholarship_type_id->HrefValue = "";
			$scholarship_type->scholarship_type_id->TooltipValue = "";

			// scholarship_type_name
			$scholarship_type->scholarship_type_name->HrefValue = "";
			$scholarship_type->scholarship_type_name->TooltipValue = "";

			// scholarship_type_scale
			$scholarship_type->scholarship_type_scale->HrefValue = "";
			$scholarship_type->scholarship_type_scale->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($scholarship_type->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$scholarship_type->Row_Rendered();
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
