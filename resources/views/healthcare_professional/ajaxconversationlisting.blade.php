<?php foreach ($conversations as $conversation):  ?>

<?php
$customerDetailObj = DB::table('customer_detail')->where('customer_detail_id','=',$conversation->customer_detail_id)->first();
$nickName = $customerDetailObj->customer_nickname;                          
?>  

<?php if($conversation->healthcare_comment): ?>
<div class="row  m-b m-l" >
    <div class="form-group">
        <div class="col-lg-6  col-sm-6 col-sx-6 c_h_rows">
            <p><b>You</b></p> 
            <div class="col-lg-8  col-sm-8 col-sx-8 no-pad"><?php echo  $conversation->healthcare_comment ?></div>
            <div class="col-lg-4  col-sm-4 col-sx-4 text-right"><?php echo date(Config::get('constants.DATE_TIME_FORMAT'),  strtotime($conversation->date)); ?></div>
        </div>
    </div>
</div>                        

<?php else: ?>
<div class="row  m-b m-l">
    <div class="form-group">
        <div class="col-lg-6  col-sm-6 col-sx-6">
        </div>
        <div class="col-lg-6  col-sm-6 col-sx-6 c_h_rows" >
            <p style="color:#00243F"><b><?php echo $nickName; ?></b></p>
            <div class="col-lg-8  col-sm-8 col-sx-8 no-pad"><?php echo  $conversation->customer_comment ?></div>
            <div class="col-lg-4  col-sm-4 col-sx-4 text-right"><?php echo date(Config::get('constants.DATE_TIME_FORMAT'),  strtotime($conversation->date)); ?></div>
        </div>                                                                        
    </div>
</div>                        
<?php endif;?>
<?php endforeach ;?>
