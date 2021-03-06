
<table >
    <tr>
        <td></td>
        <td align="left">
            <b><h3><u>FIle No :<?php echo $report['customer_fileno'];?></u></h3></b>
        </td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
<!--    <tr><td>Email</td><td align="left">&nbsp; : &nbsp;<?php //echo $report['customer_email_id'];?></td></tr>-->
    <tr><td>Nick Name</td><td align="left">&nbsp; : &nbsp;<?php echo $report['customer_nickname'];?></td></tr>
    <?php if($report['customer_for_whom'] != ''){ ?>
    <tr><td>For</td><td align="left">&nbsp; : &nbsp;<?php echo $report['customer_for_whom'];?></td></tr>
    <?php } ?>
    <?php if($report['customer_age'] != ''){ ?>
    <tr><td>Age</td><td align="left">&nbsp; : &nbsp;<?php echo $report['customer_age'];?></td></tr>
    <?php } ?>
    <?php if($report['customer_sex'] != ''){ ?>
    <tr><td>Sex</td><td align="left">&nbsp; : &nbsp;<?php echo $report['customer_sex'];?></td></tr>
    <?php } ?>

    <tr><td>Area</td><td align="left">&nbsp; : &nbsp;<?php echo $report['customer_area'];?></td></tr>

    <tr><td>Zipcode</td><td align="left">&nbsp; : &nbsp;<?php echo $report['customer_zip'];?></td></tr>
    <tr><td>known_disease</td><td align="left">&nbsp; : &nbsp;<?php echo $report['known_disease'];?></td></tr>
    <tr><td>Past illness history</td><td align="left">&nbsp; : &nbsp;<?php echo $report['customer_past_illness_history'];?></td></tr>

    <!-- Start: Uploaded Files Section -->
    <?php
    $customerDetailId = $report['customer_detail_id'];
    $files = DB::table('customer_files')->where('customer_detail_id', '=', $customerDetailId)->get();
    if(count($files)>0){ 
    ?>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2" align="left"><b>Uploaded Files</b></td></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr>
    <td></td>
    
    <td> 
    <?php foreach($files as $file) { ?>
    <p>&nbsp; : &nbsp;
        <a href="{{ asset("uploads/files/".$file->file_name);?>" target="_blank">
        <?php echo $file->file_name ?>
        </a>    
    </p>
    <?php } ?>
    </td>
    </tr>   
    <?php } ?>

    <!-- End: Uploaded Files Section -->
    
    <!-- Start: Drop box Files Section -->
    <?php
    $dropboxFiles = $report['dropbox_files'];
    if(count($dropboxFiles)>0){ 
    ?>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2" align="left"><b>Drop Box Files</b></td></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr>
    <td></td>
    
    <td> 
    <?php foreach($dropboxFiles as $dropboxFile) { ?>
    <p>&nbsp; : &nbsp;
        <a href="<?php echo $dropboxFile ;?>" target="_blank">
        <?php echo $dropboxFile ?>
        </a>    
    </p>
    <?php } ?>
    </td>
    </tr>   
    <?php } ?>

    <!-- End: Drop box Files Section -->
    

    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td>Hereditary Disease</td><td align="left">&nbsp; : &nbsp;<?php echo $report['customer_hereditary_disease'];?></td></tr>
    <tr><td>Allergic Reaction</td><td align="left">&nbsp; : &nbsp;<?php echo $report['customer_allergic_reaction'];?></td></tr>
    <tr><td>Height</td><td align="left">&nbsp; : &nbsp;<?php echo $report['customer_height'];?> &nbsp; <?php echo $report['customer_height_unit'];?></td></tr>
    <tr><td>Weight</td><td align="left">&nbsp; : &nbsp;<?php echo $report['customer_weight'];?>&nbsp; <?php echo $report['customer_weight_unit'];?></td></tr>
    <tr><td>Created On</td><td align="left">&nbsp; : &nbsp;<?php echo date(Config::get('constants.DATE_FORMAT'),  strtotime($report['created_at']));?></td></tr>
    <tr><td>Updated On</td><td align="left">&nbsp; : &nbsp;<?php echo date(Config::get('constants.DATE_FORMAT'),  strtotime($report['updated_at']));?></td></tr>

    <!-- Start: Physical Symptoms -->
    <?php if(isset($report['symptoms_his']) && count($report['symptoms_his'])>0 ){ $j=1;?>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2" align="left"><b>Physical Symptoms</b></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <?php 
    $l=0;$key_mod = array();
    foreach($report['symptoms_his'] as $key=>$symptomshis){                                    
    ?>
    <?php $l++; $key_mod[] = $key; $m =0;?>
    <?php      
    foreach($symptomshis as  $symptoms){ 
    ?>
    <tr>
    <?php if($m==0){ ?>
    <td><?php echo $symptoms['symptom_name'];?></td>
    <?php } ?>
    
    <td align="left">&nbsp; : &nbsp;
    <?php     
    if(count($symptoms['symptom_rate']) > 0){
    
        for($i=1;$i<=$symptoms['symptom_rate'];$i++){ 
            echo "*";   
        }
    echo ",";    
    }
    ?>
    &nbsp;
    <?php if($symptoms['customer_note'] != null){ echo $symptoms['customer_note'].",";} ?>

    <?php echo date(Config::get('constants.DATE_FORMAT'),  strtotime($symptoms['date_added']));?>
    </td>    
    </tr>


    <?php
    $m++;
    }  //foreach ?>
    <?php  }} ?>  

    <!-- End: Physical Symptoms -->

    <!-- Start: Question& Answers -->
    <?php if(isset($report['answers']) && count($report['answers'])>0){
    $group_idarr = array();
    ?>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2" align="left"><b>Question's Response</b></tr>

    <?php foreach($report['answers'] as $answers){ ?>    
    <?php 
    if(count($group_idarr)==1 && $answers->group_id!='1'){ 
    }
    ?>

    <?php  if(!in_array($answers->group_id,$group_idarr) && $answers->group_name!=''){
    $group_idarr[] = $answers->group_id;
    ?>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td ></td><td><u><?php echo $answers->group_name;?></u></td>
    <tr><td colspan="2">&nbsp;</td></tr>
    <?php } ?>

    <tr><td >
    <td>
    <?php $qn_remain ='';
    if (strpos($answers->question,'OPTION') !== false) {
        $pos = strpos($answers->question,'OPTION');
        echo substr($answers->question,0,$pos-1);
        $qn_remain = substr($answers->question,$pos+8);
    }else{
        echo $answers->question.":"; 
    }
    ?>
    <em><strong><?php echo $answers->option_val;?></strong></em>
    <?php if($qn_remain != ''){ echo $qn_remain; } ?>
    </td></tr>    
    <?php }} ?>
    <!-- End: Question& Answers -->



</table>
