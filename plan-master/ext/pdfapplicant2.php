
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$h_offset = 25.4;
$v_offset = 254;

function pin($x) {
    return $x * 72;
}

function pcm($x) {
    return $x * 28.8;
}

function pmm($x) {
    return $x * 2.88;
}

//bottom margine + x
function vmm($x) {
    global $v_offset;
    return pmm($v_offset-$x);
}

//left margine +x
function hmm($x) {
    global $h_offset;
    return pmm($x+$h_offset);
}

class applicant_pdf2 {

    var $str_error;
    var $pdf;
    var $font;
    var $font_bold;
    var $font_italic;

    function applicant_pdf2($pdf) {
        $this->pdf = $pdf;

        if ($this->pdf == null) {
            echo "could not create a pdf object";
        }
        $this->font = PDF_load_font($this->pdf, "Times-Roman", "winansi", "");
        if ($this->font == FALSE) {
            $this->str_error = "font not found";
            echo $this->str_error;
        }
        $this->font_bold = PDF_load_font($this->pdf, "Times-Bold", "winansi", "");
        if ($this->font_bold == FALSE) {
            $this->str_error = "font not found";
            echo $this->str_error;
        }

        $this->font_italic = PDF_load_font($this->pdf, "Times-Italic", "winansi", "");
        if ($this->font_italic == FALSE) {
            $this->str_error = "font not found";
            echo $this->str_error;
        }
    }

	function show_header($year) {
        pdf_setfont($this->pdf, $this->font_bold, 14);
        pdf_show_xy($this->pdf, "Plan Scholarhisp Program", hmm(45), vmm(-20));
		pdf_setfont($this->pdf, $this->font, 12);
		pdf_show_xy($this->pdf, $year, hmm(65), vmm(-14));
        pdf_show_xy($this->pdf, date("d/m/Y"), hmm(60), vmm(-8));
    }
	
