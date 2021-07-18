<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<div class="content-wrapper" style="min-height: 1135.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>images/articles/<?php echo $userRow->profile_image; ?>" alt="User profile picture">
             <form  id="upload_form" method="post" enctype="multipart/form-data">
			
			 <div class="element">
                        <i class="fa fa-camera upload-img" style="margin-left: 130px;"></i>
						<input style="display:none;" type="file" name="imgUpload" id="imgUpload"/>
			  </div>
			  </form>
              <h3 class="profile-username text-center"><?php echo $userRow->user_name;?></h3>

              <p class="text-muted text-center">Senior Software Engineer</p>

             <!-- <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>-->

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i>Senior Software Engineer ,PHP,Laravel,Codeigniter,MYSQL,MongoDB,
			  Ajax,Jquery,Javascript,Laravel Lumen,Rest API</strong>
               <?php 
			    $string='';
				$string = strip_tags($userRow->about_us);
					if (strlen($string) > 200) {

					// truncate string
					$stringCut = substr($string, 0, 200);
					$endPoint = strrpos($stringCut, ' ');

					//if the string doesn't contain any space then it will cut without word basis.
					$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
				    //$string .= "...Read More";
					$string .= '...';
					}
			   
			   ?>
              <p class="text-muted">
               <?php echo $string;?>
              </p>

              <hr>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
			<?php 
			$activedef='';
			$active='';
			if($this->uri->segment(3)!=''){
				$active='active';
			}
			else
			{
				$activedef='active';
			}
				?>
           <li class="<?php echo $activedef;?>"><a href="#activity" data-toggle="tab">Settings</a></li>
           <li class="<?php echo $active;?>"><a href="#settings" data-toggle="tab">Change Password</a></li>
		   <li><?php echo $this->session->flashdata('message'); ?></li>
		   
           <!--<li><a href="#settings" data-toggle="tab">Change Password</a></li><li><span style="float:middle; margin-left:190px;"><?php echo $this->session->flashdata('message');?></span></li>-->
            </ul>
            <div class="tab-content">
              <div class="<?php echo $activedef;?> tab-pane" id="activity">
                <!-- Post -->
                 <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Profile/update_profile/<?php echo $userRow->id;?>" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Name" value="<?php echo $userRow->user_name;?>">
					  <?php echo form_error('about_us','<span class="help-block" style="color:red;"">','</span>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="username" name="username" placeholder="Email" value="<?php echo $userRow->username;?>">
                      <?php echo form_error('username','<span class="help-block" style="color:red;"">','</span>'); ?>
					</div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Contact Number</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="user_contact_number" name="user_contact_number" placeholder="Contact Number" value="<?php echo $userRow->user_contact_number;?>">
                      <?php echo form_error('user_contact_number','<span class="help-block" style="color:red;"">','</span>'); ?>
				   </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">About Us</label>

                    <div class="col-sm-10">
                      <textarea class="textarea" name="about_us"  id="about_us" placeholder="Place some text here"
                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $userRow->about_us;?></textarea>
                    <?php echo form_error('about_us','<span class="help-block" style="color:red;"">','</span>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Profile Image</label>

                    <div class="col-sm-10">
                      <input type="hidden" class="form-control" id="profile_image_old" name="profile_image_old" value="<?php echo $userRow->profile_image; ?>" placeholder="User Pic">
                      <input type="file" class="form-control" id="profile_image" name="profile_image" placeholder="User Pic">
					  <img height="40px;" width="40px;" src="<?php echo base_url();?>images/articles/<?php echo $userRow->profile_image; ?>">
					  <?php echo form_error('profile_image','<span class="help-block" style="color:red;"">','</span>'); ?>
                    </div>
                  </div>
                
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
             
              </div>
			  

              <div class="<?php echo $active;?> tab-pane" id="settings">
                <form class="form-horizontal" method="post" action="<?php echo base_url();?>Forgot/change_password/<?php echo $userRow->id;?>">
                 <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $userRow->user_email;?>">
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Old Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="password" id="password" class="form-control"  placeholder="Old Password" value="">
					  <?php echo form_error('password','<span class="help-block" style="color:red;"">','</span>'); ?>
                    </div>
                  </div>
				  
				  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">New Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="new_password" id="new_password" class="form-control"  placeholder="New Password">
                      <?php echo form_error('new_password','<span class="help-block" style="color:red;"">','</span>'); ?>
				   </div>
                  </div>
				  
				  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Confirm New Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="confirm_password" id="confirm_password" class="form-control"  placeholder="Confirm New Password">
                       <?php echo form_error('confirm_password','<span class="help-block" style="color:red;"">','</span>'); ?>
				   </div>
                  </div>
                 
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" name="changePass" id="changePass" class="btn btn-danger" value="Submit">
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  
  
  <!-- CK Editor -->
<script src="<?php echo base_url();?>assets/admin/bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url();?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
   $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('about_us')
    //bootstrap WYSIHTML5 - text editor
   // $('.textarea').wysihtml5()
  })
  
</script>