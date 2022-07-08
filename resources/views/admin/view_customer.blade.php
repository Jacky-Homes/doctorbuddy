@extends('layouts.adminlayout')
@section('content')


<?php $customerObject = $data['customerObject'] ?>

<div class="">
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Customer</h2>
                    <div class="clearfix"> </div>
                </div>
                <div class="x_content">       
                    
                    <div class="container nopad">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
    	<div class="row m-b-lg m-t-lg">
                <div class="col-lg-12 col-sm-12 col-xs-12">

                    <div class=" col-lg-3 col-sm-3 col-xs-12 text-center p-block">
                        
                        <img src="{{ asset("public/images")."/user.png"?>" width="80" height="80" class="img-circle circle-border m-b-md" alt="profile"> 

                        <div>
                            <h3>
                                <?php
                                    $nameArr=array();
                                    if(isset($customerObject->customer_fname) && $customerObject->customer_fname !='') {
                                     $nameArr[] = $customerObject->customer_fname;
                                    }
                                    if(isset($customerObject->customer_lname) && $customerObject->customer_lname !='') {
                                     $nameArr[] = $customerObject->customer_lname;
                                    }
                                    echo $hpName = ucfirst(implode(" ", $nameArr));
                                  ?>
                            </h3>
                            <div class="font-bold">
                            </div>
                        <address class="m-t-md address">
                            <?php 
                                                              
                            if(isset($customerObject->customer_zip) && $customerObject->customer_zip !=""){
                              echo $customerObject->customer_zip."<br>";
                            }
                            
                            if(isset($customerObject->customer_city) && $customerObject->customer_city !=""){
                                echo $customerObject->customer_city."<br>";
                            }
                            $addressArr =array();  
                            if(isset($customerObject->customer_state) && $customerObject->customer_state !=""){
                                $addressArr[]= $customerObject->customer_state;
                            }
                            if(isset($customerObject->countryname) && $customerObject->countryname !=""){
                                 $addressArr[]= $customerObject->countryname;
                             }                             
                           echo implode(",", $addressArr)."<br>";
                           ?>
                            
                            <abbr title="Phone">P:</abbr> <?php echo $customerObject->customer_phone_code ?>&nbsp;<?php echo $customerObject->customer_phone ?><br>
  <abbr title="Phone">Email:</abbr> <?php echo $customerObject->customer_email_id ?>  
                        </address>
                        </div>
                                                
                    </div>
                    <div class="col-lg-9 col-sm-9 col-xs-12">
                        <div class="ibox m-b-40">
                        <div class="ibox-content">
                            <h3 class="detail_heading">Created On:</h3>
                            <p class="small"><?php echo date(Config::get('constants.DATE_FORMAT'),  strtotime($customerObject->created_at));?></p>    
                        </div> 
                    </div> 
                    	<div class="ibox m-b-40">
                        <div class="ibox-content">
                            <h3 class="detail_heading">Updated On:</h3>
                            <p class="small">
                             <?php echo date(Config::get('constants.DATE_FORMAT'),  strtotime($customerObject->updated_at))?>
                        </div> 
                    </div>
                        <div class="ibox m-b-40">
                        <div class="ibox-content">
                            <h3 class="detail_heading">Current Status</h3>
                            <p class="small">
                                <?php echo $customerObject->status_name ; ?>  
                            </p>
                        </div> 
                    </div>      
                        
                    </div>
                </div>

            </div>
         
    </div>
                    </div>
                    <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                                <a href="{{ asset('admin/customer')?>">
                                    <button type="button" class="btn btn-primary">Back</button>
                                </a>
                                <a href="{{ asset('admin/casefiles/customer/'.$customerObject->customer_id)?>">
                                    <button type="button" class="btn btn-primary">Created Cases</button>
                                </a>                                
                                <button delete_id ="{{$customerObject->customer_id}}" type="button" class="btn btn-delete">Delete</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<script>
 var SITE_URL = "<?php echo $data['site_url'] ?>";
</script>
<script src="{{ asset('js/admin/list_customer.js'); ?>"></script> 

@stop
