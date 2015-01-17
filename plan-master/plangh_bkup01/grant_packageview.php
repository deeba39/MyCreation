<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "grant_packageinfo.php" ?>
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
$grant_package_view = new cgrant_package_view();
$Page =& $grant_package_view;

// Page init
$grant_package_view->Page_Init();

// Page main
$grant_package_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($grant_package->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var grant_package_view = new ew_Page("grant_package_view");

// page properties
grant_package_view.PageID = "view"; // page ID
grant_package_view.FormID = "fgrant_packageview"; // form ID
var EW_PAGE_ID = grant_package_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
grant_package_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grant_package_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grant_package_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grant_package->TableCaption() ?>
<br><br>
<?php if ($grant_package->Export == "") { ?>
<a href="<?php echo $grant_package_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $grant_package_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $grant_package_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $grant_package_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('view_sponsored_student_grant_package')) { ?>
<a href="view_sponsored_student_grant_packagelist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=grant_package&grant_package_id=<?php echo urlencode(strval($grant_package->grant_package_id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("view_sponsored_student_grant_package", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$grant_package_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($grant_package->grant_package_id->Visible) { // grant_package_id ?>
	<tr<?php echo $grant_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grant_package->grant_package_id->FldCaption() ?></td>
		<td<?php echo $grant_package->grant_package_id->CellAttributes() ?>>
<div<?php echo $grant_package->grant_package_id->ViewAttributes() ?>><?php echo $grant_package->grant_package_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grant_package->name->Visible) { // name ?>
	<tr<?php echo $grant_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grant_package->name->FldCaption() ?></td>
		<td<?php echo $grant_package->name->CellAttributes() ?>>
<div<?php echo $grant_package->name->ViewAttributes() ?>><?php echo $grant_package->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grant_package->code->Visible) { // code ?>
	<tr<?php echo $grant_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grant_package->code->FldCaption() ?></td>
		<td<?php echo $grant_package->code->CellAttributes() ?>>
<div<?php echo $grant_package->code->ViewAttributes() ?>><?php echo $grant_package->code->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grant_package->annual_amount->Visible) { // annual_amount ?>
	<tr<?php echo $grant_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grant_package->annual_amount->FldCaption() ?></td>
		<td<?php echo $grant_package->annual_amount->CellAttributes() ?>>
<div<?php echo $grant_package->annual_amount->ViewAttributes() ?>><?php echo $grant_package->annual_amount->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($grant_package->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$grant_package_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrant_package_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'grant_package';

	// Page object name
	var $PageObjName = 'grant_package_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grant_package;
		if ($grant_package->UseTokenInUrl) $PageUrl .= "t=" . $grant_package->TableVar . "&"; // Add page token
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
		global $objForm, $grant_package;
		if ($grant_package->UseTokenInUrl) {
			if ($objForm)
				return ($grant_package->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grant_package->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrant_package_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (grant_package)
		$GLOBALS["grant_package"] = new cgrant_package();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grant_package', TRUE);

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
		global $grant_package;

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
			$this->Page_Terminate("grant_packagelist.php");
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
		global $Language, $grant_package;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["grant_package_id"] <> "") {
				$grant_package->grant_package_id->setQueryStringValue($_GET["grant_package_id"]);
				$this->arRecKey["grant_package_id"] = $grant_package->grant_package_id->QueryStringValue;
			} else {
				$sReturnUrl = "grant_packagelist.php"; // Return to list
			}

			// Get action
			$grant_package->CurrentAction = "I"; // Display form
			switch ($grant_package->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "grant_packagelist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "grant_packagelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$grant_package->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $grant_package;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$grant_package->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$grant_package->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $grant_package->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$grant_package->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$grant_package->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$grant_package->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grant_package;
		$sFilter = $grant_package->KeyFilter();

		// Call Row Selecting event
		$grant_package->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grant_package->CurrentFilter = $sFilter;
		$sSql = $grant_package->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$grant_package->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $grant_package;
		$grant_package->grant_package_id->setDbValue($rs->fields('grant_package_id'));
		$grant_package->name->setDbValue($rs->fields('name'));
		$grant_package->code->setDbValue($rs->fields('code'));
		$grant_package->annual_amount->setDbValue($rs->fields('annual_amount'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grant_package;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "grant_package_id=" . urlencode($grant_package->grant_package_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "grant_package_id=" . urlencode($grant_package->grant_package_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "grant_package_id=" . urlencode($grant_package->grant_package_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "grant_package_id=" . urlencode($grant_package->grant_package_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "grant_package_id=" . urlencode($grant_package->grant_package_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "grant_package_id=" . urlencode($grant_package->grant_package_id->CurrentValue);
		$this->AddUrl = $grant_package->AddUrl();
		$this->EditUrl = $grant_package->EditUrl();
		$this->CopyUrl = $grant_package->CopyUrl();
		$this->DeleteUrl = $grant_package->DeleteUrl();
		$this->ListUrl = $grant_package->ListUrl();

		// Call Row_Rendering event
		$grant_package->Row_Rendering();

		// Common render codes for all row types
		// grant_package_id

		$grant_package->grant_package_id->CellCssStyle = ""; $grant_package->grant_package_id->CellCssClass = "";
		$grant_package->grant_package_id->CellAttrs = array(); $grant_package->grant_package_id->ViewAttrs = array(); $grant_package->grant_package_id->EditAttrs = array();

		// name
		$grant_package->name->CellCssStyle = ""; $grant_package->name->CellCssClass = "";
		$grant_package->name->CellAttrs = array(); $grant_package->name->ViewAttrs = array(); $grant_package->name->EditAttrs = array();

		// code
		$grant_package->code->CellCssStyle = ""; $grant_package->code->CellCssClass = "";
		$grant_package->code->CellAttrs = array(); $grant_package->code->ViewAttrs = array(); $grant_package->code->EditAttrs = array();

		// annual_amount
		$grant_package->annual_amount->CellCssStyle = ""; $grant_package->annual_amount->CellCssClass = "";
		$grant_package->annual_amount->CellAttrs = array(); $grant_package->annual_amount->ViewAttrs = array(); $grant_package->annual_amount->EditAttrs = array();
		if ($grant_package->RowType == EW_ROWTYPE_VIEW) { // View row

			// grant_package_id
			$grant_package->grant_package_id->ViewValue = $grant_package->grant_package_id->CurrentValue;
			$grant_package->grant_package_id->CssStyle = "";
			$grant_package->grant_package_id->CssClass = "";
			$grant_package->grant_package_id->ViewCustomAttributes = "";

			// name
			$grant_package->name->ViewValue = $grant_package->name->CurrentValue;
			$grant_package->name->CssStyle = "";
			$grant_package->name->CssClass = "";
			$grant_package->name->ViewCustomAttributes = "";

			// code
			$grant_package->code->ViewValue = $grant_package->code->CurrentValue;
			$grant_package->code->CssStyle = "";
			$grant_package->code->CssClass = "";
			$grant_package->code->ViewCustomAttributes = "";

			// annual_amount
			$grant_package->annual_amount->ViewValue = $grant_package->annual_amount->CurrentValue;
			$grant_package->annual_amount->CssStyle = "";
			$grant_package->annual_amount->CssClass = "";
			$grant_package->annual_amount->ViewCustomAttributes = "";

			// grant_package_id
			$grant_package->grant_package_id->HrefValue = "";
			$grant_package->grant_package_id->TooltipValue = "";

			// name
			$grant_package->name->HrefValue = "";
			$grant_package->name->TooltipValue = "";

			// code
			$grant_package->code->HrefValue = "";
			$grant_package->code->TooltipValue = "";

			// annual_amount
			$grant_package->annual_amount->HrefValue = "";
			$grant_package->annual_amount->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($grant_package->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grant_package->Row_Rendered();
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
