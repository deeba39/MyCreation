<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "school_typeinfo.php" ?>
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
$school_type_view = new cschool_type_view();
$Page =& $school_type_view;

// Page init
$school_type_view->Page_Init();

// Page main
$school_type_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($school_type->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var school_type_view = new ew_Page("school_type_view");

// page properties
school_type_view.PageID = "view"; // page ID
school_type_view.FormID = "fschool_typeview"; // form ID
var EW_PAGE_ID = school_type_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
school_type_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
school_type_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
school_type_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $school_type->TableCaption() ?>
<br><br>
<?php if ($school_type->Export == "") { ?>
<a href="<?php echo $school_type_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $school_type_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $school_type_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $school_type_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$school_type_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($school_type->school_type_id->Visible) { // school_type_id ?>
	<tr<?php echo $school_type->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_type->school_type_id->FldCaption() ?></td>
		<td<?php echo $school_type->school_type_id->CellAttributes() ?>>
<div<?php echo $school_type->school_type_id->ViewAttributes() ?>><?php echo $school_type->school_type_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($school_type->school_type_1->Visible) { // school_type ?>
	<tr<?php echo $school_type->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_type->school_type_1->FldCaption() ?></td>
		<td<?php echo $school_type->school_type_1->CellAttributes() ?>>
<div<?php echo $school_type->school_type_1->ViewAttributes() ?>><?php echo $school_type->school_type_1->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($school_type->description->Visible) { // description ?>
	<tr<?php echo $school_type->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_type->description->FldCaption() ?></td>
		<td<?php echo $school_type->description->CellAttributes() ?>>
<div<?php echo $school_type->description->ViewAttributes() ?>><?php echo $school_type->description->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($school_type->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$school_type_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cschool_type_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'school_type';

	// Page object name
	var $PageObjName = 'school_type_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $school_type;
		if ($school_type->UseTokenInUrl) $PageUrl .= "t=" . $school_type->TableVar . "&"; // Add page token
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
		global $objForm, $school_type;
		if ($school_type->UseTokenInUrl) {
			if ($objForm)
				return ($school_type->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($school_type->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cschool_type_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (school_type)
		$GLOBALS["school_type"] = new cschool_type();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'school_type', TRUE);

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
		global $school_type;

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
			$this->Page_Terminate("school_typelist.php");
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
		global $Language, $school_type;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["school_type_id"] <> "") {
				$school_type->school_type_id->setQueryStringValue($_GET["school_type_id"]);
				$this->arRecKey["school_type_id"] = $school_type->school_type_id->QueryStringValue;
			} else {
				$sReturnUrl = "school_typelist.php"; // Return to list
			}

			// Get action
			$school_type->CurrentAction = "I"; // Display form
			switch ($school_type->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "school_typelist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "school_typelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$school_type->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $school_type;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$school_type->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$school_type->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $school_type->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$school_type->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$school_type->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$school_type->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $school_type;
		$sFilter = $school_type->KeyFilter();

		// Call Row Selecting event
		$school_type->Row_Selecting($sFilter);

		// Load SQL based on filter
		$school_type->CurrentFilter = $sFilter;
		$sSql = $school_type->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$school_type->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $school_type;
		$school_type->school_type_id->setDbValue($rs->fields('school_type_id'));
		$school_type->school_type_1->setDbValue($rs->fields('school_type'));
		$school_type->description->setDbValue($rs->fields('description'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $school_type;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "school_type_id=" . urlencode($school_type->school_type_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "school_type_id=" . urlencode($school_type->school_type_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "school_type_id=" . urlencode($school_type->school_type_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "school_type_id=" . urlencode($school_type->school_type_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "school_type_id=" . urlencode($school_type->school_type_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "school_type_id=" . urlencode($school_type->school_type_id->CurrentValue);
		$this->AddUrl = $school_type->AddUrl();
		$this->EditUrl = $school_type->EditUrl();
		$this->CopyUrl = $school_type->CopyUrl();
		$this->DeleteUrl = $school_type->DeleteUrl();
		$this->ListUrl = $school_type->ListUrl();

		// Call Row_Rendering event
		$school_type->Row_Rendering();

		// Common render codes for all row types
		// school_type_id

		$school_type->school_type_id->CellCssStyle = ""; $school_type->school_type_id->CellCssClass = "";
		$school_type->school_type_id->CellAttrs = array(); $school_type->school_type_id->ViewAttrs = array(); $school_type->school_type_id->EditAttrs = array();

		// school_type
		$school_type->school_type_1->CellCssStyle = ""; $school_type->school_type_1->CellCssClass = "";
		$school_type->school_type_1->CellAttrs = array(); $school_type->school_type_1->ViewAttrs = array(); $school_type->school_type_1->EditAttrs = array();

		// description
		$school_type->description->CellCssStyle = ""; $school_type->description->CellCssClass = "";
		$school_type->description->CellAttrs = array(); $school_type->description->ViewAttrs = array(); $school_type->description->EditAttrs = array();
		if ($school_type->RowType == EW_ROWTYPE_VIEW) { // View row

			// school_type_id
			$school_type->school_type_id->ViewValue = $school_type->school_type_id->CurrentValue;
			$school_type->school_type_id->CssStyle = "";
			$school_type->school_type_id->CssClass = "";
			$school_type->school_type_id->ViewCustomAttributes = "";

			// school_type
			$school_type->school_type_1->ViewValue = $school_type->school_type_1->CurrentValue;
			$school_type->school_type_1->CssStyle = "";
			$school_type->school_type_1->CssClass = "";
			$school_type->school_type_1->ViewCustomAttributes = "";

			// description
			$school_type->description->ViewValue = $school_type->description->CurrentValue;
			$school_type->description->CssStyle = "";
			$school_type->description->CssClass = "";
			$school_type->description->ViewCustomAttributes = "";

			// school_type_id
			$school_type->school_type_id->HrefValue = "";
			$school_type->school_type_id->TooltipValue = "";

			// school_type
			$school_type->school_type_1->HrefValue = "";
			$school_type->school_type_1->TooltipValue = "";

			// description
			$school_type->description->HrefValue = "";
			$school_type->description->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($school_type->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$school_type->Row_Rendered();
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
