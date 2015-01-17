<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "student_applicantinfo.php" ?>
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
$student_applicant_delete = new cstudent_applicant_delete();
$Page =& $student_applicant_delete;

// Page init
$student_applicant_delete->Page_Init();

// Page main
$student_applicant_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var student_applicant_delete = new ew_Page("student_applicant_delete");

// page properties
student_applicant_delete.PageID = "delete"; // page ID
student_applicant_delete.FormID = "fstudent_applicantdelete"; // form ID
var EW_PAGE_ID = student_applicant_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
student_applicant_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
student_applicant_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
student_applicant_delete.ValidateRequired = false; // no JavaScript validation
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
<?php

// Load records for display
if ($rs = $student_applicant_delete->LoadRecordset())
	$student_applicant_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($student_applicant_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$student_applicant_delete->Page_Terminate("student_applicantlist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $student_applicant->TableCaption() ?><br><br>
<a href="<?php echo $student_applicant->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$student_applicant_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="student_applicant">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($student_applicant_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $student_applicant->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $student_applicant->student_applicant_id->FldCaption() ?></td>
		<td valign="top"><?php echo $student_applicant->app_submission_year->FldCaption() ?></td>
		<td valign="top"><?php echo $student_applicant->student_resident_programarea_id->FldCaption() ?></td>
		<td valign="top"><?php echo $student_applicant->community_community_id->FldCaption() ?></td>
		<td valign="top"><?php echo $student_applicant->app_status->FldCaption() ?></td>
		<td valign="top"><?php echo $student_applicant->app_points->FldCaption() ?></td>
		<td valign="top"><?php echo $student_applicant->app_grant_id->FldCaption() ?></td>
		<td valign="top"><?php echo $student_applicant->student_firstname->FldCaption() ?></td>
		<td valign="top"><?php echo $student_applicant->student_lastname->FldCaption() ?></td>
		<td valign="top"><?php echo $student_applicant->student_gender->FldCaption() ?></td>
		<td valign="top"><?php echo $student_applicant->student_dob->FldCaption() ?></td>
		<td valign="top"><?php echo $student_applicant->sponsored_child_no->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$student_applicant_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$student_applicant_delete->lRecCnt++;

	// Set row properties
	$student_applicant->CssClass = "";
	$student_applicant->CssStyle = "";
	$student_applicant->RowAttrs = array();
	$student_applicant->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$student_applicant_delete->LoadRowValues($rs);

	// Render row
	$student_applicant_delete->RenderRow();
?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td<?php echo $student_applicant->student_applicant_id->CellAttributes() ?>>
<div<?php echo $student_applicant->student_applicant_id->ViewAttributes() ?>><?php echo $student_applicant->student_applicant_id->ListViewValue() ?></div></td>
		<td<?php echo $student_applicant->app_submission_year->CellAttributes() ?>>
<div<?php echo $student_applicant->app_submission_year->ViewAttributes() ?>><?php echo $student_applicant->app_submission_year->ListViewValue() ?></div></td>
		<td<?php echo $student_applicant->student_resident_programarea_id->CellAttributes() ?>>
<div<?php echo $student_applicant->student_resident_programarea_id->ViewAttributes() ?>><?php echo $student_applicant->student_resident_programarea_id->ListViewValue() ?></div></td>
		<td<?php echo $student_applicant->community_community_id->CellAttributes() ?>>
<div<?php echo $student_applicant->community_community_id->ViewAttributes() ?>><?php echo $student_applicant->community_community_id->ListViewValue() ?></div></td>
		<td<?php echo $student_applicant->app_status->CellAttributes() ?>>
<div<?php echo $student_applicant->app_status->ViewAttributes() ?>><?php echo $student_applicant->app_status->ListViewValue() ?></div></td>
		<td<?php echo $student_applicant->app_points->CellAttributes() ?>>
<div<?php echo $student_applicant->app_points->ViewAttributes() ?>><?php echo $student_applicant->app_points->ListViewValue() ?></div></td>
		<td<?php echo $student_applicant->app_grant_id->CellAttributes() ?>>
<div<?php echo $student_applicant->app_grant_id->ViewAttributes() ?>><?php echo $student_applicant->app_grant_id->ListViewValue() ?></div></td>
		<td<?php echo $student_applicant->student_firstname->CellAttributes() ?>>
<div<?php echo $student_applicant->student_firstname->ViewAttributes() ?>><?php echo $student_applicant->student_firstname->ListViewValue() ?></div></td>
		<td<?php echo $student_applicant->student_lastname->CellAttributes() ?>>
<div<?php echo $student_applicant->student_lastname->ViewAttributes() ?>><?php echo $student_applicant->student_lastname->ListViewValue() ?></div></td>
		<td<?php echo $student_applicant->student_gender->CellAttributes() ?>>
<div<?php echo $student_applicant->student_gender->ViewAttributes() ?>><?php echo $student_applicant->student_gender->ListViewValue() ?></div></td>
		<td<?php echo $student_applicant->student_dob->CellAttributes() ?>>
<div<?php echo $student_applicant->student_dob->ViewAttributes() ?>><?php echo $student_applicant->student_dob->ListViewValue() ?></div></td>
		<td<?php echo $student_applicant->sponsored_child_no->CellAttributes() ?>>
<div<?php echo $student_applicant->sponsored_child_no->ViewAttributes() ?>><?php echo $student_applicant->sponsored_child_no->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$student_applicant_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cstudent_applicant_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'student_applicant';

	// Page object name
	var $PageObjName = 'student_applicant_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $student_applicant;
		if ($student_applicant->UseTokenInUrl) $PageUrl .= "t=" . $student_applicant->TableVar . "&"; // Add page token
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
		global $objForm, $student_applicant;
		if ($student_applicant->UseTokenInUrl) {
			if ($objForm)
				return ($student_applicant->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($student_applicant->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstudent_applicant_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (student_applicant)
		$GLOBALS["student_applicant"] = new cstudent_applicant();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'student_applicant', TRUE);

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
		global $student_applicant;

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
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("student_applicantlist.php");
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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $student_applicant;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["student_applicant_id"] <> "") {
			$student_applicant->student_applicant_id->setQueryStringValue($_GET["student_applicant_id"]);
			if (!is_numeric($student_applicant->student_applicant_id->QueryStringValue))
				$this->Page_Terminate("student_applicantlist.php"); // Prevent SQL injection, exit
			$sKey .= $student_applicant->student_applicant_id->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("student_applicantlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("student_applicantlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`student_applicant_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in student_applicant class, student_applicantinfo.php

		$student_applicant->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$student_applicant->CurrentAction = $_POST["a_delete"];
		} else {
			$student_applicant->CurrentAction = "I"; // Display record
		}
		switch ($student_applicant->CurrentAction) {
			case "D": // Delete
				$student_applicant->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($student_applicant->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $student_applicant;
		$DeleteRows = TRUE;
		$sWrkFilter = $student_applicant->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in student_applicant class, student_applicantinfo.php

		$student_applicant->CurrentFilter = $sWrkFilter;
		$sSql = $student_applicant->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();
		$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $student_applicant->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['student_applicant_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($student_applicant->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($student_applicant->CancelMessage <> "") {
				$this->setMessage($student_applicant->CancelMessage);
				$student_applicant->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
			if ($DeleteRows) {
				foreach ($rsold as $row)
					$this->WriteAuditTrailOnDelete($row);
			}
			$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
			$conn->RollbackTrans(); // Rollback changes
			$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteRollback")); // Batch delete rollback
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$student_applicant->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $student_applicant;

		// Call Recordset Selecting event
		$student_applicant->Recordset_Selecting($student_applicant->CurrentFilter);

		// Load List page SQL
		$sSql = $student_applicant->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$student_applicant->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $student_applicant;
		$sFilter = $student_applicant->KeyFilter();

		// Call Row Selecting event
		$student_applicant->Row_Selecting($sFilter);

		// Load SQL based on filter
		$student_applicant->CurrentFilter = $sFilter;
		$sSql = $student_applicant->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$student_applicant->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $student_applicant;
		$student_applicant->student_applicant_id->setDbValue($rs->fields('student_applicant_id'));
		$student_applicant->app_submission_year->setDbValue($rs->fields('app_submission_year'));
		$student_applicant->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
		$student_applicant->community_community_id->setDbValue($rs->fields('community_community_id'));
		$student_applicant->app_status->setDbValue($rs->fields('app_status'));
		$student_applicant->app_points->setDbValue($rs->fields('app_points'));
		$student_applicant->app_grant_id->setDbValue($rs->fields('app_grant_id'));
		$student_applicant->app_amount->setDbValue($rs->fields('app_amount'));
		$student_applicant->student_firstname->setDbValue($rs->fields('student_firstname'));
		$student_applicant->student_middlename->setDbValue($rs->fields('student_middlename'));
		$student_applicant->student_lastname->setDbValue($rs->fields('student_lastname'));
		$student_applicant->student_gender->setDbValue($rs->fields('student_gender'));
		$student_applicant->student_dob->setDbValue($rs->fields('student_dob'));
		$student_applicant->app_mother_name->setDbValue($rs->fields('app_mother_name'));
		$student_applicant->app_mother_isalive->setDbValue($rs->fields('app_mother_isalive'));
		$student_applicant->app_mother_occupation->setDbValue($rs->fields('app_mother_occupation'));
		$student_applicant->app_father_name->setDbValue($rs->fields('app_father_name'));
		$student_applicant->app_father_occupation->setDbValue($rs->fields('app_father_occupation'));
		$student_applicant->app_father_isalive->setDbValue($rs->fields('app_father_isalive'));
		$student_applicant->student_picture->Upload->DbValue = $rs->fields('student_picture');
		$student_applicant->app_guardian_name->setDbValue($rs->fields('app_guardian_name'));
		$student_applicant->app_guardian_relation->setDbValue($rs->fields('app_guardian_relation'));
		$student_applicant->app_guardian_occupation->setDbValue($rs->fields('app_guardian_occupation'));
		$student_applicant->app_referees->setDbValue($rs->fields('app_referees'));
		$student_applicant->sponsored_child_no->setDbValue($rs->fields('sponsored_child_no'));
		$student_applicant->student_grades->setDbValue($rs->fields('student_grades'));
		$student_applicant->student_address->setDbValue($rs->fields('student_address'));
		$student_applicant->student_telephone_1->setDbValue($rs->fields('student_telephone_1'));
		$student_applicant->student_telephone_2->setDbValue($rs->fields('student_telephone_2'));
		$student_applicant->student_admitted_school_id->setDbValue($rs->fields('student_admitted_school_id'));
		$student_applicant->app_primary_school_id->setDbValue($rs->fields('app_primary_school_id'));
		$student_applicant->app_junior_secondary_id->setDbValue($rs->fields('app_junior_secondary_id'));
		$student_applicant->app_scanneddocument->Upload->DbValue = $rs->fields('app_scanneddocument');
		$student_applicant->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $student_applicant;

		// Initialize URLs
		// Call Row_Rendering event

		$student_applicant->Row_Rendering();

		// Common render codes for all row types
		// student_applicant_id

		$student_applicant->student_applicant_id->CellCssStyle = ""; $student_applicant->student_applicant_id->CellCssClass = "";
		$student_applicant->student_applicant_id->CellAttrs = array(); $student_applicant->student_applicant_id->ViewAttrs = array(); $student_applicant->student_applicant_id->EditAttrs = array();

		// app_submission_year
		$student_applicant->app_submission_year->CellCssStyle = ""; $student_applicant->app_submission_year->CellCssClass = "";
		$student_applicant->app_submission_year->CellAttrs = array(); $student_applicant->app_submission_year->ViewAttrs = array(); $student_applicant->app_submission_year->EditAttrs = array();

		// student_resident_programarea_id
		$student_applicant->student_resident_programarea_id->CellCssStyle = ""; $student_applicant->student_resident_programarea_id->CellCssClass = "";
		$student_applicant->student_resident_programarea_id->CellAttrs = array(); $student_applicant->student_resident_programarea_id->ViewAttrs = array(); $student_applicant->student_resident_programarea_id->EditAttrs = array();

		// community_community_id
		$student_applicant->community_community_id->CellCssStyle = ""; $student_applicant->community_community_id->CellCssClass = "";
		$student_applicant->community_community_id->CellAttrs = array(); $student_applicant->community_community_id->ViewAttrs = array(); $student_applicant->community_community_id->EditAttrs = array();

		// app_status
		$student_applicant->app_status->CellCssStyle = ""; $student_applicant->app_status->CellCssClass = "";
		$student_applicant->app_status->CellAttrs = array(); $student_applicant->app_status->ViewAttrs = array(); $student_applicant->app_status->EditAttrs = array();

		// app_points
		$student_applicant->app_points->CellCssStyle = ""; $student_applicant->app_points->CellCssClass = "";
		$student_applicant->app_points->CellAttrs = array(); $student_applicant->app_points->ViewAttrs = array(); $student_applicant->app_points->EditAttrs = array();

		// app_grant_id
		$student_applicant->app_grant_id->CellCssStyle = ""; $student_applicant->app_grant_id->CellCssClass = "";
		$student_applicant->app_grant_id->CellAttrs = array(); $student_applicant->app_grant_id->ViewAttrs = array(); $student_applicant->app_grant_id->EditAttrs = array();

		// student_firstname
		$student_applicant->student_firstname->CellCssStyle = ""; $student_applicant->student_firstname->CellCssClass = "";
		$student_applicant->student_firstname->CellAttrs = array(); $student_applicant->student_firstname->ViewAttrs = array(); $student_applicant->student_firstname->EditAttrs = array();

		// student_lastname
		$student_applicant->student_lastname->CellCssStyle = ""; $student_applicant->student_lastname->CellCssClass = "";
		$student_applicant->student_lastname->CellAttrs = array(); $student_applicant->student_lastname->ViewAttrs = array(); $student_applicant->student_lastname->EditAttrs = array();

		// student_gender
		$student_applicant->student_gender->CellCssStyle = ""; $student_applicant->student_gender->CellCssClass = "";
		$student_applicant->student_gender->CellAttrs = array(); $student_applicant->student_gender->ViewAttrs = array(); $student_applicant->student_gender->EditAttrs = array();

		// student_dob
		$student_applicant->student_dob->CellCssStyle = ""; $student_applicant->student_dob->CellCssClass = "";
		$student_applicant->student_dob->CellAttrs = array(); $student_applicant->student_dob->ViewAttrs = array(); $student_applicant->student_dob->EditAttrs = array();

		// sponsored_child_no
		$student_applicant->sponsored_child_no->CellCssStyle = ""; $student_applicant->sponsored_child_no->CellCssClass = "";
		$student_applicant->sponsored_child_no->CellAttrs = array(); $student_applicant->sponsored_child_no->ViewAttrs = array(); $student_applicant->sponsored_child_no->EditAttrs = array();
		if ($student_applicant->RowType == EW_ROWTYPE_VIEW) { // View row

			// student_applicant_id
			$student_applicant->student_applicant_id->ViewValue = $student_applicant->student_applicant_id->CurrentValue;
			$student_applicant->student_applicant_id->CssStyle = "";
			$student_applicant->student_applicant_id->CssClass = "";
			$student_applicant->student_applicant_id->ViewCustomAttributes = "";

			// app_submission_year
			$student_applicant->app_submission_year->ViewValue = $student_applicant->app_submission_year->CurrentValue;
			if (strval($student_applicant->app_submission_year->CurrentValue) <> "") {
				$sFilterWrk = "`app_year` = " . ew_AdjustSql($student_applicant->app_submission_year->CurrentValue) . "";
			$sSqlWrk = "SELECT `app_year` FROM `academic_year`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "active='ACTIVE'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `app_year` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_submission_year->ViewValue = $rswrk->fields('app_year');
					$rswrk->Close();
				} else {
					$student_applicant->app_submission_year->ViewValue = $student_applicant->app_submission_year->CurrentValue;
				}
			} else {
				$student_applicant->app_submission_year->ViewValue = NULL;
			}
			$student_applicant->app_submission_year->CssStyle = "";
			$student_applicant->app_submission_year->CssClass = "";
			$student_applicant->app_submission_year->ViewCustomAttributes = "";

			// student_resident_programarea_id
			if (strval($student_applicant->student_resident_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($student_applicant->student_resident_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->student_resident_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$student_applicant->student_resident_programarea_id->ViewValue = $student_applicant->student_resident_programarea_id->CurrentValue;
				}
			} else {
				$student_applicant->student_resident_programarea_id->ViewValue = NULL;
			}
			$student_applicant->student_resident_programarea_id->CssStyle = "";
			$student_applicant->student_resident_programarea_id->CssClass = "";
			$student_applicant->student_resident_programarea_id->ViewCustomAttributes = "";

			// community_community_id
			if (strval($student_applicant->community_community_id->CurrentValue) <> "") {
				$sFilterWrk = "`community_id` = " . ew_AdjustSql($student_applicant->community_community_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `community` FROM `community`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->community_community_id->ViewValue = $rswrk->fields('community');
					$rswrk->Close();
				} else {
					$student_applicant->community_community_id->ViewValue = $student_applicant->community_community_id->CurrentValue;
				}
			} else {
				$student_applicant->community_community_id->ViewValue = NULL;
			}
			$student_applicant->community_community_id->CssStyle = "";
			$student_applicant->community_community_id->CssClass = "";
			$student_applicant->community_community_id->ViewCustomAttributes = "";

			// app_status
			$student_applicant->app_status->ViewValue = $student_applicant->app_status->CurrentValue;
			if (strval($student_applicant->app_status->CurrentValue) <> "") {
				$sFilterWrk = "`application_status_id` = " . ew_AdjustSql($student_applicant->app_status->CurrentValue) . "";
			$sSqlWrk = "SELECT `application_status` FROM `application_status`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_status->ViewValue = $rswrk->fields('application_status');
					$rswrk->Close();
				} else {
					$student_applicant->app_status->ViewValue = $student_applicant->app_status->CurrentValue;
				}
			} else {
				$student_applicant->app_status->ViewValue = NULL;
			}
			$student_applicant->app_status->CssStyle = "";
			$student_applicant->app_status->CssClass = "";
			$student_applicant->app_status->ViewCustomAttributes = "";

			// app_points
			$student_applicant->app_points->ViewValue = $student_applicant->app_points->CurrentValue;
			$student_applicant->app_points->CssStyle = "";
			$student_applicant->app_points->CssClass = "";
			$student_applicant->app_points->ViewCustomAttributes = "";

			// app_grant_id
			$student_applicant->app_grant_id->ViewValue = $student_applicant->app_grant_id->CurrentValue;
			if (strval($student_applicant->app_grant_id->CurrentValue) <> "") {
				$sFilterWrk = "`grant_package_id` = " . ew_AdjustSql($student_applicant->app_grant_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `grant_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_grant_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_grant_id->ViewValue = $student_applicant->app_grant_id->CurrentValue;
				}
			} else {
				$student_applicant->app_grant_id->ViewValue = NULL;
			}
			$student_applicant->app_grant_id->CssStyle = "";
			$student_applicant->app_grant_id->CssClass = "";
			$student_applicant->app_grant_id->ViewCustomAttributes = "";

			// app_amount
			$student_applicant->app_amount->ViewValue = $student_applicant->app_amount->CurrentValue;
			$student_applicant->app_amount->CssStyle = "";
			$student_applicant->app_amount->CssClass = "";
			$student_applicant->app_amount->ViewCustomAttributes = "";

			// student_firstname
			$student_applicant->student_firstname->ViewValue = $student_applicant->student_firstname->CurrentValue;
			$student_applicant->student_firstname->CssStyle = "";
			$student_applicant->student_firstname->CssClass = "";
			$student_applicant->student_firstname->ViewCustomAttributes = "";

			// student_middlename
			$student_applicant->student_middlename->ViewValue = $student_applicant->student_middlename->CurrentValue;
			$student_applicant->student_middlename->CssStyle = "";
			$student_applicant->student_middlename->CssClass = "";
			$student_applicant->student_middlename->ViewCustomAttributes = "";

			// student_lastname
			$student_applicant->student_lastname->ViewValue = $student_applicant->student_lastname->CurrentValue;
			$student_applicant->student_lastname->CssStyle = "";
			$student_applicant->student_lastname->CssClass = "";
			$student_applicant->student_lastname->ViewCustomAttributes = "";

			// student_gender
			if (strval($student_applicant->student_gender->CurrentValue) <> "") {
				switch ($student_applicant->student_gender->CurrentValue) {
					case "M":
						$student_applicant->student_gender->ViewValue = "Male";
						break;
					case "F":
						$student_applicant->student_gender->ViewValue = "Female";
						break;
					default:
						$student_applicant->student_gender->ViewValue = $student_applicant->student_gender->CurrentValue;
				}
			} else {
				$student_applicant->student_gender->ViewValue = NULL;
			}
			$student_applicant->student_gender->CssStyle = "";
			$student_applicant->student_gender->CssClass = "";
			$student_applicant->student_gender->ViewCustomAttributes = "";

			// student_dob
			$student_applicant->student_dob->ViewValue = $student_applicant->student_dob->CurrentValue;
			$student_applicant->student_dob->ViewValue = ew_FormatDateTime($student_applicant->student_dob->ViewValue, 7);
			$student_applicant->student_dob->CssStyle = "";
			$student_applicant->student_dob->CssClass = "";
			$student_applicant->student_dob->ViewCustomAttributes = "";

			// app_mother_name
			$student_applicant->app_mother_name->ViewValue = $student_applicant->app_mother_name->CurrentValue;
			$student_applicant->app_mother_name->CssStyle = "";
			$student_applicant->app_mother_name->CssClass = "";
			$student_applicant->app_mother_name->ViewCustomAttributes = "";

			// app_mother_isalive
			if (strval($student_applicant->app_mother_isalive->CurrentValue) <> "") {
				switch ($student_applicant->app_mother_isalive->CurrentValue) {
					case "1":
						$student_applicant->app_mother_isalive->ViewValue = "Alive";
						break;
					case "0":
						$student_applicant->app_mother_isalive->ViewValue = "Deceased";
						break;
					default:
						$student_applicant->app_mother_isalive->ViewValue = $student_applicant->app_mother_isalive->CurrentValue;
				}
			} else {
				$student_applicant->app_mother_isalive->ViewValue = NULL;
			}
			$student_applicant->app_mother_isalive->CssStyle = "";
			$student_applicant->app_mother_isalive->CssClass = "";
			$student_applicant->app_mother_isalive->ViewCustomAttributes = "";

			// app_mother_occupation
			if (strval($student_applicant->app_mother_occupation->CurrentValue) <> "") {
				$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($student_applicant->app_mother_occupation->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_mother_occupation->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_mother_occupation->ViewValue = $student_applicant->app_mother_occupation->CurrentValue;
				}
			} else {
				$student_applicant->app_mother_occupation->ViewValue = NULL;
			}
			$student_applicant->app_mother_occupation->CssStyle = "";
			$student_applicant->app_mother_occupation->CssClass = "";
			$student_applicant->app_mother_occupation->ViewCustomAttributes = "";

			// app_father_name
			$student_applicant->app_father_name->ViewValue = $student_applicant->app_father_name->CurrentValue;
			$student_applicant->app_father_name->CssStyle = "";
			$student_applicant->app_father_name->CssClass = "";
			$student_applicant->app_father_name->ViewCustomAttributes = "";

			// app_father_occupation
			if (strval($student_applicant->app_father_occupation->CurrentValue) <> "") {
				$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($student_applicant->app_father_occupation->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_father_occupation->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_father_occupation->ViewValue = $student_applicant->app_father_occupation->CurrentValue;
				}
			} else {
				$student_applicant->app_father_occupation->ViewValue = NULL;
			}
			$student_applicant->app_father_occupation->CssStyle = "";
			$student_applicant->app_father_occupation->CssClass = "";
			$student_applicant->app_father_occupation->ViewCustomAttributes = "";

			// app_father_isalive
			if (strval($student_applicant->app_father_isalive->CurrentValue) <> "") {
				switch ($student_applicant->app_father_isalive->CurrentValue) {
					case "1":
						$student_applicant->app_father_isalive->ViewValue = "Alive";
						break;
					case "0":
						$student_applicant->app_father_isalive->ViewValue = "Deceased";
						break;
					default:
						$student_applicant->app_father_isalive->ViewValue = $student_applicant->app_father_isalive->CurrentValue;
				}
			} else {
				$student_applicant->app_father_isalive->ViewValue = NULL;
			}
			$student_applicant->app_father_isalive->CssStyle = "";
			$student_applicant->app_father_isalive->CssClass = "";
			$student_applicant->app_father_isalive->ViewCustomAttributes = "";

			// app_guardian_name
			$student_applicant->app_guardian_name->ViewValue = $student_applicant->app_guardian_name->CurrentValue;
			$student_applicant->app_guardian_name->CssStyle = "";
			$student_applicant->app_guardian_name->CssClass = "";
			$student_applicant->app_guardian_name->ViewCustomAttributes = "";

			// app_guardian_relation
			if (strval($student_applicant->app_guardian_relation->CurrentValue) <> "") {
				switch ($student_applicant->app_guardian_relation->CurrentValue) {
					case "NA":
						$student_applicant->app_guardian_relation->ViewValue = "not applicable";
						break;
					case "grandparent":
						$student_applicant->app_guardian_relation->ViewValue = "grandparent";
						break;
					case "grandparent":
						$student_applicant->app_guardian_relation->ViewValue = "grandparent";
						break;
					case "aunt":
						$student_applicant->app_guardian_relation->ViewValue = "aunt";
						break;
					case "sibling":
						$student_applicant->app_guardian_relation->ViewValue = "sibling";
						break;
					case "cousin":
						$student_applicant->app_guardian_relation->ViewValue = "cousin";
						break;
					case "in law":
						$student_applicant->app_guardian_relation->ViewValue = "in law";
						break;
					case "father family":
						$student_applicant->app_guardian_relation->ViewValue = "father family";
						break;
					case "mother family":
						$student_applicant->app_guardian_relation->ViewValue = "mother family";
						break;
					case "extended family":
						$student_applicant->app_guardian_relation->ViewValue = "extended family";
						break;
					case "other relation":
						$student_applicant->app_guardian_relation->ViewValue = "other relation";
						break;
					default:
						$student_applicant->app_guardian_relation->ViewValue = $student_applicant->app_guardian_relation->CurrentValue;
				}
			} else {
				$student_applicant->app_guardian_relation->ViewValue = NULL;
			}
			$student_applicant->app_guardian_relation->CssStyle = "";
			$student_applicant->app_guardian_relation->CssClass = "";
			$student_applicant->app_guardian_relation->ViewCustomAttributes = "";

			// app_guardian_occupation
			if (strval($student_applicant->app_guardian_occupation->CurrentValue) <> "") {
				$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($student_applicant->app_guardian_occupation->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_guardian_occupation->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_guardian_occupation->ViewValue = $student_applicant->app_guardian_occupation->CurrentValue;
				}
			} else {
				$student_applicant->app_guardian_occupation->ViewValue = NULL;
			}
			$student_applicant->app_guardian_occupation->CssStyle = "";
			$student_applicant->app_guardian_occupation->CssClass = "";
			$student_applicant->app_guardian_occupation->ViewCustomAttributes = "";

			// app_referees
			$student_applicant->app_referees->ViewValue = $student_applicant->app_referees->CurrentValue;
			$student_applicant->app_referees->CssStyle = "";
			$student_applicant->app_referees->CssClass = "";
			$student_applicant->app_referees->ViewCustomAttributes = "";

			// sponsored_child_no
			$student_applicant->sponsored_child_no->ViewValue = $student_applicant->sponsored_child_no->CurrentValue;
			$student_applicant->sponsored_child_no->CssStyle = "";
			$student_applicant->sponsored_child_no->CssClass = "";
			$student_applicant->sponsored_child_no->ViewCustomAttributes = "";

			// student_grades
			$student_applicant->student_grades->ViewValue = $student_applicant->student_grades->CurrentValue;
			$student_applicant->student_grades->CssStyle = "";
			$student_applicant->student_grades->CssClass = "";
			$student_applicant->student_grades->ViewCustomAttributes = "";

			// student_address
			$student_applicant->student_address->ViewValue = $student_applicant->student_address->CurrentValue;
			$student_applicant->student_address->CssStyle = "";
			$student_applicant->student_address->CssClass = "";
			$student_applicant->student_address->ViewCustomAttributes = "";

			// student_telephone_1
			$student_applicant->student_telephone_1->ViewValue = $student_applicant->student_telephone_1->CurrentValue;
			$student_applicant->student_telephone_1->CssStyle = "";
			$student_applicant->student_telephone_1->CssClass = "";
			$student_applicant->student_telephone_1->ViewCustomAttributes = "";

			// student_telephone_2
			$student_applicant->student_telephone_2->ViewValue = $student_applicant->student_telephone_2->CurrentValue;
			$student_applicant->student_telephone_2->CssStyle = "";
			$student_applicant->student_telephone_2->CssClass = "";
			$student_applicant->student_telephone_2->ViewCustomAttributes = "";

			// student_admitted_school_id
			if (strval($student_applicant->student_admitted_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($student_applicant->student_admitted_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->student_admitted_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$student_applicant->student_admitted_school_id->ViewValue = $student_applicant->student_admitted_school_id->CurrentValue;
				}
			} else {
				$student_applicant->student_admitted_school_id->ViewValue = NULL;
			}
			$student_applicant->student_admitted_school_id->CssStyle = "";
			$student_applicant->student_admitted_school_id->CssClass = "";
			$student_applicant->student_admitted_school_id->ViewCustomAttributes = "";

			// app_primary_school_id
			if (strval($student_applicant->app_primary_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_id` = " . ew_AdjustSql($student_applicant->app_primary_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_name` FROM `applicant_school`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`applicant_school_type`=1" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_primary_school_id->ViewValue = $rswrk->fields('applicant_school_name');
					$rswrk->Close();
				} else {
					$student_applicant->app_primary_school_id->ViewValue = $student_applicant->app_primary_school_id->CurrentValue;
				}
			} else {
				$student_applicant->app_primary_school_id->ViewValue = NULL;
			}
			$student_applicant->app_primary_school_id->CssStyle = "";
			$student_applicant->app_primary_school_id->CssClass = "";
			$student_applicant->app_primary_school_id->ViewCustomAttributes = "";

			// app_junior_secondary_id
			if (strval($student_applicant->app_junior_secondary_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_id` = " . ew_AdjustSql($student_applicant->app_junior_secondary_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_name` FROM `applicant_school`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`applicant_school_type`=2" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_junior_secondary_id->ViewValue = $rswrk->fields('applicant_school_name');
					$rswrk->Close();
				} else {
					$student_applicant->app_junior_secondary_id->ViewValue = $student_applicant->app_junior_secondary_id->CurrentValue;
				}
			} else {
				$student_applicant->app_junior_secondary_id->ViewValue = NULL;
			}
			$student_applicant->app_junior_secondary_id->CssStyle = "";
			$student_applicant->app_junior_secondary_id->CssClass = "";
			$student_applicant->app_junior_secondary_id->ViewCustomAttributes = "";

			// app_scanneddocument
			if (!ew_Empty($student_applicant->app_scanneddocument->Upload->DbValue)) {
				$student_applicant->app_scanneddocument->ViewValue = $student_applicant->app_scanneddocument->Upload->DbValue;
			} else {
				$student_applicant->app_scanneddocument->ViewValue = "";
			}
			$student_applicant->app_scanneddocument->CssStyle = "";
			$student_applicant->app_scanneddocument->CssClass = "";
			$student_applicant->app_scanneddocument->ViewCustomAttributes = "";

			// group_id
			$student_applicant->group_id->ViewValue = $student_applicant->group_id->CurrentValue;
			$student_applicant->group_id->CssStyle = "";
			$student_applicant->group_id->CssClass = "";
			$student_applicant->group_id->ViewCustomAttributes = "";

			// student_applicant_id
			$student_applicant->student_applicant_id->HrefValue = "";
			$student_applicant->student_applicant_id->TooltipValue = "";

			// app_submission_year
			$student_applicant->app_submission_year->HrefValue = "";
			$student_applicant->app_submission_year->TooltipValue = "";

			// student_resident_programarea_id
			$student_applicant->student_resident_programarea_id->HrefValue = "";
			$student_applicant->student_resident_programarea_id->TooltipValue = "";

			// community_community_id
			$student_applicant->community_community_id->HrefValue = "";
			$student_applicant->community_community_id->TooltipValue = "";

			// app_status
			$student_applicant->app_status->HrefValue = "";
			$student_applicant->app_status->TooltipValue = "";

			// app_points
			$student_applicant->app_points->HrefValue = "";
			$student_applicant->app_points->TooltipValue = "";

			// app_grant_id
			$student_applicant->app_grant_id->HrefValue = "";
			$student_applicant->app_grant_id->TooltipValue = "";

			// student_firstname
			$student_applicant->student_firstname->HrefValue = "";
			$student_applicant->student_firstname->TooltipValue = "";

			// student_lastname
			$student_applicant->student_lastname->HrefValue = "";
			$student_applicant->student_lastname->TooltipValue = "";

			// student_gender
			$student_applicant->student_gender->HrefValue = "";
			$student_applicant->student_gender->TooltipValue = "";

			// student_dob
			$student_applicant->student_dob->HrefValue = "";
			$student_applicant->student_dob->TooltipValue = "";

			// sponsored_child_no
			$student_applicant->sponsored_child_no->HrefValue = "";
			$student_applicant->sponsored_child_no->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($student_applicant->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$student_applicant->Row_Rendered();
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'student_applicant';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $student_applicant;
		$table = 'student_applicant';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['student_applicant_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $student_applicant->fields) && $student_applicant->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($student_applicant->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					$oldvalue = "<MEMO>"; // Memo field
				} elseif ($student_applicant->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$oldvalue = "<XML>"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
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
