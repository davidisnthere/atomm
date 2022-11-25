<?php
error_reporting(1);
?>

<div class="side-menu-profile">
  <div class="profile-cover">
  <button   onclick="imageChosed()" class="btn btn-info ch-img btn-sm">
          <i class="fas fa-pencil-alt"></i>
        </button>
    <img id="altimage"  src="<?php echo base_url() ?>upload/users/<?php echo $this->single->image; ?>" alt="">
    <img class="hid" id="cropimage" style=" width:200px;" src="<?php echo base_url() ?>upload/users/<?php echo $this->single->image; ?>" alt="">
    <div class="cover-layy">
    </div>
      <div style="display:none" id="results1"> <b>X</b>: <span class="cropX1"></span> <b>Y</b>: <span class="cropY1"></span> <b>W</b>: <span class="cropW1"></span> <b>H</b>: <span class="cropH1"></span> </div>
        <div class="row">
          <div id="pb" style="width:100%; height:10%; display:none; height:10px;  margin:auto; margin-top:5px;" class="progress progress-striped active progress-xs">
            <div id="pbc" class="progress-bar bg-success"  role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
              <span class="sr-only"> 60% Complete</span>
            </div>
          </div>
        </div>
        <div class=" center top-mar">
         
         
          <button onclick="crope1()" id="sav" style=" display:none" class="btn btn-info btn-sm">Save</button>
        </div>
    <h2><?php echo $this->single->name; ?></h2>
    <p><?php echo $this->single->designation; ?></p>
  </div>
  <ul>
    <li>
  <a href="<?php echo base_url() ?>users/dashboard">
    <i class="fas fa-tachometer-alt"></i> Dashboard
  </a>
    </li>
    <li>
  <a href="<?php echo base_url() ?>pages/new_post">
  <i class="far fa-edit"></i> New Post
  </a>
    </li>
    <li>
      <a href="<?php echo base_url() ?>users/my_post">
        <i class="far fa-comments"></i> My Posts
  </a>
    </li>
    <li>
  <a href="<?php echo base_url() ?>users/my_replay">
    <i class="fas fa-retweet"></i> My threads
  </a>
    </li>
    <li>
  <a href="<?php echo base_url() ?>users/settings">
    <i class="fas fa-cogs"></i> Settings
  </a>
    </li>
    <li>
    <a href="<?php echo base_url() ?>users/log_out">
    <i class="fas fa-sign-out-alt"></i> Logout
    </a>
    </li>
  </ul>
</div>

<form method="post" action="<?php echo base_url() ?>users/profileupload" enctype="multipart/form-data" id="myForm">
    <input type="file"   id="userfile" style="opacity:0.0" name="userfile">
</form>
