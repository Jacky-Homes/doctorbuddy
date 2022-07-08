@extends('layouts.healthcarelayout')
@section('content')

<div id="login-wrap" class="text-center">
    <h3>Partial Signup </h3>
    <div class="alert alert-danger hide" id="message-text" ></div>
    <?php if(Session::get('flash_msg') != ''){?>
    <div class="success-alert" id="" ><?php echo Session::get('flash_msg');?></div>
    <?php } ?>
    <!-- Already Logined as other type user -->
    <?php if(isset( $_SESSION['counselor_id']) && $_SESSION['counselor_id'] != ''){ ?>
    <div class="warning-alert">Warning : Your Counselor Session Will Be Cleared.</div>
    <?php }elseif (isset( $_SESSION['customer_id']) && $_SESSION['customer_id'] != '') { ?>
        <div class="warning-alert">Warning : Your Customer Session Will Be Cleared.</div>
    <?php  }  ?>  

    <form class="m-t" role="form" action="javascript:void(0);"  id="partial-signup-form" name="partial-signup-form" >
        <div class="form-group item">
            <input id="healthcare_professional_password" name="healthcare_professional_password" value="" title="Password" required="required" class="form-control" type="password" placeholder="Password">
        </div>
        <div class="form-group item">
            <input id="confirm_healthcare_professional_password" name="confirm_healthcare_professional_password" value="" title="Confirm Password" required="required" class="form-control" type="password" placeholder="Confirm Password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-red block full-width m-b" onclick="return hp_partial_signup_check();">Login</button>
            <input type="hidden" name="form_submit" value="submit">
        </div>        
    </form>    
</div>

<script>
    var REDIRECT = "<?php echo$data['redirect'] ?>";
    var SITE_URL = "<?php echo $data['site_url'] ?>";
</script>
<script src="{{ asset('js/healthcare_professional/partial_signup.js'); ?>"></script>
@stop