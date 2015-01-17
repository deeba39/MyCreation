<?php

// Global variable for table object
$school_attendance = NULL;

//
// Table class for school_attendance
//
class cschool_attendance {
	var $TableVar = 'school_attendance';
	var $TableName = 'school_attendance';
	var $TableType = 'TABLE';
	var $school_attendance_id;
	var $start_date;
	var $end_date;
	var $schools_school_id;
	var $entry_level;
	var $entry_class;
	var $sponsored_student_sponsored_student_id;
	var $program;
	var $attendance_type;
	var $group_id;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message

	//
	// Table class constructor
	//
	function cschool_attendance() {
		global $Language;

		// school_attendance_id
		$this->school_attendance_id = new cField('school_attendance', 'school_attendance', 'x_school_attendance_id', 'school_attendance_id', '`school_attendance_id`', 3, -1, FALSE, '`school_attendance_id`', FALSE);
		$this->school_attendance_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['school_attendance_id'] =& $this->school_attendance_id;

		// start_date
		$this->start_date = new cField('school_attendance', 'school_attendance', 'x_start_date', 'start_date', '`start_date`', 135, 7, FALSE, '`start_date`', FALSE);
		$this->start_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['start_date'] =& $this->start_date;

		// end_date
		$this->end_date = new cField('school_attendance', 'school_attendance', 'x_end_date', 'end_date', '`end_date`', 135, 7, FALSE, '`end_date`', FALSE);
		$this->end_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['end_date'] =& $this->end_date;

		// schools_school_id
		$this->schools_school_id = new cField('school_attendance', 'school_attendance', 'x_schools_school_id', 'schools_school_id', '`schools_school_id`', 3, -1, FALSE, '`schools_school_id`', FALSE);
		$this->schools_school_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['schools_school_id'] =& $this->schools_school_id;

		// entry_level
		$this->entry_level = new cField('school_attendance', 'school_attendance', 'x_entry_level', 'entry_level', '`entry_level`', 202, -1, FALSE, '`entry_level`', FALSE);
		$this->fields['entry_level'] =& $this->entry_level;

		// entry_class
		$this->entry_class = new cField('school_attendance', 'school_attendance', 'x_entry_class', 'entry_class', '`entry_class`', 3, -1, FALSE, '`entry_class`', FALSE);
		$this->entry_class->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['entry_class'] =& $this->entry_class;

		// sponsored_student_sponsored_student_id
		$this->sponsored_student_sponsored_student_id = new cField('school_attendance', 'school_attendance', 'x_sponsored_student_sponsored_student_id', 'sponsored_student_sponsored_student_id', '`sponsored_student_sponsored_student_id`', 3, -1, FALSE, '`sponsored_student_sponsored_student_id`', FALSE);
		$this->sponsored_student_sponsored_student_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sponsored_student_sponsored_student_id'] =& $this->sponsored_student_sponsored_student_id;

		// program
		$this->program = new cField('school_attendance', 'school_attendance', 'x_program', 'program', '`program`', 200, -1, FALSE, '`program`', FALSE);
		$this->fields['program'] =& $this->program;

		// attendance_type
		$this->attendance_type = new cField('school_attendance', 'school_attendance', 'x_attendance_type', 'attendance_type', '`attendance_type`', 202, -1, FALSE, '`attendance_type`', FALSE);
		$this->fields['attendance_type'] =& $this->attendance_type;

		// group_id
		$this->group_id = new cField('school_attendance', 'school_attendance', 'x_group_id', 'group_id', '`group_id`', 3, -1, FALSE, '`group_id`', FALSE);
		$this->group_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['group_id'] =& $this->group_id;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "school_attendance_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function getMasterFilter() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_FILTER];
	}