    function show_programarea($programarea_name) {
        pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "Program Area:", hmm(0), vmm(0));
		pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, $programarea_name, hmm(29), vmm(0));
    }

    function show_community($community,$point) {
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "Community: ", hmm(0), vmm(6));
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, "$community ($point point)", hmm(25), vmm(6));
    }

    function show_name($fullname) {
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "Name: ", hmm(0), vmm(12));
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, $fullname, hmm(14), vmm(12));
    }

    function show_birthdate($birthdate) {
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "Birth date: ", hmm(0), vmm(18));
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, $birthdate, hmm(24), vmm(18));
    }

    function show_gender($gender) {
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "Gender: ", hmm(0), vmm(24));
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf,  $gender, hmm(16), vmm(24));
    }

    function show_telephone($telephone) {
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "Telephone: ", hmm(0), vmm(30));
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf,  $telephone, hmm(23), vmm(30));
    }
    function show_address($address) {
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "Address: ", hmm(0), vmm(36));
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, $address, hmm(20), vmm(36));
    }

    //space
    function show_application_point($app_point) {
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "Application Point: ", hmm(0), vmm(50));
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, "$app_point (Aggrigate BECE + parent/guardian occupation+ community + JSS school)", hmm(38), vmm(50));
    }

    function show_school($school_name) {
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "School: ", hmm(0), vmm(136));
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, $school_name, hmm(18), vmm(136));
    }
    function show_aggrigate_bece($grade) {
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "Aggrigate BECE: ", hmm(0), vmm(62));
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, $grade, hmm(33), vmm(62));
    }
    //space
    function show_father($father_name) {
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "Father: ", hmm(0), vmm(76));
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, $father_name, hmm(17), vmm(76));
    }

    function show_father_occupation($occupation) {
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "Occupation: ", hmm(0), vmm(82));
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, $occupation, hmm(30), vmm(82));
    }
    //space
    function show_mother($mother_name) {
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "Mother: ", hmm(0), vmm(96));
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, $mother_name, hmm(17), vmm(96));
    }

    function show_mother_occupation($occupation) {
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "Occupation: ", hmm(0), vmm(102));
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, $occupation, hmm(30), vmm(102));
    }
    //space
    function show_guardian($guardian) {
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "Guardian: ", hmm(0), vmm(118));
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, $guardian, hmm(22), vmm(118));
    }

    function show_guardian_occupation($occupation ) {
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "Occupation: ", hmm(0), vmm(124));
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, $occupation, hmm(32), vmm(124));
    }
    //space
    function show_JSS($jss_school,$point){
		pdf_setfont($this->pdf, $this->font_bold, 12);
        pdf_show_xy($this->pdf, "JSS school: ", hmm(0), vmm(56));		//136
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, "$jss_school ($point point)", hmm(24), vmm(56));	//136
    }

    function show_priamry($primary_school){
        pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, "Primary school : $primary_school", hmm(0), vmm(142));
    }

    function show_registration_no(){
		pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, "Registration No:", hmm(0), vmm(162));
		pdf_show_xy($this->pdf, "Date :", hmm(92), vmm(162));
		//Registration line
		pdf_moveto($this->pdf,hmm(30),vmm(163));
		pdf_lineto($this->pdf,hmm(90),vmm(163));
		//Date line
		pdf_moveto($this->pdf,hmm(105),vmm(163));
		pdf_lineto($this->pdf,hmm(155),vmm(163));
		PDF_stroke($this->pdf);
		
	}
	
	function show_total_score(){
		pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, "Total Score:", hmm(0), vmm(168));
		
		//Total Score
		pdf_moveto($this->pdf,hmm(23),vmm(169));
		pdf_lineto($this->pdf,hmm(155),vmm(169));
		PDF_stroke($this->pdf);
	}
    function show_remark(){
		pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, "Remark:", hmm(0), vmm(174));
		
		//Remark
		pdf_moveto($this->pdf,hmm(18),vmm(175));
		pdf_lineto($this->pdf,hmm(155),vmm(175));
		pdf_moveto($this->pdf,hmm(0),vmm(181));
		pdf_lineto($this->pdf,hmm(155),vmm(181));
		pdf_moveto($this->pdf,hmm(0),vmm(187));
		pdf_lineto($this->pdf,hmm(155),vmm(187));
		PDF_stroke($this->pdf);
    }
	function show_chairperson(){
		pdf_setfont($this->pdf, $this->font, 12);
        pdf_show_xy($this->pdf, "Committee Chairperson:", hmm(0), vmm(192));
		pdf_show_xy($this->pdf, "Date :", hmm(92), vmm(193));
		//Registration line
		pdf_moveto($this->pdf,hmm(43),vmm(193));
		pdf_lineto($this->pdf,hmm(90),vmm(193));
		//Date line
		pdf_moveto($this->pdf,hmm(105),vmm(193));
		pdf_lineto($this->pdf,hmm(155),vmm(193));
		PDF_stroke($this->pdf);
		
	}
	
	function show_record_no($no){
		pdf_show_xy($this->pdf, $no, hmm(145), vmm(217));
	}

    
	function get_page($row) {

		$this->show_header($row['app_submission_year']);
        $this->show_programarea($row['programarea_name']);
        $this->show_community($row['community'],$row['community_point']);
        $this->show_name(fullname($row['student_lastname'], $row['student_firstname'], $row['student_middlename']));
        $this->show_birthdate(conv_mysql_uk($row['student_dob']));
        $this->show_gender(gender($row['student_gender']));
        $this->show_telephone($row['student_telephone_1'].", ".$row['student_telephone_2']);
        $this->show_address($row['student_address']);
        $this->show_application_point($row['app_points']);
        $this->show_school($row['school_name']);
        $this->show_aggrigate_bece($row['student_grades']);
        $this->show_father($row['app_father_name']);
        $this->show_father_occupation($row['father_occupation_name']);
        $this->show_mother($row['app_mother_name']);
        $this->show_mother_occupation($row['mother_occupation_name']);
        $this->show_guardian($row['app_guardian_name']);
        $this->show_guardian_occupation($row['guardian_occupation_name']);
        $this->show_JSS($row['applicant_jounior_secondary_name'],$row['applicant_school_point']);
		$this->show_registration_no();
		$this->show_total_score();
		$this->show_remark();
		$this->show_chairperson();
		$this->show_record_no($row['student_applicant_id']);
		
        
      
        return true;
    }
}
?>
