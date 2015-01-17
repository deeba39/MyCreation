<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "scholarship_packageinfo.php" ?>
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
$scholarship_package_view = new cscholarship_package_view();
$Page =& $scholarship_package_view;

// Page init
$scholarship_package_view->Page_Init();

// Page main
$scholarship_package_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($scholarship_package->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var scholarship_package_view = new ew_Page("scholarship_package_view");

// page properties
scholarship_package_view.PageID = "view"; // page ID
scholarship_package_view.FormID = "fscholarship_packageview"; // form ID
var EW_PAGE_ID = scholarship_package_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
scholarship_package_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
scholarship_package_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
scholarship_package_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $scholarship_package->TableCaption() ?>
<br><br>
<?php if ($scholarship_package->Export == "") { ?>
<a href="<?php echo $scholarship_package_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<?php if ($scholarship_package_view->ShowOptionLink()) { ?>
<a href="<?php echo $scholarship_package_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<?php if ($scholarship_package_view->ShowOptionLink()) { ?>
<a href="<?php echo $scholarship_package_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<?php if ($scholarship_package_view->ShowOptionLink()) { ?>
<a href="<?php echo $scholarship_package_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$scholarship_package_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($scholarship_package->scholarship_package_id->Visible) { // scholarship_package_id ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->scholarship_package_id->FldCaption() ?></td>
		<td<?php echo $scholarship_package->scholarship_package_id->CellAttributes() ?>>
<div<?php echo $scholarship_package->scholarship_package_id->ViewAttributes() ?>><?php echo $scholarship_package->scholarship_package_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->start_date->Visible) { // start_date ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->start_date->FldCaption() ?></td>
		<td<?php echo $scholarship_package->start_date->CellAttributes() ?>>
<div<?php echo $scholarship_package->start_date->ViewAttributes() ?>><?php echo $scholarship_package->start_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->end_date->Visible) { // end_date ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->end_date->FldCaption() ?></td>
		<td<?php echo $scholarship_package->end_date->CellAttributes() ?>>
<div<?php echo $scholarship_package->end_date->ViewAttributes() ?>><?php echo $scholarship_package->end_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->status->Visible) { // status ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->status->FldCaption() ?></td>
		<td<?php echo $scholarship_package->status->CellAttributes() ?>>
<div<?php echo $scholarship_package->status->ViewAttributes() ?>><?php echo $scholarship_package->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->annual_amount->Visible) { // annual_amount ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->annual_amount->FldCaption() ?></td>
		<td<?php echo $scholarship_package->annual_amount->CellAttributes() ?>>
<div<?php echo $scholarship_package->annual_amount->ViewAttributes() ?>><?php echo $scholarship_package->annual_amount->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->grant_package_grant_package_id->Visible) { // grant_package_grant_package_id ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->grant_package_grant_package_id->FldCaption() ?></td>
		<td<?php echo $scholarship_package->grant_package_grant_package_id->CellAttributes() ?>>
<div<?php echo $scholarship_package->grant_package_grant_package_id->ViewAttributes() ?>><?php echo $scholarship_package->grant_package_grant_package_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->sponsored_student_sponsored_student_id->Visible) { // sponsored_student_sponsored_student_id ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->sponsored_student_sponsored_student_id->FldCaption() ?></td>
		<td<?php echo $scholarship_package->sponsored_student_sponsored_student_id->CellAttributes() ?>>
<div<?php echo $scholarship_package->sponsored_student_sponsored_student_id->ViewAttributes() ?>><?php echo $scholarship_package->sponsored_student_sponsored_student_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->scholarship_type->Visible) { // scholarship_type ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->scholarship_type->FldCaption() ?></td>
		<td<?php echo $scholarship_package->scholarship_type->CellAttributes() ?>>
<div<?php echo $scholarship_package->scholarship_type->ViewAttributes() ?>><?php echo $scholarship_package->scholarship_type->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->scholarship_type_scholarship_type->Visible) { // scholarship_type_scholarship_type ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->scholarship_type_scholarship_type->FldCaption() ?></td>
		<td<?php echo $scholarship_package->scholarship_type_scholarship_type->CellAttributes() ?>>
<div<?php echo $scholarship_package->scholarship_type_scholarship_type->ViewAttributes() ?>><?php echo $scholarship_package->scholarship_type_scholarship_type->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->group_id->Visible) { // group_id ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->group_id->FldCaption() ?></td>
		<td<?php echo $scholarship_package->group_id->CellAttributes() ?>>
<div<?php echo $scholarship_package->group_id->ViewAttributes() ?>><?php echo $scholarship_package->group_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($scholarship_package->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$scholarship_package_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cscholarship_package_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'scholarship_package';

	// Page object name
	var $PageObjName = 'scholarship_package_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $scholarship_package;
		if ($scholarship_package->UseTokenInUrl) $PageUrl .= "t=" . $scholarship_package->TableVar . "&"; // Add page token
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
		global $objForm, $scholarship_package;
		if ($scholarship_package->UseTokenInUrl) {
			if ($objForm)
				return ($scholarship_package->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($scholarship_package->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cscholarship_package_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (scholarship_package)
		$GLOBALS["scholarship_package"] = new cscholarship_package();

		// Table object (grant_package)
		$GLOBALS['grant_package'] = new cgrant_package();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'scholarship_package', TRUE);

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
		global $scholarship_package;

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
			$this->Page_Terminate("scholarship_packagelist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("scholarship_packagelist.php");
		}

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
		global $Language, $scholarship_package;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["scholarship_package_id"] <> "") {
				$scholarship_package->scholarship_package_id->setQueryStringValue($_GET["scholarship_package_id"]);
				$this->arRecKey["scholarship_package_id"] = $scholarship_package->scholarship_package_id->QueryStringValue;
			} else {
				$sReturnUrl = "scholarship_packagelist.php"; // Return to list
			}

			// Get action
			$scholarship_package->CurrentAction = "I"; // Display form
			switch ($scholarship_package->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "scholarship_packagelist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "scholarship_packagelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$scholarship_package->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $scholarship_package;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$scholarship_package->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$scholarship_package->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $scholarship_package->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$scholarship_package->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$scholarship_package->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$scholarship_package->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $scholarship_package;
		$sFilter = $scholarship_package->KeyFilter();

		// Call Row Selecting event
		$scholarship_package->Row_Selecting($sFilter);

		// Load SQL based on filter
		$scholarship_package->CurrentFilter = $sFilter;
		$sSql = $scholarship_package->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$scholarship_package->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $scholarship_package;
		$scholarship_package->scholarship_package_id->setDbValue($rs->fields('scholarship_package_id'));
		$scholarship_package->start_date->setDbValue($rs->fields('start_date'));
		$scholarship_package->end_date->setDbValue($rs->fields('end_date'));
		$scholarship_package->status->setDbValue($rs->fields('status'));
		$scholarship_package->annual_amount->setDbValue($rs->fields('annual_amount'));
		$scholarship_package->grant_package_grant_package_id->setDbValue($rs->fields('grant_package_grant_package_id'));
		$scholarship_package->sponsored_student_sponsored_student_id->setDbValue($rs->fields('sponsored_student_sponsored_student_id'));
		$scholarship_package->scholarship_type->setDbValue($rs->fields('scholarship_type'));
		$scholarship_package->scholarship_type_scholarship_type->setDbValue($rs->fields('scholarship_type_scholarship_type'));
		$scholarship_package->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $scholarship_package;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "scholarship_package_id=" . urlencode($scholarship_package->scholarship_package_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "scholarship_package_id=" . urlencode($scholarship_package->scholarship_package_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "scholarship_package_id=" . urlencode($scholarship_package->scholarship_package_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "scholarship_package_id=" . urlencode($scholarship_package->scholarship_package_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "scholarship_package_id=" . urlencode($scholarship_package->scholarship_package_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "scholarship_package_id=" . urlencode($scholarship_package->scholarship_package_id->CurrentValue);
		$this->AddUrl = $scholarship_package->AddUrl();
		$this->EditUrl = $scholarship_package->EditUrl();
		$this->CopyUrl = $scholarship_package->CopyUrl();
		$this->DeleteUrl = $scholarship_package->DeleteUrl();
		$this->ListUrl = $scholarship_package->ListUrl();

		// Call Row_Rendering event
		$scholarship_package->Row_Rendering();

		// Common render codes for all row types
		// scholarship_package_id

		$scholarship_package->scholarship_package_id->CellCssStyle = ""; $scholarship_package->scholarship_package_id->CellCssClass = "";
		$scholarship_package->scholarship_package_id->CellAttrs = array(); $scholarship_package->scholarship_package_id->ViewAttrs = array(); $scholarship_package->scholarship_package_id->EditAttrs = array();

		// start_date
		$scholarship_package->start_date->CellCssStyle = ""; $scholarship_package->start_date->CellCssClass = "";
		$scholarship_package->start_date->CellAttrs = array(); $scholarship_package->start_date->ViewAttrs = array(); $scholarship_package->start_date->EditAttrs = array();

		// end_date
		$scholarship_package->end_date->CellCssStyle = ""; $scholarship_package->end_date->CellCssClass = "";
		$scholarship_package->end_date->CellAttrs = array(); $scholarship_package->end_date->ViewAttrs = array(); $scholarship_package->end_date->EditAttrs = array();

		// status
		$scholarship_package->status->CellCssStyle = ""; $scholarship_package->status->CellCssClass = "";
		$scholarship_package->status->CellAttrs = array(); $scholarship_package->status->ViewAttrs = array(); $scholarship_package->status->EditAttrs = array();

		// annual_amount
		$scholarship_package->annual_amount->CellCssStyle = ""; $scholarship_package->annual_amount->CellCssClass = "";
		$scholarship_package->annual_amount->CellAttrs = array(); $scholarship_package->annual_amount->ViewAttrs = array(); $scholarship_package->annual_amount->EditAttrs = array();

		// grant_package_grant_package_id
		$scholarship_package->grant_package_grant_package_id->CellCssStyle = ""; $scholarship_package->grant_package_grant_package_id->CellCssClass = "";
		$scholarship_package->grant_package_grant_package_id->CellAttrs = array(); $scholarship_package->grant_package_grant_package_id->ViewAttrs = array(); $scholarship_package->grant_package_grant_package_id->EditAttrs = array();

		// sponsored_student_sponsored_student_id
		$scholarship_package->sponsored_student_sponsored_student_id->CellCssStyle = ""; $scholarship_package->sponsored_student_sponsored_student_id->CellCssClass = "";
		$scholarship_package->sponsored_student_sponsored_student_id->CellAttrs = array(); $scholarship_package->sponsored_student_sponsored_student_id->ViewAttrs = array(); $scholarship_package->sponsored_student_sponsored_student_id->EditAttrs = array();

		// scholarship_type
		$scholarship_package->scholarship_type->CellCssStyle = ""; $scholarship_package->scholarship_type->CellCssClass = "";
		$scholarship_package->scholarship_type->CellAttrs = array(); $scholarship_package->scholarship_type->ViewAttrs = array(); $scholarship_package->scholarship_type->EditAttrs = array();

		// scholarship_type_scholarship_type
		$scholarship_package->scholarship_type_scholarship_type->CellCssStyle = ""; $scholarship_package->scholarship_type_scholarship_type->CellCssClass = "";
		$scholarship_package->scholarship_type_scholarship_type->CellAttrs = array(); $scholarship_package->scholarship_type_scholarship_type->ViewAttrs = array(); $scholarship_package->scholarship_type_scholarship_type->EditAttrs = array();

		// group_id
		$scholarship_package->group_id->CellCssStyle = ""; $scholarship_package->group_id->CellCssClass = "";
		$scholarship_package->group_id->CellAttrs = array(); $scholarship_package->group_id->ViewAttrs = array(); $scholarship_package->group_id->EditAttrs = array();
		if ($scholarship_package->RowType == EW_ROWTYPE_VIEW) { // View row

			// scholarship_package_id
			$scholarship_package->scholarship_package_id->ViewValue = $scholarship_package->scholarship_package_id->CurrentValue;
			$scholarship_package->scholarship_package_id->CssStyle = "";
			$scholarship_package->scholarship_package_id->CssClass = "";
			$scholarship_package->scholarship_package_id->ViewCustomAttributes = "";

			// start_date
			$scholarship_package->start_date->ViewValue = $scholarship_package->start_date->CurrentValue;
			$scholarship_package->start_date->ViewValue = ew_FormatDateTime($scholarship_package->start_date->ViewValue, 7);
			$scholarship_package->start_date->CssStyle = "";
			$scholarship_package->start_date->CssClass = "";
			$scholarship_package->start_date->ViewCustomAttributes = "";

			// end_date
			$scholarship_package->end_date->ViewValue = $scholarship_package->end_date->CurrentValue;
			$scholarship_package->end_date->ViewValue = ew_FormatDateTime($scholarship_package->end_date->ViewValue, 7);
			$scholarship_package->end_date->CssStyle = "";
			$scholarship_package->end_date->CssClass = "";
			$scholarship_package->end_date->ViewCustomAttributes = "";

			// status
			if (strval($scholarship_package->status->CurrentValue) <> "") {
				switch ($scholarship_package->status->CurrentValue) {
					case "active":
						$scholarship_package->status->ViewValue = "Active";
						break;
					case "suspended":
						$scholarship_package->status->ViewValue = "Suspended";
						break;
					default:
						$scholarship_package->status->ViewValue = $scholarship_package->status->CurrentValue;
				}
			} else {
				$scholarship_package->status->ViewValue = NULL;
			}
			$scholarship_package->status->CssStyle = "";
			$scholarship_package->status->CssClass = "";
			$scholarship_package->status->ViewCustomAttributes = "";

			// annual_amount
			$scholarship_package->annual_amount->ViewValue = $scholarship_package->annual_amount->CurrentValue;
			$scholarship_package->annual_amount->CssStyle = "";
			$scholarship_package->annual_amount->CssClass = "";
			$scholarship_package->annual_amount->ViewCustomAttributes = "";

			// grant_package_grant_package_id
			$scholarship_package->grant_package_grant_package_id->ViewValue = $scholarship_package->grant_package_grant_package_id->CurrentValue;
			$scholarship_package->grant_package_grant_package_id->CssStyle = "";
			$scholarship_package->grant_package_grant_package_id->CssClass = "";
			$scholarship_package->grant_package_grant_package_id->ViewCustomAttributes = "";

			// sponsored_student_sponsored_student_id
			$scholarship_package->sponsored_student_sponsored_student_id->ViewValue = $scholarship_package->sponsored_student_sponsored_student_id->CurrentValue;
			$scholarship_package->sponsored_student_sponsored_student_id->CssStyle = "";
			$scholarship_package->sponsored_student_sponsored_student_id->CssClass = "";
			$scholarship_package->sponsored_student_sponsored_student_id->ViewCustomAttributes = "";

			// scholarship_type
			$scholarship_package->scholarship_type->ViewValue = $scholarship_package->scholarship_type->CurrentValue;
			$scholarship_package->scholarship_type->CssStyle = "";
			$scholarship_package->scholarship_type->CssClass = "";
			$scholarship_package->scholarship_type->ViewCustomAttributes = "";

			// scholarship_type_scholarship_type
			$scholarship_package->scholarship_type_scholarship_type->ViewValue = $scholarship_package->scholarship_type_scholarship_type->CurrentValue;
			$scholarship_package->scholarship_type_scholarship_type->CssStyle = "";
			$scholarship_package->scholarship_type_scholarship_type->CssClass = "";
			$scholarship_package->scholarship_type_scholarship_type->ViewCustomAttributes = "";

			// group_id
			$scholarship_package->group_id->ViewValue = $scholarship_package->group_id->CurrentValue;
			$scholarship_package->group_id->CssStyle = "";
			$scholarship_package->group_id->CssClass = "";
			$scholarship_package->group_id->ViewCustomAttributes = "";

			// scholarship_package_id
			$scholarship_package->scholarship_package_id->HrefValue = "";
			$scholarship_package->scholarship_package_id->TooltipValue = "";

			// start_date
			$scholarship_package->start_date->HrefValue = "";
			$scholarship_package->start_date->TooltipValue = "";

			// end_date
			$scholarship_package->end_date->HrefValue = "";
			$scholarship_package->end_date->TooltipValue = "";

			// status
			$scholarship_package->status->HrefValue = "";
			$scholarship_package->status->TooltipValue = "";

			// annual_amount
			$scholarship_package->annual_amount->HrefValue = "";
			$scholarship_package->annual_amount->TooltipValue = "";

			// grant_package_grant_package_id
			$scholarship_package->grant_package_grant_package_id->HrefValue = "";
			$scholarship_package->grant_package_grant_package_id->TooltipValue = "";

			// sponsored_student_sponsored_student_id
			$scholarship_package->sponsored_student_sponsored_student_id->HrefValue = "";
			$scholarship_package->sponsored_student_sponsored_student_id->TooltipValue = "";

			// scholarship_type
			$scholarship_package->scholarship_type->HrefValue = "";
			$scholarship_package->scholarship_type->TooltipValue = "";

			// scholarship_type_scholarship_type
			$scholarship_package->scholarship_type_scholarship_type->HrefValue = "";
			$scholarship_package->scholarship_type_scholarship_type->TooltipValue = "";

			// group_id
			$scholarship_package->group_id->HrefValue = "";
			$scholarship_package->group_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($scholarship_package->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$scholarship_package->Row_Rendered();
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $scholarship_package;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($scholarship_package->group_id->CurrentValue);
			}
		}
		return TRUE;
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
