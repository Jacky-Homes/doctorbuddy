@extends('layouts.counselorlayout')
@section('content')
<h3>Counselor Registration</h3>

<form action="javascript:void(0);" id="qform" name="qform" class="form-label-left" method="post"  role="form" >
                                    
    <div class="col-lg-12 col-sm-12  col-sx-12 m-t-xl registration-wrap left no-pad">
        <div id="message"  class="hide col-lg-12 col-sm-12 col-sx-12">
            <div id="message-text"></div>
        </div>

        <div class="col-lg-12 col-sm-12 col-sx-12 no-pad">
            <div class="form-group col-lg-6 col-sm-6 col-sx-12 no-pad item right-pad">
                <label>First Name</label> 
                <input  id="counselors_firstname" name="counselors_firstname"  required="required" title="First Name" class="form-control" type="text">
            </div>
            <div class="form-group col-lg-6 col-sm-6 col-sx-12 no-pad  left-pad">
                <label>Middle Name</label> 
                <input  id="counselors_middlename" name="counselors_middlename"   title="Middle Name" class="form-control" type="text">
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-sx-12 no-pad">
            <div class="form-group col-lg-6 col-sm-6 col-sx-12 no-pad item right-pad">
                <label>Last name</label> 
                <input  id="counselors_lastname" name="counselors_lastname"  required="required" title="Last Name" class="form-control" type="text">
            </div> 
            <div class="form-group col-lg-6 col-sm-6 col-sx-12 no-pad item left-pad">
               <label>Email Address</label> 
               <input id="counselors_email_id" name="counselors_email_id" required="required" title="Email" class="form-control" type="email">
            </div>           
        </div>
    
        <div class="col-lg-12 col-sm-12 col-sx-12 no-pad">
            <div class="form-group col-lg-6 col-sm-6 col-sx-12 no-pad item right-pad">
               <label>Password</label> 
               <input id="password" name="password" required="required" title="Password" class="form-control" type="password"  >
            </div>
            <div class="form-group col-lg-6 col-sm-6 col-sx-12 no-pad item left-pad">
                <label>Repeat Password</label> 
                <input  id="password2"  data-validate-linked="password" name="password2"  required="required" title="Repeat Password" class="form-control"  type="password">
            </div>            
        </div>
        <div class="col-lg-12 col-sm-12 col-sx-12 no-pad">
            <div class="form-group col-lg-6 col-sm-6 col-sx-12 no-pad item right-pad">
                <label>Country</label> 
                <?php if(count($country)>0){ ?>
                 <select class="form-control required" name="customer_country" title="Country"  id="customer_country" onchange="javascript:getCountryState(this);">
                             <option value="" >Select Country</option>
                            <?php 
                            foreach($country as $val){  ?>
                            <option value="<?php echo $val['country_id'];?>" ><?php echo $val['countryname'];?></option>
                       <?php } ?>
                </select>
                <?php } ?>
            </div>
            <div class="form-group col-lg-6 col-sm-6 col-sx-12 no-pad item left-pad">
               <label>State</label> 
               <div id="state_1">
               <select class="form-control" name="customer_state_select" title="State" id="customer_state_select"></select>
               </div>
               <div style="display:none" id="state_2"></div>
           </div>           
        </div>
        <div class="col-lg-12 col-sm-12 col-sx-12 no-pad">
            <div class="form-group col-lg-6 col-sm-6 col-sx-12 no-pad item right-pad">
                <label>City/Area</label> 
                <input id="counselors_city" name="counselors_city" title="City" class="form-control" type="text" required="required">
            </div>
            <div class="form-group col-lg-6 col-sm-6 col-sx-12 no-pad item left-pad">
               <label>Phone No.</label> 
               <input id="counselors_phone" name="counselors_phone" required="required" title="Phone Number" class="form-control" maxlength="11" max="99999999999" type="number">
            </div>
            
        </div>
        <div class="col-lg-12 col-sm-12 col-sx-12 no-pad">
             <div class="form-group col-lg-6 col-sm-6 col-sx-12 no-pad item right-pad">
                <label>Zipcode</label> 
                <input  id="counselors_zip" name="counselors_zip"  required="required" title="Zipcode" class="form-control"  maxlength="11"  type="text">
            </div>
           <div class="form-group col-lg-6 col-sm-6 col-sx-12 no-pad left-pad">
               <label>                                            
                   Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh.
               </label>
               <div class="item">
               <input id="captcha_code" name="captcha_code"  required="required" title="Captcha Code" class="form-control" type="text" >
               </div>
               <span class="col-lg-12 col-sm-12 col-sx-12 m-t no-pad">
                  <img src="{{ asset('js/captcha.php?rand='.rand()); ?>" id='captchaimg'> 
               </span>

               <div class="alertuck col-lg-12 col-sm-12 col-sx-12" id="captcher" ></div>
           </div>            
        </div>
        
        <div class="col-lg-12 col-sm-12 col-sx-12 no-pad">


            <div class="col-lg-12 col-sm-12 col-sx-12 no-pad">
               <div class="form-group col-lg-12 col-sm-12 col-sx-12 no-pad item right-pad">    
                   <input  id="terms" name="terms" value="1" required="required" title="Terms & Conditions" type="checkbox" />  
                   <span>I agree to Doctorbuddy 
                       <a href="javascript:void(0);"  onclick='window.open("{{ asset('home/contents/terms-conditions-provider'); ?>");'>Terms & Conditions</a> 
                       ,
                       <a href="javascript:void(0);"  onclick='window.open("{{ asset('home/contents/privacy-policy'); ?>");'>Privacy Policy</a>
                   </span>
               </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-xs-12 no-pad">
                <button type="submit" title="Register" onclick="return register();"  class="btn btn-red" role="button">Register</button>     
            </div>
            <div class="col-lg-12 col-sm-12 col-sx-12 no-pad"  >
                    <div id="deficiency_message" class="hide">
                        <div class="error-alert"><i class="fa-fw fa fa-times"></i><strong>Error! Please enter missing data as mentioned above</strong></div>
                    </div>
            </div>            
       </div>       
  
                        

    </div>
                                           
</form>

                   
<script src="{{ asset('js/counselor/register.js'); ?>"></script>    


@stop

