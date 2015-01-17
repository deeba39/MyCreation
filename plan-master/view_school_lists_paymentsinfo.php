<?php

// Global variable for table object
$view_school_lists_payments = NULL;

//
// Table class for view_school_lists_payments
//
class cview_school_lists_payments {
	var $TableVar = 'view_school_lists_payments';
	var $TableName = 'view_school_lists_payments';
	var $TableType = 'CUSTOMVIEW';
	var $sponsored_student_id;
	var $student_firstname;
	var $student_middlename;
	var $student_lastname;
	var $schools_school_id;
	var $year;
	var $class;
	var $program;
	var $attendance_type;
	var $grade_year_id;
	var $school_attendance_school_attendance_id;
	var $verified;
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
	function cview_school_lists_payments() {
		global $Language;

		// sponsored_student_id
		$this->sponsored_student_id = new cField('view_school_lists_payments', 'view_school_lists_payments', 'x_sponsored_student_id', 'sponsored_student_id', 'sponsored_student.sponsored_student_id', 3, -1, FALSE, 'sponsored_student.sponsored_student_id', FALSE);
		$this->sponsored_student_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sponsored_student_id'] =& $this->sponsored_student_id;

		// student_firstname
		$this->student_firstname = new cField('view_school_lists_payments', 'view_school_lists_payments', 'x_student_firstname', 'student_firstname', 'sponsored_student.student_firstname', 200, -1, FALSE, 'sponsored_student.student_firstname', FALSE);
		$this->fields['student_firstname'] =& $this->student_firstname;

		// student_middlename
		$this->student_middlename = new cField('view_school_lists_payments', 'view_school_lists_payments', 'x_student_middlename', 'student_middlename', 'sponsored_student.student_middlename', 200, -1, FALSE, 'sponsored_student.student_middlename', FALSE);
		$this->fields['student_middlename'] =& $this->student_middlename;

		// student_lastname
		$this->student_lastname = new cField('view_school_lists_payments', 'view_school_lists_payments', 'x_student_lastname', 'student_lastname', 'sponsored_student.student_lastname', 200, -1, FALSE, 'sponsored_student.student_lastname', FALSE);
		$this->fields['student_lastname'] =& $this->student_lastname;

		// schools_school_id
		$this->schools_school_id = new cField('view_school_lists_payments', 'view_school_lists_payments', 'x_schools_school_id', 'schools_school_id', 'school_attendance.schools_school_id', 3, -1, FALSE, 'school_attendance.schools_school_id', FALSE);
		$this->schools_school_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['schools_school_id'] =& $this->schools_school_id;

		// year
		$this->year = new cField('view_school_lists_payments', 'view_school_lists_payments', 'x_year', 'year', 'grade_year.year', 3, -1, FALSE, 'grade_year.year', FALSE);
		$this->year->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['year'] =& $this->year;

		// class
		$this->class = new cField('view_school_lists_payments', 'view_school_lists_payments', 'x_class', 'class', 'grade_year.class', 200, -1, FALSE, 'grade_year.class', FALSE);
		$this->fields['class'] =& $this->class;

		// program
		$this->program = new cField('view_school_lists_payments', 'view_school_lists_payments', 'x_program', 'program', 'school_attendance.program', 200, -1, FALSE, 'school_attendance.program', FALSE);
		$this->fields['program'] =& $this->program;

		// attendance_type
		$this->attendance_type = new cField('view_school_lists_payments', 'view_school_lists_payments', 'x_attendance_type', 'attendance_type', 'school_attendance.attendance_type', 202, -1, FALSE, 'school_attendance.attendance_type', FALSE);
		$this->fields['attendance_type'] =& $this->attendance_type;

		// grade_year_id
		$this->grade_year_id = new cField('view_school_lists_payments', 'view_school_lists_payments', 'x_grade_year_id', 'grade_year_id', 'grade_year.grade_year_id', 3, -1, FALSE, 'grade_year.grade_year_id', FALSE);
		$this->grade_year_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['grade_year_id'] =& $this->grade_year_id;

		// school_attendance_school_attendance_id
		$this->school_attendance_school_attendance_id = new cField('view_school_lists_payments', 'view_school_lists_payments', 'x_school_attendance_school_attendance_id', 'school_attendance_school_attendance_id', 'grade_year.school_attendance_school_attendance_id', 3, -1, FALSE, 'grade_year.school_attendance_school_attendance_id', FALSE);
		$this->school_attendance_school_attendance_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['school_attendance_school_attendance_id'] =& $this->school_attendance_school_attendance_id;

		// verified
		$this->verified = new cField('view_school_lists_payments', 'view_school_lists_payments', 'x_verified', 'verified', 'grade_year.verified', 202, -1, FALSE, 'grade_year.verified', FALSE);
		$this->fields['verified'] =& $this->verified;
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
		return "view_school_lists_payments_Highlight";
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

	// Table level SQL
	function SqlFrom() { // From
		return "sponsored_student Inner Join school_attendance On sponsored_student.sponsored_student_id = school_attendance.sponsored_student_sponsored_student_id Left Join grade_year On school_attendance.school_attendance_id = grade_year.school_attendance_school_attendance_id";
	}

	function SqlSelect() { // Select
		return "SELECT Distinct sponsored_student.sponsored_student_id, sponsored_student.student_firstname, sponsored_student.student_middlename, sponsored_student.student_lastname, school_attendance.schools_school_id, grade_year.year, grade_year.class, school_attendance.program, school_attendance.attendance_type, grade_year.grade_year_id, grade_year.school_attendance_school_attendance_id, grade_year.verified FROM " . $this->SqlFrom();
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
		return "INSERT INTO sponsored_student Inner Join school_attendance On sponsored_student.sponsored_student_id = school_attendance.sponsored_student_sponsored_student_id Left Join grade_year On school_attendance.school_attendance_id = grade_year.school_attendance_school_attendance_id ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE sponsored_student Inner Join school_attendance On sponsored_student.sponsored_student_id = school_attendance.sponsored_student_sponsored_student_id Left Join grade_year On school_attendance.school_attendance_id = grade_year.school_attendance_school_attendance_id SET ";
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
		$SQL = "DELETE FROM sponsored_student Inner Join school_attendance On sponsored_student.sponsored_student_id = school_attendance.sponsored_student_sponsored_student_id Left Join grade_year On school_attendance.school_attendance_id = grade_year.school_attendance_school_attendance_id WHERE ";
		$SQL .= ew_QuotedName('grade_year_id') . '=' . ew_QuotedValue($rs['grade_year_id'], $this->grade_year_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "grade_year.grade_year_id = @grade_year_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->grade_year_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@grade_year_id@", ew_AdjustSql($this->grade_year_id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "view_school_lists_paymentslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "view_school_lists_paymentslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("view_school_lists_paymentsview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "view_school_lists_paymentsadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("view_school_lists_paymentsedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("view_school_lists_paymentsadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("view_school_lists_paymentsdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->grade_year_id->CurrentValue)) {
			$sUrl .= "grade_year_id=" . urlencode($this->grade_year_id->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=view_school_lists_payments" : "";
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
		$this->sponsored_student_id->setDbValue($rs->fields('sponsored_student_id'));
		$this->student_firstname->setDbValue($rs->fields('student_firstname'));
		$this->student_middlename->setDbValue($rs->fields('student_middlename'));
		$this->student_lastname->setDbValue($rs->fields('student_lastname'));
		$this->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$this->year->setDbValue($rs->fields('year'));
		$this->class->setDbValue($rs->fields('class'));
		$this->program->setDbValue($rs->fields('program'));
		$this->attendance_type->setDbValue($rs->fields('attendance_type'));
		$this->grade_year_id->setDbValue($rs->fields('grade_year_id'));
		$this->school_attendance_school_attendance_id->setDbValue($rs->fields('school_attendance_school_attendance_id'));
		$this->verified->setDbValue($rs->fields('verified'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// student_firstname

		$this->student_firstname->CellCssStyle = ""; $this->student_firstname->CellCssClass = "";
		$this->student_firstname->CellAttrs = array(); $this->student_firstname->ViewAttrs = array(); $this->student_firstname->EditAttrs = array();

		// student_lastname
		$this->student_lastname->CellCssStyle = ""; $this->student_lastname->CellCssClass = "";
		$this->student_lastname->CellAttrs = array(); $this->student_lastname->ViewAttrs = array(); $this->student_lastname->EditAttrs = array();

		// schools_school_id
		$this->schools_school_id->CellCssStyle = ""; $this->schools_school_id->CellCssClass = "";
		$this->schools_school_id->CellAttrs = array(); $this->schools_school_id->ViewAttrs = array(); $this->schools_school_id->EditAttrs = array();

		// year
		$this->year->CellCssStyle = ""; $this->year->CellCssClass = "";
		$this->year->CellAttrs = array(); $this->year->ViewAttrs = array(); $this->year->EditAttrs = array();

		// program
		$this->program->CellCssStyle = ""; $this->program->CellCssClass = "";
		$this->program->CellAttrs = array(); $this->program->ViewAttrs = array(); $this->program->EditAttrs = array();

		// attendance_type
		$this->attendance_type->CellCssStyle = ""; $this->attendance_type->CellCssClass = "";
		$this->attendance_type->CellAttrs = array(); $this->attendance_type->ViewAttrs = array(); $this->attendance_type->EditAttrs = array();

		// grade_year_id
		$this->grade_year_id->CellCssStyle = ""; $this->grade_year_id->CellCssClass = "";
		$this->grade_year_id->CellAttrs = array(); $this->grade_year_id->ViewAttrs = array(); $this->grade_year_id->EditAttrs = array();

		// verified
		$this->verified->CellCssStyle = ""; $this->verified->CellCssClass = "";
		$this->verified->CellAttrs = array(); $this->verified->ViewAttrs = array(); $this->verified->EditAttrs = array();

		// student_firstname
		$this->student_firstname->ViewValue = $this->student_firstname->CurrentValue;
		$this->student_firstname->CssStyle = "";
		$this->student_firstname->CssClass = "";
		$this->student_firstname->ViewCustomAttributes = "";

		// student_lastname
		$this->student_lastname->ViewValue = $this->student_lastname->CurrentValue;
		$this->student_lastname->CssStyle = "";
		$this->student_lastname->CssClass = "";
		$this->student_lastname->ViewCustomAttributes = "";

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

		// year
		$this->year->ViewValue = $this->year->CurrentValue;
		$this->year->CssStyle = "";
		$this->year->CssClass = "";
		$this->year->ViewCustomAttributes = "";

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

		// grade_year_id
		$this->grade_year_id->ViewValue = $this->grade_year_id->CurrentValue;
		$this->grade_year_id->CssStyle = "";
		$this->grade_year_id->CssClass = "";
		$this->grade_year_id->ViewCustomAttributes = "";

		// verified
		if (strval($this->verified->CurrentValue) <> "") {
			switch ($this->verified->CurrentValue) {
				case "Pending":
					$this->verified->ViewValue = "Pending";
					break;
				case "Verified":
					$this->verified->ViewValue = "Verified";
					break;
				case "PaymentRequested":
					$this->verified->ViewValue = "PaymentRequested";
					break;
				default:
					$this->verified->ViewValue = $this->verified->CurrentValue;
			}
		} else {
			$this->verified->ViewValue = NULL;
		}
		$this->verified->CssStyle = "";
		$this->verified->CssClass = "";
		$this->verified->ViewCustomAttributes = "";

		// student_firstname
		$this->student_firstname->HrefValue = "";
		$this->student_firstname->TooltipValue = "";

		// student_lastname
		$this->student_lastname->HrefValue = "";
		$this->student_lastname->TooltipValue = "";

		// schools_school_id
		$this->schools_school_id->HrefValue = "";
		$this->schools_school_id->TooltipValue = "";

		// year
		$this->year->HrefValue = "";
		$this->year->TooltipValue = "";

		// program
		$this->program->HrefValue = "";
		$this->program->TooltipValue = "";

		// attendance_type
		$this->attendance_type->HrefValue = "";
		$this->attendance_type->TooltipValue = "";

		// grade_year_id
		$this->grade_year_id->HrefValue = "";
		$this->grade_year_id->TooltipValue = "";

		// verified
		$this->verified->HrefValue = "";
		$this->verified->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
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
    $myFile = "nna.txt";
fwrite($fh, "started\n");
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $rsold->fields('verified'));
fwrite($fh, $rsnew->fields('verified'));
fwrite($fh, "done\n");
fclose($fh);
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
