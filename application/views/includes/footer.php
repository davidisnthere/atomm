<div id="remove" class="modal">
  <div style="width: 350px;margin-top: 120px;" class="modal-dialog" role="document">
    <div class="modal-content remove-model">
      <div class="modal-header">
        <h5 class="modal-title">Are  you sure Want to Remove ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div  class="modal-footer no-padding">
        <div class="row w-100 no-margin">
        	<div id="yes" data-dismiss="modal" class="col-sm-6 vbn vvg">
        		<i class="fa  fa-check"></i> &nbsp; Yes
        	</div>
        	<div data-dismiss="modal" class="col-sm-6 vbn">
        		<i class="fa  fa-times"></i> &nbsp;  No
        	</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--***************************** Footer Starts Here *****************************-->
 <footer>
     <div class="container">
       <div class="row">
         <div class="col-sm-7 col-10">
           <p>Copyright &copy; <script>document.write(new Date().getFullYear())</script> All Rights Reserved</p>
         </div>
         <div class="col-sm-4">
           <ul class="foot-sl">
             <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
             <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
             <li><a href=""><i class="fab fa-pinterest-p"></i></a></li>
             <li><a href=""><i class="fab fa-linkedin-in"></i></a></li>
             <li><a href=""><i class="fab fa-youtube"></i></a></li>
           </ul>
         </div>
       </div>
     </div>
 </footer><!------- Footer Here ------->

<div id="login-vue">

<!-- login Modal -->
<div class="modal fade" id="loginmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog login-model" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">User Login</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">
       <p class="hid" id="login-err">User Name or Password Wrong</p>
         <div class="row no-margin form-row">
           <div class="col-sm-4">
             <label for="">Email Address</label><span class="rit-coln">:</span>
           </div>
           <div class="col-sm-8">
             <input id="loemail" type="text" placeholder="Enter Email Address" class="form-control form-control-sm">
             <div class="smart-valid" id="loemail-err"></div>
           </div>
         </div>
         <div class="row no-margin form-row">
           <div class="col-sm-4">
             <label for="">Password</label><span class="rit-coln">:</span>
           </div>
           <div class="col-sm-8">
             <input id="lopswd" type="password" placeholder="Enter Password" class="form-control form-control-sm">
             <div class="smart-valid" id="lopswd-err"></div>
           </div>
         </div>
         <div class="row no-margin form-row">
           <div class="col-sm-4">

           </div>
           <div class="col-sm-8">
             <button v-on:click="userLogin" class="btn btn-sm btn-info"> Login </button>
             <a class="fp" href="<?php echo base_url() ?>pages/forgetPassword">Forget Password?</a>
           </div>
         </div>
         <div class="row no-margin form-row">
           <div class="col-sm-4">

           </div>
           <div class="col-sm-8">
             <button onclick="account_signup()" class="btn w-100 btn-danger btn-sm">Don't have account? Sign up!</button>
           </div>
         </div>
     </div>



   </div>
 </div>
</div><!-- Model Ends Here -->


 <!-- Sign Up Modal -->
<div class="modal fade" id="signupmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog login-model singup-model" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Sign Up </h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">
       <form onsubmit="return signup_submit()" method="post" action="<?php echo base_url() ?>users/add_users">
       <div class="row no-margin form-row">
           <div class="col-sm-4">
             <label for="">Full Name</label><span class="rit-coln">:</span>
           </div>
           <div class="col-sm-8">
             <input id="suname" type="text" name="name" placeholder="Enter Full Name" class="form-control form-control-sm">
             <div class="smart-valid" id="suname-err"></div>
           </div>
         </div>
         <div class="row no-margin form-row">
           <div class="col-sm-4">
             <label for="">Designation</label><span class="rit-coln">:</span>
           </div>
           <div class="col-sm-8">
             <input id="sudesig" type="text" name="designation" placeholder="Enter Designation" class="form-control form-control-sm">
             <div class="smart-valid" id="sudesig-err"></div>
           </div>
         </div>
         <div class="row no-margin form-row">
           <div class="col-sm-4">
             <label for="">Email Address</label><span class="rit-coln">:</span>
           </div>
           <div class="col-sm-8">
             <input v-on:blur="unic_email()" id="suemail" type="text" name="email_address" placeholder="Enter Email Address" class="form-control form-control-sm">
             <div class="smart-valid" id="suemail-err"></div>
           </div>
         </div>
         <div class="row no-margin form-row">
           <div class="col-sm-4">
             <label for="">Password</label><span class="rit-coln">:</span>
           </div>
           <div class="col-sm-8">
             <input id="supswd" name="password" type="password" placeholder="Enter Password" class="form-control form-control-sm">
             <div class="smart-valid" id="supswd-err"></div>
           </div>
         </div>
         <div class="row no-margin form-row">
           <div class="col-sm-4">
             <label for="">Confirmation</label><span class="rit-coln">:</span>
           </div>
           <div class="col-sm-8">
             <input id="suconfirm" type="password" placeholder="Password Confirmation" class="form-control form-control-sm">
             <div class="smart-valid" id="suconfirm-err"></div>
           </div>
         </div>
         <div class="row no-margin form-row">
           <div class="col-sm-4">

           </div>
           <div class="col-sm-8">
             <button  class="btn btn-sm btn-info"> Sign Up </button>
             <a onclick="show_login()" class="fp" href="">Have Account? Login</a>
           </div>
         </div>
        </form>
     </div>



   </div>
 </div>
</div><!-- Model Ends Here -->
</div>

<input type="hidden" id="base_url" value="<?php echo base_url() ?>">

</body>

   <script src="<?php echo base_url() ?>assets/js/jquery-3.2.1.min.js"></script>
   <script src="<?php echo base_url() ?>assets/js/popper.js"></script>
   <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
   <script src="<?php echo base_url() ?>assets/js/axios.min.js"></script>
   <script src="<?php echo base_url() ?>assets/js/vue.min.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/summer-note/summernote-lite.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/notify/notify.min.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/time-ago/timeago.min.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/crope-box/jquery.cropbox.js"></script>
   <script src="<?php echo base_url() ?>assets/plugins/crope-box/jquery.form.js"></script>
   <script src="<?php echo base_url() ?>assets/js/script.js"></script>
   <script src="<?php echo base_url() ?>assets/vue/common_vue.js"></script>
   <?php
   if(!empty($this->vue)){
    foreach ($this->vue as $vue) {  ?>
   			<script src="<?php echo base_url() ?>assets/<?php echo $vue;  ?>"></script>
   <?php } } ?>

</html>
