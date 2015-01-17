<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "sponsored_student_detailinfo.php" ?>
<?php include "programareainfo.php" ?>
<?php include "communityinfo.php" ?>
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
$sponsored_student_detail_view = new csponsored_student_detail_view();
$Page =& $sponsored_student_detail_view;

// Page init
$sponsored_student_detail_view->Page_Init();

// Page main
$sponsored_student_detail_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($sponsored_student_detail->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var sponsored_student_detail_view = new ew_Page("sponsored_student_detail_view");

// page properties
sponsored_student_detail_view.PageID = "view"; // page ID
sponsored_student_detail_view.FormID = "fsponsored_student_detailview"; // form ID
var EW_PAGE_ID = sponsored_student_detail_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
sponsored_student_detail_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
sponsored_student_detail_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sponsored_student_detail_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $sponsored_student_detail->TableCaption() ?>
<br><br>
<?php if ($sponsored_student_detail->Export == "") { ?>
<a href="<?php echo $sponsored_student_detail_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->AllowList('scholarship_package')) { ?>
<a href="scholarship_packagelist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=sponsored_student_detail&sponsored_student_id=<?php echo urlencode(strval($sponsored_student_detail->sponsored_student_id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("scholarship_package", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php if ($Security->AllowList('school_attendance')) { ?>
<a href="school_attendancelist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=sponsored_student_detail&sponsored_student_id=<?php echo urlencode(strval($sponsored_student_detail->sponsored_student_id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("school_attendance", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$sponsored_student_detail_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($sponsored_student_detail->sponsored_student_id->Visible) { // sponsored_student_id ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->sponsored_student_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->sponsored_student_id->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->sponsored_student_id->ViewAttributes() ?>><?php echo $sponsored_student_detail->sponsored_student_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student_detail->student_firstname->Visible) { // student_firstname ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_firstname->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_firstname->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_firstname->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_firstname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student_detail->student_middlename->Visible) { // student_middlename ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_middlename->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_middlename->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_middlename->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_middlename->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student_detail->student_lastname->Visible) { // student_lastname ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_lastname->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_lastname->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_lastname->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_lastname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student_detail->student_telephone_1->Visible) { // student_telephone_1 ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_telephone_1->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_telephone_1->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_telephone_1->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_telephone_1->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student_detail->student_telephone_2->Visible) { // student_telephone_2 ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_telephone_2->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_telephone_2->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_telephone_2->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_telephone_2->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student_detail->student_dob->Visible) { // student_dob ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_dob->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_dob->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_dob->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_dob->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student_detail->age->Visible) { // age ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->age->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->age->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->age->ViewAttributes() ?>><?php echo $sponsored_student_detail->age->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student_detail->student_gender->Visible) { // student_gender ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_gender->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_gender->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_gender->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_gender->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student_detail->student_address->Visible) { // student_address ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_address->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_address->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_address->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student_detail->app_submission_year->Visible) { // app_submission_year ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->app_submission_year->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->app_submission_year->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->app_submission_year->ViewAttributes() ?>><?php echo $sponsored_student_detail->app_submission_year->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student_detail->community->Visible) { // community ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->community->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->community->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->community->ViewAttributes() ?>><?php echo $sponsored_student_detail->community->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student_detail->programarea_name->Visible) { // programarea_name ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->programarea_name->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->programarea_name->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->programarea_name->ViewAttributes() ?>><?php echo $sponsored_student_detail->programarea_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student_detail->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->student_resident_programarea_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->student_resident_programarea_id->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->student_resident_programarea_id->ViewAttributes() ?>><?php echo $sponsored_student_detail->student_resident_programarea_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student_detail->District->Visible) { // District ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->District->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->District->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->District->ViewAttributes() ?>><?php echo $sponsored_student_detail->District->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student_detail->community_districts_DistrictID->Visible) { // community_districts_DistrictID ?>
	<tr<?php echo $sponsored_student_detail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student_detail->community_districts_DistrictID->FldCaption() ?></td>
		<td<?php echo $sponsored_student_detail->community_districts_DistrictID->CellAttributes() ?>>
<div<?php echo $sponsored_student_detail->community_districts_DistrictID->ViewAttributes() ?>><?php echo $sponsored_student_detail->community_districts_DistrictID->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($sponsored_student_detail->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$sponsored_student_detail_view->Page_Terminate();
?>
<?php

//
// Page class
//
class csponsored_student_detail_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'sponsored_student_detail';

	// Page object name
	var $PageObjName = 'sponsored_student_detail_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $sponsored_student_detail;
		if ($sponsored_student_detail->UseTokenInUrl) $PageUrl .= "t=" . $sponsored_student_detail->TableVar . "&"; // Add page token
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
		global $objForm, $sponsored_student_detail;
		if ($sponsored_student_detail->UseTokenInUrl) {
			if ($objForm)
				return ($sponsored_student_detail->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($sponsored_student_detail->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csponsored_student_detail_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (sponsored_student_detail)
		$GLOBALS["sponsored_student_detail"] = new csponsored_student_detail();

		// Table object (programarea)
		$GLOBALS['programarea'] = new cprogramarea();

		// Table object (community)
		$GLOBALS['community'] = new ccommunity();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'sponsored_student_detail', TRUE);

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
		global $sponsored_student_detail;

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
			$this->Page_Terminate("sponsored_student_detaillist.php");
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
		global $Language, $sponsored_student_detail;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["sponsored_student_id"] <> "") {
				$sponsored_student_detail->sponsored_student_id->setQueryStringValue($_GET["sponsored_student_id"]);
				$this->arRecKey["sponsored_student_id"] = $sponsored_student_detail->sponsored_student_id->QueryStringValue;
			} else {
				$sReturnUrl = "sponsored_student_detaillist.php"; // Return to list
			}

			// Get action
			$sponsored_student_detail->CurrentAction = "I"; // Display form
			switch ($sponsored_student_detail->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "sponsored_student_detaillist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "sponsored_student_detaillist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$sponsored_student_detail->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $sponsored_student_detail;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$sponsored_student_detail->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$sponsored_student_detail->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $sponsored_student_detail->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$sponsored_student_detail->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$sponsored_student_detail->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$sponsored_student_detail->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $sponsored_student_detail;
		$sFilter = $sponsored_student_detail->KeyFilter();

		// Call Row Selecting event
		$sponsored_student_detail->Row_Selecting($sFilter);

		// Load SQL based on filter
		$sponsored_student_detail->CurrentFilter = $sFilter;
		$sSql = $sponsored_student_detail->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$sponsored_student_detail->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $sponsored_student_detail;
		$sponsored_student_detail->sponsored_student_id->setDbValue($rs->fields('sponsored_student_id'));
		$sponsored_student_detail->student_firstname->setDbValue($rs->fields('student_firstname'));
		$sponsored_student_detail->student_middlename->setDbValue($rs->fields('student_middlename'));
		$sponsored_student_detail->student_lastname->setDbValue($rs->fields('student_lastname'));
		$sponsored_student_detail->student_telephone_1->setDbValue($rs->fields('student_telephone_1'));
		$sponsored_student_detail->student_telephone_2->setDbValue($rs->fields('student_telephone_2'));
		$sponsored_student_detail->student_dob->setDbValue($rs->fields('student_dob'));
		$sponsored_student_detail->age->setDbValue($rs->fields('age'));
		$sponsored_student_detail->student_gender->setDbValue($rs->fields('student_gender'));
		$sponsored_student_detail->student_address->setDbValue($rs->fields('student_address'));
		$sponsored_student_detail->app_submission_year->setDbValue($rs->fields('app_submission_year'));
		$sponsored_student_detail->community->setDbValue($rs->fields('community'));
		$sponsored_student_detail->community_community_id->setDbValue($rs->fields('community_community_id'));
		$sponsored_student_detail->programarea_name->setDbValue($rs->fields('programarea_name'));
		$sponsored_student_detail->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
		$sponsored_student_detail->District->setDbValue($rs->fields('District'));
		$sponsored_student_detail->community_districts_DistrictID->setDbValue($rs->fields('community_districts_DistrictID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $sponsored_student_detail;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "sponsored_student_id=" . urlencode($sponsored_student_detail->sponsored_student_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "sponsored_student_id=" . urlencode($sponsored_student_detail->sponsored_student_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "sponsored_student_id=" . urlencode($sponsored_student_detail->sponsored_student_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "sponsored_student_id=" . urlencode($sponsored_student_detail->sponsored_student_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "sponsored_student_id=" . urlencode($sponsored_student_detail->sponsored_student_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "sponsored_student_id=" . urlencode($sponsored_student_detail->sponsored_student_id->CurrentValue);
		$this->AddUrl = $sponsored_student_detail->AddUrl();
		$this->EditUrl = $sponsored_student_detail->EditUrl();
		$this->CopyUrl = $sponsored_student_detail->CopyUrl();
		$this->DeleteUrl = $sponsored_student_detail->DeleteUrl();
		$this->ListUrl = $sponsored_student_detail->ListUrl();

		// Call Row_Rendering event
		$sponsored_student_detail->Row_Rendering();

		// Common render codes for all row types
		// sponsored_student_id

		$sponsored_student_detail->sponsored_student_id->CellCssStyle = ""; $sponsored_student_detail->sponsored_student_id->CellCssClass = "";
		$sponsored_student_detail->sponsored_student_id->CellAttrs = array(); $sponsored_student_detail->sponsored_student_id->ViewAttrs = array(); $sponsored_student_detail->sponsored_student_id->EditAttrs = array();

		// student_firstname
		$sponsored_student_detail->student_firstname->CellCssStyle = ""; $sponsored_student_detail->student_firstname->CellCssClass = "";
		$sponsored_student_detail->student_firstname->CellAttrs = array(); $sponsored_student_detail->student_firstname->ViewAttrs = array(); $sponsored_student_detail->student_firstname->EditAttrs = array();

		// student_middlename
		$sponsored_student_detail->student_middlename->CellCssStyle = ""; $sponsored_student_detail->student_middlename->CellCssClass = "";
		$sponsored_student_detail->student_middlename->CellAttrs = array(); $sponsored_student_detail->student_middlename->ViewAttrs = array(); $sponsored_student_detail->student_middlename->EditAttrs = array();

		// student_lastname
		$sponsored_student_detail->student_lastname->CellCssStyle = ""; $sponsored_student_detail->student_lastname->CellCssClass = "";
		$sponsored_student_detail->student_lastname->CellAttrs = array(); $sponsored_student_detail->student_lastname->ViewAttrs = array(); $sponsored_student_detail->student_lastname->EditAttrs = array();

		// student_telephone_1
		$sponsored_student_detail->student_telephone_1->CellCssStyle = ""; $sponsored_student_detail->student_telephone_1->CellCssClass = "";
		$sponsored_student_detail->student_telephone_1->CellAttrs = array(); $sponsored_student_detail->student_telephone_1->ViewAttrs = array(); $sponsored_student_detail->student_telephone_1->EditAttrs = array();

		// student_telephone_2
		$sponsored_student_detail->student_telephone_2->CellCssStyle = ""; $sponsored_student_detail->student_telephone_2->CellCssClass = "";
		$sponsored_student_detail->student_telephone_2->CellAttrs = array(); $sponsored_student_detail->student_telephone_2->ViewAttrs = array(); $sponsored_student_detail->student_telephone_2->EditAttrs = array();

		// student_dob
		$sponsored_student_detail->student_dob->CellCssStyle = ""; $sponsored_student_detail->student_dob->CellCssClass = "";
		$sponsored_student_detail->student_dob->CellAttrs = array(); $sponsored_student_detail->student_dob->ViewAttrs = array(); $sponsored_student_detail->student_dob->EditAttrs = array();

		// age
		$sponsored_student_detail->age->CellCssStyle = ""; $sponsored_student_detail->age->CellCssClass = "";
		$sponsored_student_detail->age->CellAttrs = array(); $sponsored_student_detail->age->ViewAttrs = array(); $sponsored_student_detail->age->EditAttrs = array();

		// student_gender
		$sponsored_student_detail->student_gender->CellCssStyle = ""; $sponsored_student_detail->student_gender->CellCssClass = "";
		$sponsored_student_detail->student_gender->CellAttrs = array(); $sponsored_student_detail->student_gender->ViewAttrs = array(); $sponsored_student_detail->student_gender->EditAttrs = array();

		// student_address
		$sponsored_student_detail->student_address->CellCssStyle = ""; $sponsored_student_detail->student_address->CellCssClass = "";
		$sponsored_student_detail->student_address->CellAttrs = array(); $sponsored_student_detail->student_address->ViewAttrs = array(); $sponsored_student_detail->student_address->EditAttrs = array();

		// app_submission_year
		$sponsored_student_detail->app_submission_year->CellCssStyle = ""; $sponsored_student_detail->app_submission_year->CellCssClass = "";
		$sponsored_student_detail->app_submission_year->CellAttrs = array(); $sponsored_student_detail->app_submission_year->ViewAttrs = array(); $sponsored_student_detail->app_submission_year->EditAttrs = array();

		// community
		$sponsored_student_detail->community->CellCssStyle = ""; $sponsored_student_detail->community->CellCssClass = "";
		$sponsored_student_detail->community->CellAttrs = array(); $sponsored_student_detail->community->ViewAttrs = array(); $sponsored_student_detail->community->EditAttrs = array();

		// programarea_name
		$sponsored_student_detail->programarea_name->CellCssStyle = ""; $sponsored_student_detail->programarea_name->CellCssClass = "";
		$sponsored_student_detail->programarea_name->CellAttrs = array(); $sponsored_student_detail->programarea_name->ViewAttrs = array(); $sponsored_student_detail->programarea_name->EditAttrs = array();

		// student_resident_programarea_id
		$sponsored_student_detail->student_resident_programarea_id->CellCssStyle = ""; $sponsored_student_detail->student_resident_programarea_id->CellCssClass = "";
		$sponsored_student_detail->student_resident_programarea_id->CellAttrs = array(); $sponsored_student_detail->student_resident_programarea_id->ViewAttrs = array(); $sponsored_student_detail->student_resident_programarea_id->EditAttrs = array();

		// District
		$sponsored_student_detail->District->CellCssStyle = ""; $sponsored_student_detail->District->CellCssClass = "";
		$sponsored_student_detail->District->CellAttrs = array(); $sponsored_student_detail->District->ViewAttrs = array(); $sponsored_student_detail->District->EditAttrs = array();

		// community_districts_DistrictID
		$sponsored_student_detail->community_districts_DistrictID->CellCssStyle = ""; $sponsored_student_detail->community_districts_DistrictID->CellCssClass = "";
		$sponsored_student_detail->community_districts_DistrictID->CellAttrs = array(); $sponsored_student_detail->community_districts_DistrictID->ViewAttrs = array(); $sponsored_student_detail->community_districts_DistrictID->EditAttrs = array();
		if ($sponsored_student_detail->RowType == EW_ROWTYPE_VIEW) { // View row

			// sponsored_student_id
			$sponsored_student_detail->sponsored_student_id->ViewValue = $sponsored_student_detail->sponsored_student_id->CurrentValue;
			$sponsored_student_detail->sponsored_student_id->CssStyle = "";
			$sponsored_student_detail->sponsored_student_id->CssClass = "";
			$sponsored_student_detail->sponsored_student_id->ViewCustomAttributes = "";

			// student_firstname
			$sponsored_student_detail->student_firstname->ViewValue = $sponsored_student_detail->student_firstname->CurrentValue;
			$sponsored_student_detail->student_firstname->CssStyle = "";
			$sponsored_student_detail->student_firstname->CssClass = "";
			$sponsored_student_detail->student_firstname->ViewCustomAttributes = "";

			// student_middlename
			$sponsored_student_detail->student_middlename->ViewValue = $sponsored_student_detail->student_middlename->CurrentValue;
			$sponsored_student_detail->student_middlename->CssStyle = "";
			$sponsored_student_detail->student_middlename->CssClass = "";
			$sponsored_student_detail->student_middlename->ViewCustomAttributes = "";

			// student_lastname
			$sponsored_student_detail->student_lastname->ViewValue = $sponsored_student_detail->student_lastname->CurrentValue;
			$sponsored_student_detail->student_lastname->CssStyle = "";
			$sponsored_student_detail->student_lastname->CssClass = "";
			$sponsored_student_detail->student_lastname->ViewCustomAttributes = "";

			// student_telephone_1
			$sponsored_student_detail->student_telephone_1->ViewValue = $sponsored_student_detail->student_telephone_1->CurrentValue;
			$sponsored_student_detail->student_telephone_1->CssStyle = "";
			$sponsored_student_detail->student_telephone_1->CssClass = "";
			$sponsored_student_detail->student_telephone_1->ViewCustomAttributes = "";

			// student_telephone_2
			$sponsored_student_detail->student_telephone_2->ViewValue = $sponsored_student_detail->student_telephone_2->CurrentValue;
			$sponsored_student_detail->student_telephone_2->CssStyle = "";
			$sponsored_student_detail->student_telephone_2->CssClass = "";
			$sponsored_student_detail->student_telephone_2->ViewCustomAttributes = "";

			// student_dob
			$sponsored_student_detail->student_dob->ViewValue = $sponsored_student_detail->student_dob->CurrentValue;
			$sponsored_student_detail->student_dob->ViewValue = ew_FormatDateTime($sponsored_student_detail->student_dob->ViewValue, 7);
			$sponsored_student_detail->student_dob->CssStyle = "";
			$sponsored_student_detail->student_dob->CssClass = "";
			$sponsored_student_detail->student_dob->ViewCustomAttributes = "";

			// age
			$sponsored_student_detail->age->ViewValue = $sponsored_student_detail->age->CurrentValue;
			$sponsored_student_detail->age->CssStyle = "";
			$sponsored_student_detail->age->CssClass = "";
			$sponsored_student_detail->age->ViewCustomAttributes = "";

			// student_gender
			if (strval($sponsored_student_detail->student_gender->CurrentValue) <> "") {
				switch ($sponsored_student_detail->student_gender->CurrentValue) {
					case "M":
						$sponsored_student_detail->student_gender->ViewValue = "Male";
						break;
					case "F":
						$sponsored_student_detail->student_gender->ViewValue = "Female";
						break;
					default:
						$sponsored_student_detail->student_gender->ViewValue = $sponsored_student_detail->student_gender->CurrentValue;
				}
			} else {
				$sponsored_student_detail->student_gender->ViewValue = NULL;
			}
			$sponsored_student_detail->student_gender->CssStyle = "";
			$sponsored_student_detail->student_gender->CssClass = "";
			$sponsored_student_detail->student_gender->ViewCustomAttributes = "";

			// student_address
			$sponsored_student_detail->student_address->ViewValue = $sponsored_student_detail->student_address->CurrentValue;
			$sponsored_student_detail->student_address->CssStyle = "";
			$sponsored_student_detail->student_address->CssClass = "";
			$sponsored_student_detail->student_address->ViewCustomAttributes = "";

			// app_submission_year
			if (strval($sponsored_student_detail->app_submission_year->CurrentValue) <> "") {
				$sFilterWrk = "`app_year` = " . ew_AdjustSql($sponsored_student_detail->app_submission_year->CurrentValue) . "";
			$sSqlWrk = "SELECT `app_year` FROM `academic_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sponsored_student_detail->app_submission_year->ViewValue = $rswrk->fields('app_year');
					$rswrk->Close();
				} else {
					$sponsored_student_detail->app_submission_year->ViewValue = $sponsored_student_detail->app_submission_year->CurrentValue;
				}
			} else {
				$sponsored_student_detail->app_submission_year->ViewValue = NULL;
			}
			$sponsored_student_detail->app_submission_year->CssStyle = "";
			$sponsored_student_detail->app_submission_year->CssClass = "";
			$sponsored_student_detail->app_submission_year->ViewCustomAttributes = "";

			// community
			$sponsored_student_detail->community->ViewValue = $sponsored_student_detail->community->CurrentValue;
			$sponsored_student_detail->community->CssStyle = "";
			$sponsored_student_detail->community->CssClass = "";
			$sponsored_student_detail->community->ViewCustomAttributes = "";

			// community_community_id
			$sponsored_student_detail->community_community_id->ViewValue = $sponsored_student_detail->community_community_id->CurrentValue;
			$sponsored_student_detail->community_community_id->CssStyle = "";
			$sponsored_student_detail->community_community_id->CssClass = "";
			$sponsored_student_detail->community_community_id->ViewCustomAttributes = "";

			// programarea_name
			$sponsored_student_detail->programarea_name->ViewValue = $sponsored_student_detail->programarea_name->CurrentValue;
			$sponsored_student_detail->programarea_name->CssStyle = "";
			$sponsored_student_detail->programarea_name->CssClass = "";
			$sponsored_student_detail->programarea_name->ViewCustomAttributes = "";

			// student_resident_programarea_id
			if (strval($sponsored_student_detail->student_resident_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($sponsored_student_detail->student_resident_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sponsored_student_detail->student_resident_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$sponsored_student_detail->student_resident_programarea_id->ViewValue = $sponsored_student_detail->student_resident_programarea_id->CurrentValue;
				}
			} else {
				$sponsored_student_detail->student_resident_programarea_id->ViewValue = NULL;
			}
			$sponsored_student_detail->student_resident_programarea_id->CssStyle = "";
			$sponsored_student_detail->student_resident_programarea_id->CssClass = "";
			$sponsored_student_detail->student_resident_programarea_id->ViewCustomAttributes = "";

			// District
			$sponsored_student_detail->District->ViewValue = $sponsored_student_detail->District->CurrentValue;
			$sponsored_student_detail->District->CssStyle = "";
			$sponsored_student_detail->District->CssClass = "";
			$sponsored_student_detail->District->ViewCustomAttributes = "";

			// community_districts_DistrictID
			$sponsored_student_detail->community_districts_DistrictID->ViewValue = $sponsored_student_detail->community_districts_DistrictID->CurrentValue;
			$sponsored_student_detail->community_districts_DistrictID->CssStyle = "";
			$sponsored_student_detail->community_districts_DistrictID->CssClass = "";
			$sponsored_student_detail->community_districts_DistrictID->ViewCustomAttributes = "";

			// sponsored_student_id
			$sponsored_student_detail->sponsored_student_id->HrefValue = "";
			$sponsored_student_detail->sponsored_student_id->TooltipValue = "";

			// student_firstname
			$sponsored_student_detail->student_firstname->HrefValue = "";
			$sponsored_student_detail->student_firstname->TooltipValue = "";

			// student_middlename
			$sponsored_student_detail->student_middlename->HrefValue = "";
			$sponsored_student_detail->student_middlename->TooltipValue = "";

			// student_lastname
			$sponsored_student_detail->student_lastname->HrefValue = "";
			$sponsored_student_detail->student_lastname->TooltipValue = "";

			// student_telephone_1
			$sponsored_student_detail->student_telephone_1->HrefValue = "";
			$sponsored_student_detail->student_telephone_1->TooltipValue = "";

			// student_telephone_2
			$sponsored_student_detail->student_telephone_2->HrefValue = "";
			$sponsored_student_detail->student_telephone_2->TooltipValue = "";

			// student_dob
			$sponsored_student_detail->student_dob->HrefValue = "";
			$sponsored_student_detail->student_dob->TooltipValue = "";

			// age
			$sponsored_student_detail->age->HrefValue = "";
			$sponsored_student_detail->age->TooltipValue = "";

			// student_gender
			$sponsored_student_detail->student_gender->HrefValue = "";
			$sponsored_student_detail->student_gender->TooltipValue = "";

			// student_address
			$sponsored_student_detail->student_address->HrefValue = "";
			$sponsored_student_detail->student_address->TooltipValue = "";

			// app_submission_year
			$sponsored_student_detail->app_submission_year->HrefValue = "";
			$sponsored_student_detail->app_submission_year->TooltipValue = "";

			// community
			$sponsored_student_detail->community->HrefValue = "";
			$sponsored_student_detail->community->TooltipValue = "";

			// programarea_name
			$sponsored_student_detail->programarea_name->HrefValue = "";
			$sponsored_student_detail->programarea_name->TooltipValue = "";

			// student_resident_programarea_id
			$sponsored_student_detail->student_resident_programarea_id->HrefValue = "";
			$sponsored_student_detail->student_resident_programarea_id->TooltipValue = "";

			// District
			$sponsored_student_detail->District->HrefValue = "";
			$sponsored_student_detail->District->TooltipValue = "";

			// community_districts_DistrictID
			$sponsored_student_detail->community_districts_DistrictID->HrefValue = "";
			$sponsored_student_detail->community_districts_DistrictID->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($sponsored_student_detail->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$sponsored_student_detail->Row_Rendered();
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
