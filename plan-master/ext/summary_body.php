<w:p wsp:rsidR="003067FE" wsp:rsidRDefault="003067FE" wsp:rsidP="003067FE">
            <w:pPr><w:jc w:val="center"/></w:pPr>
            <w:r wsp:rsidRPr="00684A43">
                <w:rPr><w:sz w:val="32"/><w:sz-cs w:val="32"/></w:rPr>
                <w:t>Plan Ghana Scholarship Application Summary</w:t>
            </w:r>
            <w:r><w:br/><w:t><?php echo $app_year ?></w:t></w:r>
        </w:p>
        <w:p wsp:rsidR="003067FE" wsp:rsidRDefault="0006044F" wsp:rsidP="003067FE">
            <w:r><w:t>Summary compiled on </w:t></w:r>
            <w:r wsp:rsidR="00684A43"><w:t>:</w:t></w:r>
            <w:r wsp:rsidR="00684A43"><w:t><?php echo date("d/m/Y")?> </w:t></w:r>
        </w:p>
        <w:tbl>
            <w:tblPr>
                <w:tblW w:w="0" w:type="auto"/>
                <w:tblBorders><w:top w:val="dotted" w:sz="4" wx:bdrwidth="10" w:space="0" w:color="auto"/>
                <w:left w:val="dotted" w:sz="4" wx:bdrwidth="10" w:space="0" w:color="auto"/>
                <w:bottom w:val="dotted" w:sz="4" wx:bdrwidth="10" w:space="0" w:color="auto"/>
                <w:right w:val="dotted" w:sz="4" wx:bdrwidth="10" w:space="0" w:color="auto"/>
                <w:insideH w:val="dotted" w:sz="4" wx:bdrwidth="10" w:space="0" w:color="auto"/>
                <w:insideV w:val="dotted" w:sz="4" wx:bdrwidth="10" w:space="0" w:color="auto"/>
                </w:tblBorders><w:tblLook w:val="04A0"/>
            </w:tblPr>
            <w:tblGrid>
                <w:gridCol w:w="2898"/>
                <w:gridCol w:w="6345"/>
            </w:tblGrid>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Program Unit</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo $row['programarea_name'] ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Community</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo "{$row['community']} ({$row['community_category_name']},points: {$row['community_category_app_point']})" ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Name</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t><?php echo "{$row['student_lastname']}"?></w:t></w:r>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t> <?php echo ", {$row['student_firstname']} {$row['student_middlename']}" ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Gender</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo gender($row['student_gender']) ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Birth date</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo conv_mysql_uk($row['student_dob']) ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Address</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo $row['student_address'] ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Telephone</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo $row['student_telephone_1'].", ".$row['student_telephone_2'] ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>

            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr><w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67"><w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/><w:rPr><w:b/></w:rPr></w:pPr></w:p></w:tc><w:tc><w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr><w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67"><w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr></w:p></w:tc></w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Application Point</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo $row['app_points'] ?> (calculated at the time of application)</w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Plan Sponsored Child</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo $row['sponsored_child_no'] ?> </w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>
            <w:tr wsp:rsidR="00667469" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr><w:p wsp:rsidR="00667469" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="00667469" wsp:rsidP="00B67D67"><w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/><w:rPr><w:b/></w:rPr></w:pPr></w:p></w:tc><w:tc><w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr><w:p wsp:rsidR="00667469" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="00667469" wsp:rsidP="00B67D67"><w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr></w:p></w:tc></w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>School Attended</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo "{$row['applicant_jounior_secondary_name']}, ({$row['applicant_school_category_name']}, points: {$row['applicant_school_category_app_point']})" ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Grade</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo "{$row['student_grades']} (points :{$row["grade_point"]})" ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr><w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67"><w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/><w:rPr><w:b/></w:rPr></w:pPr></w:p></w:tc><w:tc><w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr><w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67"><w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr></w:p></w:tc></w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Mother Name:</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo $row['app_mother_name'] ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Occupation</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo "{$row['mother_occupation_name']} (points: {$row["mother_occupation_point"]} )" ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>

            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr><w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67"><w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/><w:rPr><w:b/></w:rPr></w:pPr></w:p></w:tc><w:tc><w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr><w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67"><w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr></w:p></w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Father Name:</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo $row['app_father_name'] ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Occupation</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo "{$row['father_occupation_name']} (points: {$row["father_occupation_point"]} )" ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr><w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67"><w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/><w:rPr><w:b/></w:rPr></w:pPr></w:p></w:tc><w:tc><w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr><w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67"><w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr></w:p></w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Guardian Name:</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo $row['app_guardian_name'] ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>Occupation</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo "{$row['guardian_occupation_name']} (points: {$row["guardian_occupation_point"]} )"  ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>

            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D"><w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr><w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67"><w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/><w:rPr><w:b/></w:rPr></w:pPr></w:p></w:tc><w:tc><w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr><w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67"><w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr></w:p></w:tc>
            </w:tr>
            <w:tr wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr>
                            <w:spacing w:after="0" w:line="240" w:line-rule="auto"/>
                            <w:rPr><w:b/></w:rPr>
                       </w:pPr>
                       <w:r wsp:rsidRPr="00B67D67"><w:rPr><w:b/></w:rPr><w:t>School Admitted</w:t></w:r>
                       <w:r wsp:rsidR="00684A43" wsp:rsidRPr="00B67D67">
                           <w:rPr><w:b/></w:rPr><w:t> :</w:t></w:r>
                   </w:p>
                </w:tc>
                <w:tc>
                    <w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                    <w:p wsp:rsidR="003067FE" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="003067FE" wsp:rsidP="00B67D67">
                        <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr>
                        <w:r wsp:rsidRPr="00B67D67"><w:rPr></w:rPr><w:t><?php echo $row['school_name'] ?></w:t></w:r>
                    </w:p>
                </w:tc>
            </w:tr>
            <w:tr wsp:rsidR="00667469" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D"><w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr><w:p wsp:rsidR="00667469" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="00667469" wsp:rsidP="00B67D67"><w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/><w:rPr><w:b/></w:rPr></w:pPr></w:p></w:tc><w:tc><w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr><w:p wsp:rsidR="00667469" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="00667469" wsp:rsidP="00B67D67"><w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr></w:p></w:tc>
            </w:tr>
            <w:tr wsp:rsidR="00667469" wsp:rsidRPr="00B67D67" wsp:rsidTr="0088524D">
                    <w:tc><w:tcPr><w:tcW w:w="2898" w:type="dxa"/></w:tcPr>
                <w:p wsp:rsidR="00667469" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="00667469" wsp:rsidP="00B67D67">
                    <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/><w:rPr><w:b/></w:rPr></w:pPr></w:p>
                </w:tc><w:tc><w:tcPr><w:tcW w:w="6345" w:type="dxa"/></w:tcPr>
                <w:p wsp:rsidR="00667469" wsp:rsidRPr="00B67D67" wsp:rsidRDefault="00667469" wsp:rsidP="00B67D67">
                    <w:pPr><w:spacing w:after="0" w:line="240" w:line-rule="auto"/></w:pPr></w:p></w:tc>
            </w:tr>
        </w:tbl>
        <w:p wsp:rsidR="003067FE" wsp:rsidRDefault="003067FE" wsp:rsidP="003067FE"/>
        <w:p wsp:rsidR="003067FE" wsp:rsidRDefault="00667469" wsp:rsidP="003067FE">
            <w:r>
                <w:t>Registration No: ___________________________ Date: ____________________________________</w:t></w:r></w:p><w:p wsp:rsidR="00667469" wsp:rsidRDefault="00667469" wsp:rsidP="003067FE"><w:r><w:t>Total Score</w:t></w:r><w:proofErr w:type="gramStart"/><w:r><w:t>:_</w:t></w:r><w:proofErr w:type="gramEnd"/><w:r><w:t>_______________________________________________________________________</w:t></w:r></w:p><w:p wsp:rsidR="00667469" wsp:rsidRDefault="00667469" wsp:rsidP="003067FE"><w:r><w:t>Remark</w:t></w:r><w:proofErr w:type="gramStart"/><w:r><w:t>:_</w:t></w:r><w:proofErr w:type="gramEnd"/><w:r><w:t>____________________________________________________________________________________________________________________________________________________________</w:t>
            </w:r>
        </w:p>
        <w:p wsp:rsidR="00667469" wsp:rsidRDefault="00667469" wsp:rsidP="003067FE">
            <w:r><w:t>Committee Chairperson________________________________ </w:t></w:r>
            <w:proofErr w:type="gramStart"/>
            <w:r><w:t>Date :_</w:t></w:r>
            <w:proofErr w:type="gramEnd"/>
                <w:r><w:t>________________________</w:t></w:r>
        </w:p>
       


