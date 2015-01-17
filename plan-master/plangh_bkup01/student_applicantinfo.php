<?php

// Global variable for table object
$student_applicant = NULL;

//
// Table class for student_applicant
//
class cstudent_applicant {
	var $TableVar = 'student_applicant';
	var $TableName = 'student_applicant';
	var $TableType = 'TABLE';
	var $student_applicant_id;
	var $app_submission_year;
	var $student_resident_programarea_id;
	var $community_community_id;
	var $app_status;
	var $app_points;
	var $app_grant_id;
	var $app_amount;
	var $student_firstname;
	var $student_middlename;
	var $student_lastname;
	var $student_gender;
	var $student_dob;
	var $app_mother_name;
	var $app_mother_isalive;
	var $app_mother_occupation;
	var $app_father_name;
	var $app_father_occupation;
	var $app_father_isalive;
	var $student_picture;
	var $app_guardian_name;
	var $app_guardian_relation;
	var $app_guardian_occupation;
	var $app_referees;
	var $sponsored_child_no;
	var $student_grades;
	var $student_address;
	var $student_telephone_1;
	var $student_telephone_2;
	var $student_admitted_school_id;
	var $app_primary_school_id;
	var $app_junior_secondary_id;
	var $app_scanneddocument;
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
	function cstudent_applicant() {
		global $Language;

		// student_applicant_id
		$this->student_applicant_id = new cField('student_applicant', 'student_applicant', 'x_student_applicant_id', 'student_applicant_id', '`student_applicant_id`', 3, -1, FALSE, '`student_applicant_id`', FALSE);
		$this->student_applicant_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['student_applicant_id'] =& $this->student_applicant_id;

		// app_submission_year
		$this->app_submission_year = new cField('student_applicant', 'student_applicant', 'x_app_submission_year', 'app_submission_year', '`app_submission_year`', 3, -1, FALSE, '`app_submission_year`', FALSE);
		$this->app_submission_year->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_submission_year'] =& $this->app_submission_year;

		// student_resident_programarea_id
		$this->student_resident_programarea_id = new cField('student_applicant', 'student_applicant', 'x_student_resident_programarea_id', 'student_resident_programarea_id', '`student_resident_programarea_id`', 3, -1, FALSE, '`student_resident_programarea_id`', FALSE);
		$this->student_resident_programarea_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['student_resident_programarea_id'] =& $this->student_resident_programarea_id;

		// community_community_id
		$this->community_community_id = new cField('student_applicant', 'student_applicant', 'x_community_community_id', 'community_community_id', '`community_community_id`', 3, -1, FALSE, '`community_community_id`', FALSE);
		$this->community_community_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['community_community_id'] =& $this->community_community_id;

		// app_status
		$this->app_status = new cField('student_applicant', 'student_applicant', 'x_app_status', 'app_status', '`app_status`', 3, -1, FALSE, '`app_status`', FALSE);
		$this->app_status->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_status'] =& $this->app_status;

		// app_points
		$this->app_points = new cField('student_applicant', 'student_applicant', 'x_app_points', 'app_points', '`app_points`', 3, -1, FALSE, '`app_points`', FALSE);
		$this->app_points->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_points'] =& $this->app_points;

		// app_grant_id
		$this->app_grant_id = new cField('student_applicant', 'student_applicant', 'x_app_grant_id', 'app_grant_id', '`app_grant_id`', 3, -1, FALSE, '`app_grant_id`', FALSE);
		$this->app_grant_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_grant_id'] =& $this->app_grant_id;

		// app_amount
		$this->app_amount = new cField('student_applicant', 'student_applicant', 'x_app_amount', 'app_amount', '`app_amount`', 131, -1, FALSE, '`app_amount`', FALSE);
		$this->app_amount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['app_amount'] =& $this->app_amount;

		// student_firstname
		$this->student_firstname = new cField('student_applicant', 'student_applicant', 'x_student_firstname', 'student_firstname', '`student_firstname`', 200, -1, FALSE, '`student_firstname`', FALSE);
		$this->fields['student_firstname'] =& $this->student_firstname;

		// student_middlename
		$this->student_middlename = new cField('student_applicant', 'student_applicant', 'x_student_middlename', 'student_middlename', '`student_middlename`', 200, -1, FALSE, '`student_middlename`', FALSE);
		$this->fields['student_middlename'] =& $this->student_middlename;

		// student_lastname
		$this->student_lastname = new cField('student_applicant', 'student_applicant', 'x_student_lastname', 'student_lastname', '`student_lastname`', 200, -1, FALSE, '`student_lastname`', FALSE);
		$this->fields['student_lastname'] =& $this->student_lastname;

		// student_gender
		$this->student_gender = new cField('student_applicant', 'student_applicant', 'x_student_gender', 'student_gender', '`student_gender`', 200, -1, FALSE, '`student_gender`', FALSE);
		$this->fields['student_gender'] =& $this->student_gender;

		// student_dob
		$this->student_dob = new cField('student_applicant', 'student_applicant', 'x_student_dob', 'student_dob', '`student_dob`', 135, 7, FALSE, '`student_dob`', FALSE);
		$this->student_dob->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['student_dob'] =& $this->student_dob;

		// app_mother_name
		$this->app_mother_name = new cField('student_applicant', 'student_applicant', 'x_app_mother_name', 'app_mother_name', '`app_mother_name`', 200, -1, FALSE, '`app_mother_name`', FALSE);
		$this->fields['app_mother_name'] =& $this->app_mother_name;

		// app_mother_isalive
		$this->app_mother_isalive = new cField('student_applicant', 'student_applicant', 'x_app_mother_isalive', 'app_mother_isalive', '`app_mother_isalive`', 16, -1, FALSE, '`app_mother_isalive`', FALSE);
		$this->app_mother_isalive->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_mother_isalive'] =& $this->app_mother_isalive;

		// app_mother_occupation
		$this->app_mother_occupation = new cField('student_applicant', 'student_applicant', 'x_app_mother_occupation', 'app_mother_occupation', '`app_mother_occupation`', 3, -1, FALSE, '`app_mother_occupation`', FALSE);
		$this->app_mother_occupation->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_mother_occupation'] =& $this->app_mother_occupation;

		// app_father_name
		$this->app_father_name = new cField('student_applicant', 'student_applicant', 'x_app_father_name', 'app_father_name', '`app_father_name`', 200, -1, FALSE, '`app_father_name`', FALSE);
		$this->fields['app_father_name'] =& $this->app_father_name;

		// app_father_occupation
		$this->app_father_occupation = new cField('student_applicant', 'student_applicant', 'x_app_father_occupation', 'app_father_occupation', '`app_father_occupation`', 3, -1, FALSE, '`app_father_occupation`', FALSE);
		$this->app_father_occupation->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_father_occupation'] =& $this->app_father_occupation;

		// app_father_isalive
		$this->app_father_isalive = new cField('student_applicant', 'student_applicant', 'x_app_father_isalive', 'app_father_isalive', '`app_father_isalive`', 16, -1, FALSE, '`app_father_isalive`', FALSE);
		$this->app_father_isalive->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_father_isalive'] =& $this->app_father_isalive;

		// student_picture
		$this->student_picture = new cField('student_applicant', 'student_applicant', 'x_student_picture', 'student_picture', '`student_picture`', 201, -1, TRUE, '`student_picture`', FALSE);
		$this->student_picture->UploadPath = "pics/app_pics";
		$this->student_picture->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['student_picture'] =& $this->student_picture;

		// app_guardian_name
		$this->app_guardian_name = new cField('student_applicant', 'student_applicant', 'x_app_guardian_name', 'app_guardian_name', '`app_guardian_name`', 200, -1, FALSE, '`app_guardian_name`', FALSE);
		$this->fields['app_guardian_name'] =& $this->app_guardian_name;

		// app_guardian_relation
		$this->app_guardian_relation = new cField('student_applicant', 'student_applicant', 'x_app_guardian_relation', 'app_guardian_relation', '`app_guardian_relation`', 200, -1, FALSE, '`app_guardian_relation`', FALSE);
		$this->fields['app_guardian_relation'] =& $this->app_guardian_relation;

		// app_guardian_occupation
		$this->app_guardian_occupation = new cField('student_applicant', 'student_applicant', 'x_app_guardian_occupation', 'app_guardian_occupation', '`app_guardian_occupation`', 3, -1, FALSE, '`app_guardian_occupation`', FALSE);
		$this->app_guardian_occupation->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_guardian_occupation'] =& $this->app_guardian_occupation;

		// app_referees
		$this->app_referees = new cField('student_applicant', 'student_applicant', 'x_app_referees', 'app_referees', '`app_referees`', 200, -1, FALSE, '`app_referees`', FALSE);
		$this->fields['app_referees'] =& $this->app_referees;

		// sponsored_child_no
		$this->sponsored_child_no = new cField('student_applicant', 'student_applicant', 'x_sponsored_child_no', 'sponsored_child_no', '`sponsored_child_no`', 200, -1, FALSE, '`sponsored_child_no`', FALSE);
		$this->fields['sponsored_child_no'] =& $this->sponsored_child_no;

		// student_grades
		$this->student_grades = new cField('student_applicant', 'student_applicant', 'x_student_grades', 'student_grades', '`student_grades`', 200, -1, FALSE, '`student_grades`', FALSE);
		$this->fields['student_grades'] =& $this->student_grades;

		// student_address
		$this->student_address = new cField('student_applicant', 'student_applicant', 'x_student_address', 'student_address', '`student_address`', 200, -1, FALSE, '`student_address`', FALSE);
		$this->fields['student_address'] =& $this->student_address;

		// student_telephone_1
		$this->student_telephone_1 = new cField('student_applicant', 'student_applicant', 'x_student_telephone_1', 'student_telephone_1', '`student_telephone_1`', 200, -1, FALSE, '`student_telephone_1`', FALSE);
		$this->fields['student_telephone_1'] =& $this->student_telephone_1;

		// student_telephone_2
		$this->student_telephone_2 = new cField('student_applicant', 'student_applicant', 'x_student_telephone_2', 'student_telephone_2', '`student_telephone_2`', 200, -1, FALSE, '`student_telephone_2`', FALSE);
		$this->fields['student_telephone_2'] =& $this->student_telephone_2;

		// student_admitted_school_id
		$this->student_admitted_school_id = new cField('student_applicant', 'student_applicant', 'x_student_admitted_school_id', 'student_admitted_school_id', '`student_admitted_school_id`', 3, -1, FALSE, '`student_admitted_school_id`', FALSE);
		$this->student_admitted_school_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['student_admitted_school_id'] =& $this->student_admitted_school_id;

		// app_primary_school_id
		$this->app_primary_school_id = new cField('student_applicant', 'student_applicant', 'x_app_primary_school_id', 'app_primary_school_id', '`app_primary_school_id`', 3, -1, FALSE, '`app_primary_school_id`', FALSE);
		$this->app_primary_school_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_primary_school_id'] =& $this->app_primary_school_id;

		// app_junior_secondary_id
		$this->app_junior_secondary_id = new cField('student_applicant', 'student_applicant', 'x_app_junior_secondary_id', 'app_junior_secondary_id', '`app_junior_secondary_id`', 3, -1, FALSE, '`app_junior_secondary_id`', FALSE);
		$this->app_junior_secondary_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_junior_secondary_id'] =& $this->app_junior_secondary_id;

		// app_scanneddocument
		$this->app_scanneddocument = new cField('student_applicant', 'student_applicant', 'x_app_scanneddocument', 'app_scanneddocument', '`app_scanneddocument`', 200, -1, TRUE, '`app_scanneddocument`', FALSE);
		$this->app_scanneddocument->UploadPath = EW_UPLOAD_DEST_PATH;
		$this->app_scanneddocument->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_scanneddocument'] =& $this->app_scanneddocument;

		// group_id
		$this->group_id = new cField('student_applicant', 'student_applicant', 'x_group_id', 'group_id', '`group_id`', 3, -1, FALSE, '`group_id`', FALSE);
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
		return "student_applicant_Highlight";
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
		return "`student_applicant`";
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
		return "INSERT INTO `student_applicant` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `student_applicant` SET ";
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
		$SQL = "DELETE FROM `student_applicant` WHERE ";
		$SQL .= ew_QuotedName('student_applicant_id') . '=' . ew_QuotedValue($rs['student_applicant_id'], $this->student_applicant_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`student_applicant_id` = @student_applicant_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->student_applicant_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@student_applicant_id@", ew_AdjustSql($this->student_applicant_id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "student_applicantlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "student_applicantlist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("student_applicantview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "student_applicantadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("student_applicantedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("student_applicantadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("student_applicantdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->student_applicant_id->CurrentValue)) {
			$sUrl .= "student_applicant_id=" . urlencode($this->student_applicant_id->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=student_applicant" : "";
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
		$this->student_applicant_id->setDbValue($rs->fields('student_applicant_id'));
		$this->app_submission_year->setDbValue($rs->fields('app_submission_year'));
		$this->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
		$this->community_community_id->setDbValue($rs->fields('community_community_id'));
		$this->app_status->setDbValue($rs->fields('app_status'));
		$this->app_points->setDbValue($rs->fields('app_points'));
		$this->app_grant_id->setDbValue($rs->fields('app_grant_id'));
		$this->app_amount->setDbValue($rs->fields('app_amount'));
		$this->student_firstname->setDbValue($rs->fields('student_firstname'));
		$this->student_middlename->setDbValue($rs->fields('student_middlename'));
		$this->student_lastname->setDbValue($rs->fields('student_lastname'));
		$this->student_gender->setDbValue($rs->fields('student_gender'));
		$this->student_dob->setDbValue($rs->fields('student_dob'));
		$this->app_mother_name->setDbValue($rs->fields('app_mother_name'));
		$this->app_mother_isalive->setDbValue($rs->fields('app_mother_isalive'));
		$this->app_mother_occupation->setDbValue($rs->fields('app_mother_occupation'));
		$this->app_father_name->setDbValue($rs->fields('app_father_name'));
		$this->app_father_occupation->setDbValue($rs->fields('app_father_occupation'));
		$this->app_father_isalive->setDbValue($rs->fields('app_father_isalive'));
		$this->student_picture->Upload->DbValue = $rs->fields('student_picture');
		$this->app_guardian_name->setDbValue($rs->fields('app_guardian_name'));
		$this->app_guardian_relation->setDbValue($rs->fields('app_guardian_relation'));
		$this->app_guardian_occupation->setDbValue($rs->fields('app_guardian_occupation'));
		$this->app_referees->setDbValue($rs->fields('app_referees'));
		$this->sponsored_child_no->setDbValue($rs->fields('sponsored_child_no'));
		$this->student_grades->setDbValue($rs->fields('student_grades'));
		$this->student_address->setDbValue($rs->fields('student_address'));
		$this->student_telephone_1->setDbValue($rs->fields('student_telephone_1'));
		$this->student_telephone_2->setDbValue($rs->fields('student_telephone_2'));
		$this->student_admitted_school_id->setDbValue($rs->fields('student_admitted_school_id'));
		$this->app_primary_school_id->setDbValue($rs->fields('app_primary_school_id'));
		$this->app_junior_secondary_id->setDbValue($rs->fields('app_junior_secondary_id'));
		$this->app_scanneddocument->Upload->DbValue = $rs->fields('app_scanneddocument');
		$this->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// student_applicant_id

		$this->student_applicant_id->CellCssStyle = ""; $this->student_applicant_id->CellCssClass = "";
		$this->student_applicant_id->CellAttrs = array(); $this->student_applicant_id->ViewAttrs = array(); $this->student_applicant_id->EditAttrs = array();

		// app_submission_year
		$this->app_submission_year->CellCssStyle = ""; $this->app_submission_year->CellCssClass = "";
		$this->app_submission_year->CellAttrs = array(); $this->app_submission_year->ViewAttrs = array(); $this->app_submission_year->EditAttrs = array();

		// student_resident_programarea_id
		$this->student_resident_programarea_id->CellCssStyle = ""; $this->student_resident_programarea_id->CellCssClass = "";
		$this->student_resident_programarea_id->CellAttrs = array(); $this->student_resident_programarea_id->ViewAttrs = array(); $this->student_resident_programarea_id->EditAttrs = array();

		// community_community_id
		$this->community_community_id->CellCssStyle = ""; $this->community_community_id->CellCssClass = "";
		$this->community_community_id->CellAttrs = array(); $this->community_community_id->ViewAttrs = array(); $this->community_community_id->EditAttrs = array();

		// app_status
		$this->app_status->CellCssStyle = ""; $this->app_status->CellCssClass = "";
		$this->app_status->CellAttrs = array(); $this->app_status->ViewAttrs = array(); $this->app_status->EditAttrs = array();

		// app_points
		$this->app_points->CellCssStyle = ""; $this->app_points->CellCssClass = "";
		$this->app_points->CellAttrs = array(); $this->app_points->ViewAttrs = array(); $this->app_points->EditAttrs = array();

		// app_grant_id
		$this->app_grant_id->CellCssStyle = ""; $this->app_grant_id->CellCssClass = "";
		$this->app_grant_id->CellAttrs = array(); $this->app_grant_id->ViewAttrs = array(); $this->app_grant_id->EditAttrs = array();

		// student_firstname
		$this->student_firstname->CellCssStyle = ""; $this->student_firstname->CellCssClass = "";
		$this->student_firstname->CellAttrs = array(); $this->student_firstname->ViewAttrs = array(); $this->student_firstname->EditAttrs = array();

		// student_lastname
		$this->student_lastname->CellCssStyle = ""; $this->student_lastname->CellCssClass = "";
		$this->student_lastname->CellAttrs = array(); $this->student_lastname->ViewAttrs = array(); $this->student_lastname->EditAttrs = array();

		// student_gender
		$this->student_gender->CellCssStyle = ""; $this->student_gender->CellCssClass = "";
		$this->student_gender->CellAttrs = array(); $this->student_gender->ViewAttrs = array(); $this->student_gender->EditAttrs = array();

		// student_dob
		$this->student_dob->CellCssStyle = ""; $this->student_dob->CellCssClass = "";
		$this->student_dob->CellAttrs = array(); $this->student_dob->ViewAttrs = array(); $this->student_dob->EditAttrs = array();

		// sponsored_child_no
		$this->sponsored_child_no->CellCssStyle = ""; $this->sponsored_child_no->CellCssClass = "";
		$this->sponsored_child_no->CellAttrs = array(); $this->sponsored_child_no->ViewAttrs = array(); $this->sponsored_child_no->EditAttrs = array();

		// student_applicant_id
		$this->student_applicant_id->ViewValue = $this->student_applicant_id->CurrentValue;
		$this->student_applicant_id->CssStyle = "";
		$this->student_applicant_id->CssClass = "";
		$this->student_applicant_id->ViewCustomAttributes = "";

		// app_submission_year
		$this->app_submission_year->ViewValue = $this->app_submission_year->CurrentValue;
		if (strval($this->app_submission_year->CurrentValue) <> "") {
			$sFilterWrk = "`app_year` = " . ew_AdjustSql($this->app_submission_year->CurrentValue) . "";
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
				$this->app_submission_year->ViewValue = $rswrk->fields('app_year');
				$rswrk->Close();
			} else {
				$this->app_submission_year->ViewValue = $this->app_submission_year->CurrentValue;
			}
		} else {
			$this->app_submission_year->ViewValue = NULL;
		}
		$this->app_submission_year->CssStyle = "";
		$this->app_submission_year->CssClass = "";
		$this->app_submission_year->ViewCustomAttributes = "";

		// student_resident_programarea_id
		if (strval($this->student_resident_programarea_id->CurrentValue) <> "") {
			$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($this->student_resident_programarea_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->student_resident_programarea_id->ViewValue = $rswrk->fields('programarea_name');
				$rswrk->Close();
			} else {
				$this->student_resident_programarea_id->ViewValue = $this->student_resident_programarea_id->CurrentValue;
			}
		} else {
			$this->student_resident_programarea_id->ViewValue = NULL;
		}
		$this->student_resident_programarea_id->CssStyle = "";
		$this->student_resident_programarea_id->CssClass = "";
		$this->student_resident_programarea_id->ViewCustomAttributes = "";

		// community_community_id
		if (strval($this->community_community_id->CurrentValue) <> "") {
			$sFilterWrk = "`community_id` = " . ew_AdjustSql($this->community_community_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `community` FROM `community`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->community_community_id->ViewValue = $rswrk->fields('community');
				$rswrk->Close();
			} else {
				$this->community_community_id->ViewValue = $this->community_community_id->CurrentValue;
			}
		} else {
			$this->community_community_id->ViewValue = NULL;
		}
		$this->community_community_id->CssStyle = "";
		$this->community_community_id->CssClass = "";
		$this->community_community_id->ViewCustomAttributes = "";

		// app_status
		$this->app_status->ViewValue = $this->app_status->CurrentValue;
		if (strval($this->app_status->CurrentValue) <> "") {
			$sFilterWrk = "`application_status_id` = " . ew_AdjustSql($this->app_status->CurrentValue) . "";
		$sSqlWrk = "SELECT `application_status` FROM `application_status`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->app_status->ViewValue = $rswrk->fields('application_status');
				$rswrk->Close();
			} else {
				$this->app_status->ViewValue = $this->app_status->CurrentValue;
			}
		} else {
			$this->app_status->ViewValue = NULL;
		}
		$this->app_status->CssStyle = "";
		$this->app_status->CssClass = "";
		$this->app_status->ViewCustomAttributes = "";

		// app_points
		$this->app_points->ViewValue = $this->app_points->CurrentValue;
		$this->app_points->CssStyle = "";
		$this->app_points->CssClass = "";
		$this->app_points->ViewCustomAttributes = "";

		// app_grant_id
		$this->app_grant_id->ViewValue = $this->app_grant_id->CurrentValue;
		if (strval($this->app_grant_id->CurrentValue) <> "") {
			$sFilterWrk = "`grant_package_id` = " . ew_AdjustSql($this->app_grant_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `name` FROM `grant_package`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->app_grant_id->ViewValue = $rswrk->fields('name');
				$rswrk->Close();
			} else {
				$this->app_grant_id->ViewValue = $this->app_grant_id->CurrentValue;
			}
		} else {
			$this->app_grant_id->ViewValue = NULL;
		}
		$this->app_grant_id->CssStyle = "";
		$this->app_grant_id->CssClass = "";
		$this->app_grant_id->ViewCustomAttributes = "";

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

		// student_gender
		if (strval($this->student_gender->CurrentValue) <> "") {
			switch ($this->student_gender->CurrentValue) {
				case "M":
					$this->student_gender->ViewValue = "Male";
					break;
				case "F":
					$this->student_gender->ViewValue = "Female";
					break;
				default:
					$this->student_gender->ViewValue = $this->student_gender->CurrentValue;
			}
		} else {
			$this->student_gender->ViewValue = NULL;
		}
		$this->student_gender->CssStyle = "";
		$this->student_gender->CssClass = "";
		$this->student_gender->ViewCustomAttributes = "";

		// student_dob
		$this->student_dob->ViewValue = $this->student_dob->CurrentValue;
		$this->student_dob->ViewValue = ew_FormatDateTime($this->student_dob->ViewValue, 7);
		$this->student_dob->CssStyle = "";
		$this->student_dob->CssClass = "";
		$this->student_dob->ViewCustomAttributes = "";

		// sponsored_child_no
		$this->sponsored_child_no->ViewValue = $this->sponsored_child_no->CurrentValue;
		$this->sponsored_child_no->CssStyle = "";
		$this->sponsored_child_no->CssClass = "";
		$this->sponsored_child_no->ViewCustomAttributes = "";

		// student_applicant_id
		$this->student_applicant_id->HrefValue = "";
		$this->student_applicant_id->TooltipValue = "";

		// app_submission_year
		$this->app_submission_year->HrefValue = "";
		$this->app_submission_year->TooltipValue = "";

		// student_resident_programarea_id
		$this->student_resident_programarea_id->HrefValue = "";
		$this->student_resident_programarea_id->TooltipValue = "";

		// community_community_id
		$this->community_community_id->HrefValue = "";
		$this->community_community_id->TooltipValue = "";

		// app_status
		$this->app_status->HrefValue = "";
		$this->app_status->TooltipValue = "";

		// app_points
		$this->app_points->HrefValue = "";
		$this->app_points->TooltipValue = "";

		// app_grant_id
		$this->app_grant_id->HrefValue = "";
		$this->app_grant_id->TooltipValue = "";

		// student_firstname
		$this->student_firstname->HrefValue = "";
		$this->student_firstname->TooltipValue = "";

		// student_lastname
		$this->student_lastname->HrefValue = "";
		$this->student_lastname->TooltipValue = "";

		// student_gender
		$this->student_gender->HrefValue = "";
		$this->student_gender->TooltipValue = "";

		// student_dob
		$this->student_dob->HrefValue = "";
		$this->student_dob->TooltipValue = "";

		// sponsored_child_no
		$this->sponsored_child_no->HrefValue = "";
		$this->sponsored_child_no->TooltipValue = "";

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
        
        global $app_year;
        global $programarea_id;
        
        
        if($app_year==0)    //dont filter with app_year
        {
            if($programarea_id==false)
            {
                //dont filter
                return;
            }
            //filter by programarea only
           
            $filter="student_applicant.student_resident_programarea_id=$programarea_id";
            return;
        }
        // admission year
        if($programarea_id==false || $programarea_id==0)
        {
            $filter="student_applicant.app_submission_year=$app_year";
            return;
        }
        //filter both
        $filter="student_applicant.app_submission_year=$app_year AND student_applicant.student_resident_programarea_id=$programarea_id";

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

	        include("ext/applicants.php");
	        $app=new applicants();
	        $rs['app_status']=0;
	        $rs['app_points']=$app->assign_applicant_point(
	            $rs["app_father_occupation"], 
	            $rs["app_father_occupation"],
	            $rs["pp_guardian_occupation"], 
	            $rs["student_grades"],
	            $rs["app_junior_secondary_id"],
	            $rs["community_community_id"]
	            );
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
    
    
    if($rsold["app_status"]>=1){
        $this->CancelMessage="This applicatin record cannot be edited because it's status is awarded or confirmed. Cancel the award before updating.";
        return FALSE;    //status is awarded or confirmed
    }
    
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
	    if($rs["app_status"]>=1){
	        $this->CancelMessage="This applicatin record cannot be removed because it's status is awarded or confirmed. Cancel the award before deleting.";     
	        return FALSE;    //status is awarded or confirmed
	    }             
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
