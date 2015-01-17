<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "school_attendanceinfo.php" ?>
<?php include "sponsored_studentinfo.php" ?>
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
$school_attendance_delete = new cschool_attendance_delete();
$Page =& $school_attendance_delete;

// Page init
$school_attendance_delete->Page_Init();

// Page main
$school_attendance_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var school_attendance_delete = new ew_Page("school_attendance_delete");

// page properties
school_attendance_delete.PageID = "delete"; // page ID
school_attendance_delete.FormID = "fschool_attendancedelete"; // form ID
var EW_PAGE_ID = school_attendance_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
school_attendance_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
school_attendance_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
school_attendance_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $school_attendance_delete->LoadRecordset())
	$school_attendance_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($school_attendance_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$school_attendance_delete->Page_Terminate("school_attendancelist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $school_attendance->TableCaption() ?><br><br>
<a href="<?php echo $school_attendance->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$school_attendance_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="school_attendance">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($school_attendance_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $school_attendance->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $school_attendance->start_date->FldCaption() ?></td>
		<td valign="top"><?php echo $school_attendance->end_date->FldCaption() ?></td>
		<td valign="top"><?php echo $school_attendance->schools_school_id->FldCaption() ?></td>
		<td valign="top"><?php echo $school_attendance->entry_level->FldCaption() ?></td>
		<td valign="top"><?php echo $school_attendance->sponsored_student_sponsored_student_id->FldCaption() ?></td>
		<td valign="top"><?php echo $school_attendance->program->FldCaption() ?></td>
		<td valign="top"><?php echo $school_attendance->attendance_type->FldCaption() ?></td>
		<td valign="top"><?php echo $school_attendance->group_id->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$school_attendance_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$school_attendance_delete->lRecCnt++;

	// Set row properties
	$school_attendance->CssClass = "";
	$school_attendance->CssStyle = "";
	$school_attendance->RowAttrs = array();
	$school_attendance->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$school_attendance_delete->LoadRowValues($rs);

	// Render row
	$school_attendance_delete->RenderRow();
?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td<?php echo $school_attendance->start_date->CellAttributes() ?>>
<div<?php echo $school_attendance->start_date->ViewAttributes() ?>><?php echo $school_attendance->start_date->ListViewValue() ?></div></td>
		<td<?php echo $school_attendance->end_date->CellAttributes() ?>>
<div<?php echo $school_attendance->end_date->ViewAttributes() ?>><?php echo $school_attendance->end_date->ListViewValue() ?></div></td>
		<td<?php echo $school_attendance->schools_school_id->CellAttributes() ?>>
<div<?php echo $school_attendance->schools_school_id->ViewAttributes() ?>><?php echo $school_attendance->schools_school_id->ListViewValue() ?></div></td>
		<td<?php echo $school_attendance->entry_level->CellAttributes() ?>>
<div<?php echo $school_attendance->entry_level->ViewAttributes() ?>><?php echo $school_attendance->entry_level->ListViewValue() ?></div></td>
		<td<?php echo $school_attendance->sponsored_student_sponsored_student_id->CellAttributes() ?>>
<div<?php echo $school_attendance->sponsored_student_sponsored_student_id->ViewAttributes() ?>><?php echo $school_attendance->sponsored_student_sponsored_student_id->ListViewValue() ?></div></td>
		<td<?php echo $school_attendance->program->CellAttributes() ?>>
<div<?php echo $school_attendance->program->ViewAttributes() ?>><?php echo $school_attendance->program->ListViewValue() ?></div></td>
		<td<?php echo $school_attendance->attendance_type->CellAttributes() ?>>
<div<?php echo $school_attendance->attendance_type->ViewAttributes() ?>><?php echo $school_attendance->attendance_type->ListViewValue() ?></div></td>
		<td<?php echo $school_attendance->group_id->CellAttributes() ?>>
<div<?php echo $school_attendance->group_id->ViewAttributes() ?>><?php echo $school_attendance->group_id->ListViewValue() ?></div></td>
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
$school_attendance_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cschool_attendance_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'school_attendance';

	// Page object name
	var $PageObjName = 'school_attendance_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $school_attendance;
		if ($school_attendance->UseTokenInUrl) $PageUrl .= "t=" . $school_attendance->TableVar . "&"; // Add page token
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
		global $objForm, $school_attendance;
		if ($school_attendance->UseTokenInUrl) {
			if ($objForm)
				return ($school_attendance->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($school_attendance->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cschool_attendance_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (school_attendance)
		$GLOBALS["school_attendance"] = new cschool_attendance();

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'school_attendance', TRUE);

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
		global $school_attendance;

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
			$this->Page_Terminate("school_attendancelist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("school_attendancelist.php");
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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $school_attendance;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["school_attendance_id"] <> "") {
			$school_attendance->school_attendance_id->setQueryStringValue($_GET["school_attendance_id"]);
			if (!is_numeric($school_attendance->school_attendance_id->QueryStringValue))
				$this->Page_Terminate("school_attendancelist.php"); // Prevent SQL injection, exit
			$sKey .= $school_attendance->school_attendance_id->QueryStringValue;
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
			$this->Page_Terminate("school_attendancelist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("school_attendancelist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`school_attendance_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in school_attendance class, school_attendanceinfo.php

		$school_attendance->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$school_attendance->CurrentAction = $_POST["a_delete"];
		} else {
			$school_attendance->CurrentAction = "I"; // Display record
		}
		switch ($school_attendance->CurrentAction) {
			case "D": // Delete
				$school_attendance->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($school_attendance->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $school_attendance;
		$DeleteRows = TRUE;
		$sWrkFilter = $school_attendance->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in school_attendance class, school_attendanceinfo.php

		$school_attendance->CurrentFilter = $sWrkFilter;
		$sSql = $school_attendance->SQL();
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
				$DeleteRows = $school_attendance->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['school_attendance_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($school_attendance->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($school_attendance->CancelMessage <> "") {
				$this->setMessage($school_attendance->CancelMessage);
				$school_attendance->CancelMessage = "";
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
				$school_attendance->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $school_attendance;

		// Call Recordset Selecting event
		$school_attendance->Recordset_Selecting($school_attendance->CurrentFilter);

		// Load List page SQL
		$sSql = $school_attendance->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$school_attendance->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $school_attendance;
		$sFilter = $school_attendance->KeyFilter();

		// Call Row Selecting event
		$school_attendance->Row_Selecting($sFilter);

		// Load SQL based on filter
		$school_attendance->CurrentFilter = $sFilter;
		$sSql = $school_attendance->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$school_attendance->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $school_attendance;
		$school_attendance->school_attendance_id->setDbValue($rs->fields('school_attendance_id'));
		$school_attendance->start_date->setDbValue($rs->fields('start_date'));
		$school_attendance->end_date->setDbValue($rs->fields('end_date'));
		$school_attendance->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$school_attendance->entry_level->setDbValue($rs->fields('entry_level'));
		$school_attendance->entry_class->setDbValue($rs->fields('entry_class'));
		$school_attendance->sponsored_student_sponsored_student_id->setDbValue($rs->fields('sponsored_student_sponsored_student_id'));
		$school_attendance->program->setDbValue($rs->fields('program'));
		$school_attendance->attendance_type->setDbValue($rs->fields('attendance_type'));
		$school_attendance->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $school_attendance;

		// Initialize URLs
		// Call Row_Rendering event

		$school_attendance->Row_Rendering();

		// Common render codes for all row types
		// start_date

		$school_attendance->start_date->CellCssStyle = ""; $school_attendance->start_date->CellCssClass = "";
		$school_attendance->start_date->CellAttrs = array(); $school_attendance->start_date->ViewAttrs = array(); $school_attendance->start_date->EditAttrs = array();

		// end_date
		$school_attendance->end_date->CellCssStyle = ""; $school_attendance->end_date->CellCssClass = "";
		$school_attendance->end_date->CellAttrs = array(); $school_attendance->end_date->ViewAttrs = array(); $school_attendance->end_date->EditAttrs = array();

		// schools_school_id
		$school_attendance->schools_school_id->CellCssStyle = ""; $school_attendance->schools_school_id->CellCssClass = "";
		$school_attendance->schools_school_id->CellAttrs = array(); $school_attendance->schools_school_id->ViewAttrs = array(); $school_attendance->schools_school_id->EditAttrs = array();

		// entry_level
		$school_attendance->entry_level->CellCssStyle = ""; $school_attendance->entry_level->CellCssClass = "";
		$school_attendance->entry_level->CellAttrs = array(); $school_attendance->entry_level->ViewAttrs = array(); $school_attendance->entry_level->EditAttrs = array();

		// sponsored_student_sponsored_student_id
		$school_attendance->sponsored_student_sponsored_student_id->CellCssStyle = ""; $school_attendance->sponsored_student_sponsored_student_id->CellCssClass = "";
		$school_attendance->sponsored_student_sponsored_student_id->CellAttrs = array(); $school_attendance->sponsored_student_sponsored_student_id->ViewAttrs = array(); $school_attendance->sponsored_student_sponsored_student_id->EditAttrs = array();

		// program
		$school_attendance->program->CellCssStyle = ""; $school_attendance->program->CellCssClass = "";
		$school_attendance->program->CellAttrs = array(); $school_attendance->program->ViewAttrs = array(); $school_attendance->program->EditAttrs = array();

		// attendance_type
		$school_attendance->attendance_type->CellCssStyle = ""; $school_attendance->attendance_type->CellCssClass = "";
		$school_attendance->attendance_type->CellAttrs = array(); $school_attendance->attendance_type->ViewAttrs = array(); $school_attendance->attendance_type->EditAttrs = array();

		// group_id
		$school_attendance->group_id->CellCssStyle = ""; $school_attendance->group_id->CellCssClass = "";
		$school_attendance->group_id->CellAttrs = array(); $school_attendance->group_id->ViewAttrs = array(); $school_attendance->group_id->EditAttrs = array();
		if ($school_attendance->RowType == EW_ROWTYPE_VIEW) { // View row

			// school_attendance_id
			$school_attendance->school_attendance_id->ViewValue = $school_attendance->school_attendance_id->CurrentValue;
			$school_attendance->school_attendance_id->CssStyle = "";
			$school_attendance->school_attendance_id->CssClass = "";
			$school_attendance->school_attendance_id->ViewCustomAttributes = "";

			// start_date
			$school_attendance->start_date->ViewValue = $school_attendance->start_date->CurrentValue;
			$school_attendance->start_date->ViewValue = ew_FormatDateTime($school_attendance->start_date->ViewValue, 7);
			$school_attendance->start_date->CssStyle = "";
			$school_attendance->start_date->CssClass = "";
			$school_attendance->start_date->ViewCustomAttributes = "";

			// end_date
			$school_attendance->end_date->ViewValue = $school_attendance->end_date->CurrentValue;
			$school_attendance->end_date->ViewValue = ew_FormatDateTime($school_attendance->end_date->ViewValue, 7);
			$school_attendance->end_date->CssStyle = "";
			$school_attendance->end_date->CssClass = "";
			$school_attendance->end_date->ViewCustomAttributes = "";

			// schools_school_id
			if (strval($school_attendance->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($school_attendance->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$school_attendance->schools_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$school_attendance->schools_school_id->ViewValue = $school_attendance->schools_school_id->CurrentValue;
				}
			} else {
				$school_attendance->schools_school_id->ViewValue = NULL;
			}
			$school_attendance->schools_school_id->CssStyle = "";
			$school_attendance->schools_school_id->CssClass = "";
			$school_attendance->schools_school_id->ViewCustomAttributes = "";

			// entry_level
			if (strval($school_attendance->entry_level->CurrentValue) <> "") {
				switch ($school_attendance->entry_level->CurrentValue) {
					case "SSS":
						$school_attendance->entry_level->ViewValue = "SSS";
						break;
					case "TERTIARY":
						$school_attendance->entry_level->ViewValue = "TERTIARY";
						break;
					case "JSS":
						$school_attendance->entry_level->ViewValue = "JSS";
						break;
					case "PRIMARY":
						$school_attendance->entry_level->ViewValue = "PRIMARY";
						break;
					default:
						$school_attendance->entry_level->ViewValue = $school_attendance->entry_level->CurrentValue;
				}
			} else {
				$school_attendance->entry_level->ViewValue = NULL;
			}
			$school_attendance->entry_level->CssStyle = "";
			$school_attendance->entry_level->CssClass = "";
			$school_attendance->entry_level->ViewCustomAttributes = "";

			// entry_class
			$school_attendance->entry_class->ViewValue = $school_attendance->entry_class->CurrentValue;
			$school_attendance->entry_class->CssStyle = "";
			$school_attendance->entry_class->CssClass = "";
			$school_attendance->entry_class->ViewCustomAttributes = "";

			// sponsored_student_sponsored_student_id
			if (strval($school_attendance->sponsored_student_sponsored_student_id->CurrentValue) <> "") {
				$sFilterWrk = "`sponsored_student_id` = " . ew_AdjustSql($school_attendance->sponsored_student_sponsored_student_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `student_lastname`, `student_firstname` FROM `sponsored_student`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$school_attendance->sponsored_student_sponsored_student_id->ViewValue = $rswrk->fields('student_lastname');
					$school_attendance->sponsored_student_sponsored_student_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('student_firstname');
					$rswrk->Close();
				} else {
					$school_attendance->sponsored_student_sponsored_student_id->ViewValue = $school_attendance->sponsored_student_sponsored_student_id->CurrentValue;
				}
			} else {
				$school_attendance->sponsored_student_sponsored_student_id->ViewValue = NULL;
			}
			$school_attendance->sponsored_student_sponsored_student_id->CssStyle = "";
			$school_attendance->sponsored_student_sponsored_student_id->CssClass = "";
			$school_attendance->sponsored_student_sponsored_student_id->ViewCustomAttributes = "";

			// program
			$school_attendance->program->ViewValue = $school_attendance->program->CurrentValue;
			$school_attendance->program->CssStyle = "";
			$school_attendance->program->CssClass = "";
			$school_attendance->program->ViewCustomAttributes = "";

			// attendance_type
			if (strval($school_attendance->attendance_type->CurrentValue) <> "") {
				switch ($school_attendance->attendance_type->CurrentValue) {
					case "BOARDER":
						$school_attendance->attendance_type->ViewValue = "BOARDER";
						break;
					case "DAY":
						$school_attendance->attendance_type->ViewValue = "DAY";
						break;
					default:
						$school_attendance->attendance_type->ViewValue = $school_attendance->attendance_type->CurrentValue;
				}
			} else {
				$school_attendance->attendance_type->ViewValue = NULL;
			}
			$school_attendance->attendance_type->CssStyle = "";
			$school_attendance->attendance_type->CssClass = "";
			$school_attendance->attendance_type->ViewCustomAttributes = "";

			// group_id
			$school_attendance->group_id->ViewValue = $school_attendance->group_id->CurrentValue;
			$school_attendance->group_id->CssStyle = "";
			$school_attendance->group_id->CssClass = "";
			$school_attendance->group_id->ViewCustomAttributes = "";

			// start_date
			$school_attendance->start_date->HrefValue = "";
			$school_attendance->start_date->TooltipValue = "";

			// end_date
			$school_attendance->end_date->HrefValue = "";
			$school_attendance->end_date->TooltipValue = "";

			// schools_school_id
			$school_attendance->schools_school_id->HrefValue = "";
			$school_attendance->schools_school_id->TooltipValue = "";

			// entry_level
			$school_attendance->entry_level->HrefValue = "";
			$school_attendance->entry_level->TooltipValue = "";

			// sponsored_student_sponsored_student_id
			$school_attendance->sponsored_student_sponsored_student_id->HrefValue = "";
			$school_attendance->sponsored_student_sponsored_student_id->TooltipValue = "";

			// program
			$school_attendance->program->HrefValue = "";
			$school_attendance->program->TooltipValue = "";

			// attendance_type
			$school_attendance->attendance_type->HrefValue = "";
			$school_attendance->attendance_type->TooltipValue = "";

			// group_id
			$school_attendance->group_id->HrefValue = "";
			$school_attendance->group_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($school_attendance->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$school_attendance->Row_Rendered();
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'school_attendance';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $school_attendance;
		$table = 'school_attendance';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['school_attendance_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $school_attendance->fields) && $school_attendance->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($school_attendance->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					$oldvalue = "<MEMO>"; // Memo field
				} elseif ($school_attendance->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
