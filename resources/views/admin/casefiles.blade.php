@extends('layouts.adminlayout')
@section('content')

<div class="">

    <div class="clearfix"></div>

    <div class="row">

        
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_title">
                    
                    <h3 class="pagehd">Case Files</h3>
                    <div class="clearfix">  </div>
                    
                </div>
                <?php if(Session::get('flash_msg') != ''){?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="alert alert-success" id="" ><?php echo Session::get('flash_msg');?></div>
                </div>                               
                <?php } ?>
                <div class="x_content">
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                                <th>SL No.</th>
                                <th>Nick Name</th>
                                <th>Code</th>
                                <th>Assigned Providers</th>
                                <th>Assigned Counselors</th>
                                <th>Created On</th>
                                <th>Option</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                            $i = 0;
                            foreach($caseFileDetails as $caseFileDetail){ 
                                 $hpObjs = DB::table('casefile_to_healthcare')
                                         ->leftjoin('healthcare_professional','casefile_to_healthcare.healthcare_professional_id','=','healthcare_professional.healthcare_professional_id')
                                         ->where('casefile_to_healthcare.customer_detail_id','=',$caseFileDetail->customer_detail_id)
                                         ->get();
                                 $hpArr =array();
                                 foreach ($hpObjs as $hpObj){
                                    $name = $hpObj->healthcare_professional_first_name;
                                     if($hpObj->healthcare_professional_middle_name !='')
                                         $name .= " ".$hpObj->healthcare_professional_middle_name;
                                    $name .= " ".$hpObj->healthcare_professional_last_name; 
                                      
                                    $conversationCount=DB::table('casefile_conversations')
                                            ->where('customer_detail_id','=',$caseFileDetail->customer_detail_id)
                                            ->where('healthcare_professional_id','=',$hpObj->healthcare_professional_id)->count();
                                     $conversation_link='';
                                    if($conversationCount>0)
                                    {    
                                        $conversation_link='<a href="'.asset('admin/conversation/'.$hpObj->casefile_to_healthcare_id) .'">
                                        <i title="Conversations" aria-hidden="true" class="fa fa-comments fa-4"></i>
                                        </a>';
                                    }
                                    
                                     $hpArr[] = $name.' '.$conversation_link;
                                 }    
                                    // for assigned counselors
                                     
                                     $counObjs = DB::table('casefile_to_counselor')
                                         ->leftjoin('counselors','casefile_to_counselor.counselor_id','=','counselors.counselors_id')
                                         ->where('casefile_to_counselor.customer_detail_id','=',$caseFileDetail->customer_detail_id)
                                         ->where('counselors.counselors_status','!=',0)   
                                         ->get();
                                 $counArr =array();
                                 foreach ($counObjs as $counObj){
                                    $name = $counObj->counselors_firstname;
                                     if($counObj->counselors_middlename !='')
                                         $name .= " ".$counObj->counselors_middlename;
                                    $name .= " ".$counObj->counselors_lastname; 
                                         
                                     $counArr[] = $name;
                                 }
                            ?>

                                <tr class="even pointer">
                                    <td class=" ">{{++$i}}</td>
                                    <td class=" ">{{$caseFileDetail->customer_nickname}}</td>
                                    <td class=" ">{{$caseFileDetail->customer_code }}</td>
                                    <td class=" "><?php if(count($hpArr) >0) { echo implode("<br>",$hpArr); } ?></td>
                                    <td class=" "><?php if(count($counArr) >0) { echo implode("<br>",$counArr); } ?></td>
                                    <td class=" "><?php echo date(Config::get('constants.DATE_FORMAT'),strtotime($caseFileDetail->created_at));?></td>
                                    <td class=" ">
                                        <a href="<?php echo $data['site_url'] ?>/admin/viewcasefile/<?php echo $caseFileDetail->customer_detail_id ?>">
                                            <i aria-hidden="true" class="fa fa-file-excel-o fa-4" title="View Case File"></i>
                                        </a>
                                        &nbsp;
                                        <a href="<?php echo $data['site_url'] ?>/admin/assignprovider/<?php echo $caseFileDetail->customer_detail_id?>">
                                            <i class="fa fa-hand-o-up fa-4" aria-hidden="true" title="Assign To Provider"></i>
                                        </a>
                                        &nbsp;
                                        <a href="<?php echo $data['site_url'] ?>/admin/assigncounselor/<?php echo $caseFileDetail->customer_detail_id?>">
                                            <i class="fa fa-hand-o-up fa-4" aria-hidden="true" title="Assign To Counselor"></i>
                                        </a>
                                    </td>
                                </tr>   
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <br />
        <br />
        <br />

    </div>
</div>
<script>
 var SITE_URL = "<?php echo $data['site_url'] ?>";
</script>
<script src="{{ asset('js/admin/list_hp.js'); ?>"></script>
@stop