	function setMasterFilter($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_FILTER] = $v;
	}

	// Session detail WHERE clause
	function getDetailFilter() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_FILTER];
	}

	function setDetailFilter($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_FILTER] = $v;
	}

	// Master filter
	function SqlMasterFilter_sponsored_student() {
		return "`sponsored_student_id`=@sponsored_student_id@";
	}

	// Detail filter
	function SqlDetailFilter_sponsored_student() {
		return "`sponsored_student_sponsored_student_id`=@sponsored_student_sponsored_student_id@";
	}

	// Master filter
	function SqlMasterFilter_sponsored_student_detail() {
		return "sponsored_student.sponsored_student_id=@sponsored_student_id@";
	}

	// Detail filter
	function SqlDetailFilter_sponsored_student_detail() {
		return "`sponsored_student_sponsored_student_id`=@sponsored_student_sponsored_student_id@";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`school_attendance`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		if ($this->TableFilter <> "") {
			if ($sWhere <> "") $sWhere = "(" . $sWhere . ") AND (";
			$sWhere .= "(" . $this->TableFilter . ")";
		}
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		global $Security;

		// Add User ID filter
		if (!$this->AllowAnonymousUser() && $Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			$sFilter = $this->AddUserIDFilter($sFilter);
			if ($this->getCurrentMasterTable() == "sponsored_student")
				$sFilter = $this->AddDetailUserIDFilter($sFilter, "sponsored_student"); // Add detail User ID filter
			if ($this->getCurrentMasterTable() == "sponsored_student_detail")
				$sFilter = $this->AddDetailUserIDFilter($sFilter, "sponsored_student_detail"); // Add detail User ID filter
		}
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter = "(" . $sFilter . ") AND ";
			$sFilter .= "(" . $this->CurrentFilter . ")";
		}
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `school_attendance` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `school_attendance` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `school_attendance` WHERE ";
		$SQL .= ew_QuotedName('school_attendance_id') . '=' . ew_QuotedValue($rs['school_attendance_id'], $this->school_attendance_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`school_attendance_id` = @school_attendance_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->school_attendance_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@school_attendance_id@", ew_AdjustSql($this->school_attendance_id->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "school_attendancelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "school_attendancelist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("school_attendanceview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "school_attendanceadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("school_attendanceedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("school_attendanceadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("school_attendancedelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->school_attendance_id->CurrentValue)) {
			$sUrl .= "school_attendance_id=" . urlencode($this->school_attendance_id->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase(\"InvalidRecord\"));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=school_attendance" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->school_attendance_id->setDbValue($rs->fields('school_attendance_id'));
		$this->start_date->setDbValue($rs->fields('start_date'));
		$this->end_date->setDbValue($rs->fields('end_date'));
		$this->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$this->entry_level->setDbValue($rs->fields('entry_level'));
		$this->entry_class->setDbValue($rs->fields('entry_class'));
		$this->sponsored_student_sponsored_student_id->setDbValue($rs->fields('sponsored_student_sponsored_student_id'));
		$this->program->setDbValue($rs->fields('program'));
		$this->attendance_type->setDbValue($rs->fields('attendance_type'));
		$this->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// start_date

		$this->start_date->CellCssStyle = ""; $this->start_date->CellCssClass = "";
		$this->start_date->CellAttrs = array(); $this->start_date->ViewAttrs = array(); $this->start_date->EditAttrs = array();

		// end_date
		$this->end_date->CellCssStyle = ""; $this->end_date->CellCssClass = "";
		$this->end_date->CellAttrs = array(); $this->end_date->ViewAttrs = array(); $this->end_date->EditAttrs = array();

		// schools_school_id
		$this->schools_school_id->CellCssStyle = ""; $this->schools_school_id->CellCssClass = "";
		$this->schools_school_id->CellAttrs = array(); $this->schools_school_id->ViewAttrs = array(); $this->schools_school_id->EditAttrs = array();

		// entry_level
		$this->entry_level->CellCssStyle = ""; $this->entry_level->CellCssClass = "";
		$this->entry_level->CellAttrs = array(); $this->entry_level->ViewAttrs = array(); $this->entry_level->EditAttrs = array();

		// sponsored_student_sponsored_student_id
		$this->sponsored_student_sponsored_student_id->CellCssStyle = ""; $this->sponsored_student_sponsored_student_id->CellCssClass = "";
		$this->sponsored_student_sponsored_student_id->CellAttrs = array(); $this->sponsored_student_sponsored_student_id->ViewAttrs = array(); $this->sponsored_student_sponsored_student_id->EditAttrs = array();

		// program
		$this->program->CellCssStyle = ""; $this->program->CellCssClass = "";
		$this->program->CellAttrs = array(); $this->program->ViewAttrs = array(); $this->program->EditAttrs = array();

		// attendance_type
		$this->attendance_type->CellCssStyle = ""; $this->attendance_type->CellCssClass = "";
		$this->attendance_type->CellAttrs = array(); $this->attendance_type->ViewAttrs = array(); $this->attendance_type->EditAttrs = array();

		// group_id
		$this->group_id->CellCssStyle = ""; $this->group_id->CellCssClass = "";
		$this->group_id->CellAttrs = array(); $this->group_id->ViewAttrs = array(); $this->group_id->EditAttrs = array();

		// start_date
		$this->start_date->ViewValue = $this->start_date->CurrentValue;
		$this->start_date->ViewValue = ew_FormatDateTime($this->start_date->ViewValue, 7);
		$this->start_date->CssStyle = "";
		$this->start_date->CssClass = "";
		$this->start_date->ViewCustomAttributes = "";

		// end_date
		$this->end_date->ViewValue = $this->end_date->CurrentValue;
		$this->end_date->ViewValue = ew_FormatDateTime($this->end_date->ViewValue, 7);
		$this->end_date->CssStyle = "";
		$this->end_date->CssClass = "";
		$this->end_date->ViewCustomAttributes = "";

		// schools_school_id
		if (strval($this->schools_school_id->CurrentValue) <> "") {
			$sFilterWrk = "`school_id` = " . ew_AdjustSql($this->schools_school_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `school_name` FROM `schools`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->schools_school_id->ViewValue = $rswrk->fields('school_name');
				$rswrk->Close();
			} else {
				$this->schools_school_id->ViewValue = $this->schools_school_id->CurrentValue;
			}
		} else {
			$this->schools_school_id->ViewValue = NULL;
		}
		$this->schools_school_id->CssStyle = "";
		$this->schools_school_id->CssClass = "";
		$this->schools_school_id->ViewCustomAttributes = "";

		// entry_level
		if (strval($this->entry_level->CurrentValue) <> "") {
			switch ($this->entry_level->CurrentValue) {
				case "SSS":
					$this->entry_level->ViewValue = "SSS";
					break;
				case "TERTIARY":
					$this->entry_level->ViewValue = "TERTIARY";
					break;
				case "JSS":
					$this->entry_level->ViewValue = "JSS";
					break;
				case "PRIMARY":
					$this->entry_level->ViewValue = "PRIMARY";
					break;
				default:
					$this->entry_level->ViewValue = $this->entry_level->CurrentValue;
			}
		} else {
			$this->entry_level->ViewValue = NULL;
		}
		$this->entry_level->CssStyle = "";
		$this->entry_level->CssClass = "";
		$this->entry_level->ViewCustomAttributes = "";

		// sponsored_student_sponsored_student_id
		if (strval($this->sponsored_student_sponsored_student_id->CurrentValue) <> "") {
			$sFilterWrk = "`sponsored_student_id` = " . ew_AdjustSql($this->sponsored_student_sponsored_student_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `student_lastname`, `student_firstname` FROM `sponsored_student`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->sponsored_student_sponsored_student_id->ViewValue = $rswrk->fields('student_lastname');
				$this->sponsored_student_sponsored_student_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('student_firstname');
				$rswrk->Close();
			} else {
				$this->sponsored_student_sponsored_student_id->ViewValue = $this->sponsored_student_sponsored_student_id->CurrentValue;
			}
		} else {
			$this->sponsored_student_sponsored_student_id->ViewValue = NULL;
		}
		$this->sponsored_student_sponsored_student_id->CssStyle = "";
		$this->sponsored_student_sponsored_student_id->CssClass = "";
		$this->sponsored_student_sponsored_student_id->ViewCustomAttributes = "";

		// program
		$this->program->ViewValue = $this->program->CurrentValue;
		$this->program->CssStyle = "";
		$this->program->CssClass = "";
		$this->program->ViewCustomAttributes = "";

		// attendance_type
		if (strval($this->attendance_type->CurrentValue) <> "") {
			switch ($this->attendance_type->CurrentValue) {
				case "BOARDER":
					$this->attendance_type->ViewValue = "BOARDER";
					break;
				case "DAY":
					$this->attendance_type->ViewValue = "DAY";
					break;
				default:
					$this->attendance_type->ViewValue = $this->attendance_type->CurrentValue;
			}
		} else {
			$this->attendance_type->ViewValue = NULL;
		}
		$this->attendance_type->CssStyle = "";
		$this->attendance_type->CssClass = "";
		$this->attendance_type->ViewCustomAttributes = "";

		// group_id
		$this->group_id->ViewValue = $this->group_id->CurrentValue;
		$this->group_id->CssStyle = "";
		$this->group_id->CssClass = "";
		$this->group_id->ViewCustomAttributes = "";

		// start_date
		$this->start_date->HrefValue = "";
		$this->start_date->TooltipValue = "";

		// end_date
		$this->end_date->HrefValue = "";
		$this->end_date->TooltipValue = "";

		// schools_school_id
		$this->schools_school_id->HrefValue = "";
		$this->schools_school_id->TooltipValue = "";

		// entry_level
		$this->entry_level->HrefValue = "";
		$this->entry_level->TooltipValue = "";

		// sponsored_student_sponsored_student_id
		$this->sponsored_student_sponsored_student_id->HrefValue = "";
		$this->sponsored_student_sponsored_student_id->TooltipValue = "";

		// program
		$this->program->HrefValue = "";
		$this->program->TooltipValue = "";

		// attendance_type
		$this->attendance_type->HrefValue = "";
		$this->attendance_type->TooltipValue = "";

		// group_id
		$this->group_id->HrefValue = "";
		$this->group_id->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Add User ID filter
	function AddUserIDFilter($sFilter) {
		global $Security;
		$sFilterWrk = $Security->UserIDList();
		if (!$Security->IsAdmin() && $sFilterWrk <> "") {
			$sFilterWrk = '`group_id` IN (' . $sFilterWrk . ')';
			if ($sFilter <> "")
				$sFilterWrk = "(" . $sFilter . ") AND (" . $sFilterWrk . ")";
		} else {
			$sFilterWrk = $sFilter;
		}
		return $sFilterWrk;
	}

	// User ID subquery
	function GetUserIDSubquery(&$fld, &$masterfld) {
		global $conn;
		$sWrk = "";
		$sSql = "SELECT " . $masterfld->FldExpression . " FROM `school_attendance` WHERE " . $this->AddUserIDFilter("");

		// List all values
		if ($rs = $conn->Execute($sSql)) {
			while (!$rs->EOF) {
				if ($sWrk <> "") $sWrk .= ",";
				$sWrk .= ew_QuotedValue($rs->fields[0], $masterfld->FldDataType);
				$rs->MoveNext();
			}
			$rs->Close();
		}
		if ($sWrk <> "") {
			$sWrk = $fld->FldExpression . " IN (" . $sWrk . ")";
		}
		return $sWrk;
	}

	// Add master User ID filter
	function AddMasterUserIDFilter($sFilter, $sCurrentMasterTable) {
		$sFilterWrk = $sFilter;
		if ($sCurrentMasterTable == "sponsored_student") {
			$sFilterWrk = $GLOBALS["sponsored_student"]->AddUserIDFilter($sFilterWrk);
		}
		return $sFilterWrk;
	}

	// Add detail User ID filter
	function AddDetailUserIDFilter($sFilter, $sCurrentMasterTable) {
		$sFilterWrk = $sFilter;
		if ($sCurrentMasterTable == "sponsored_student") {
			$sSubqueryWrk = $GLOBALS["sponsored_student"]->GetUserIDSubquery($this->sponsored_student_sponsored_student_id, $GLOBALS["sponsored_student"]->sponsored_student_id);
			if ($sSubqueryWrk <> "") {
				if ($sFilterWrk <> "") {
					$sFilterWrk = "($sFilterWrk) AND ($sSubqueryWrk)";
				} else {
					$sFilterWrk = $sSubqueryWrk;
				}
			}
		}
		return $sFilterWrk;
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict(&$rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
