<?php
   		include("applicants.php");

		if(isset($_POST['ck'])){
                        $programarea_id=$_POST['programarea_id'];
			$signatory=get_data("signatory");
			$title=get_data("title");
			$body=get_data("body");
		}
		else
		{
                    redirect_topage("../scholarship_letter.php");
		}
    
        $list=new applicants();
        $app_year=$list->get_admission_year();
	$list->get_applicants_for_letter($programarea_id,$app_year);
        if($list->get_num_rows()==0){
            echo "No record found for $programarea_id and $app_year";

            exit();
        }
		     
      
        header('Content-type: application/msword');
        //header("Content-Length: $len");
        header('Content-Disposition: attachment; filename="letter.xml"');

        
        $row=$list->fetch();
        $i=0;
        //start document
        readfile("schletter_header.txt");
        while($row){
                $fullname="{$row['student_lastname']} {$row['student_firstname']}";
                $amount=$row['app_amount'];
                $address=$row['student_address'];
                $community=$row['community'];
		$plan_office="address of plan";
                
				
?>
        <w:p wsp:rsidR="009C5894" wsp:rsidRDefault="009C5894">
            <w:r><w:t>Plan International</w:t></w:r>
            <w:r><w:br/><w:t>Accra Ghana</w:t></w:r>
        </w:p>
        <w:p wsp:rsidR="009C5894" wsp:rsidRDefault="009C5894"/>
        
		<w:p wsp:rsidR="009C5894" wsp:rsidRDefault="009C5894">
            <w:r><w:t><?php echo $fullname ?></w:t></w:r>
            <w:r><w:br/><w:t><?php echo $address ?></w:t></w:r>
			<w:r><w:br/><w:t><?php echo $community ?></w:t></w:r>
        </w:p>
		<w:p wsp:rsidR="009C5894" wsp:rsidRDefault="009C5894"/>
		<w:p wsp:rsidR="00215066" wsp:rsidRDefault="009C5894">
            <w:r><w:t><?php echo date("F d,Y") ?></w:t></w:r>
        </w:p>
        <w:p wsp:rsidR="009C5894" wsp:rsidRDefault="009C5894">
            <w:r><w:t>Dear <?php echo $row['student_lastname'] ?></w:t></w:r>
        </w:p>
        <w:p wsp:rsidR="009C5894" wsp:rsidRDefault="009C5894">
            <w:r>
                <w:t><?php echo $body ?></w:t>
            </w:r>
        </w:p>
		<w:p wsp:rsidR="009C5894" wsp:rsidRDefault="009C5894">
            <w:r>
                <w:t>Annual Grant Amount in Ghc : <?php echo $amount ?>/- </w:t>
            </w:r>
        </w:p>
		<w:p wsp:rsidR="009C5894" wsp:rsidRDefault="009C5894">
            <w:r>
                <w:t>Regards,</w:t><w:br/>
			</w:r>
        </w:p>
        <w:p wsp:rsidR="009C5894" wsp:rsidRDefault="009C5894">
			<w:r><w:t><?php echo $signatory ?></w:t><w:br/></w:r>
            <w:r><w:t><?php echo $title ?></w:t></w:r>
         </w:p>
         <w:p wsp:rsidR="009C5894" wsp:rsidRDefault="009C5894"/>
         
<?php
            
            $row=$list->fetch();
            //if there is more record,insert new page break
            if($row!=false){
?>
        <w:p wsp:rsidR="002A2259" wsp:rsidRDefault="002A2259" wsp:rsidP="002A2259">
            <w:r>
                <w:br w:type="page"/>
            </w:r>
        </w:p>
<?php
            }
            $i++;
        }
        //end of document
        include("schletter_footer.txt");
?>

