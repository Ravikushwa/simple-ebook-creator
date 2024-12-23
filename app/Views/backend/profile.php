<!-- Container Start -->
<?php $userinfo = isset($user)?$user:array();?>
<div class="page-wrapper">
    <div class="main-content">        
        <div class="ebook-profile-wrapper">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8 col-sm-12 col-md-10 col-12">
                        <div class="ebook-profile-section">
                            <div  class="d-flex flex-wrap w-100 justify-content-center">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <form class="form" method="post" enctype="multipart/form-data">
                                        <div class="profile-img-wrap">
                                            <div class="avatar-upload">
                                                <div class="avatar-preview">
                                                    <div id="profilePreview" style="background-image: url(<?= isset($userinfo['profile_pic']) && !empty($userinfo['profile_pic']) ? base_url().'uploads/user-'.$UserID.'/'.$userinfo['profile_pic'] :  base_url().'assets/images/user-img.jpg'?>);"></div>
                                                </div>
                                                <div class="avatar-edit">
                                                    <input type='file' id="profileUpdate" name="profile-logo" accept=".png, .jpg, .jpeg" />
                                                    <label for="profileUpdate">
                                                        Change Profile Picture
                                                        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"><path fill="currentColor" data-original="#000000" d="M18.656.93,6.464,13.122A4.966,4.966,0,0,0,5,16.657V18a1,1,0,0,0,1,1H7.343a4.966,4.966,0,0,0,3.535-1.464L23.07,5.344a3.125,3.125,0,0,0,0-4.414A3.194,3.194,0,0,0,18.656.93Zm3,3L9.464,16.122A3.02,3.02,0,0,1,7.343,17H7v-.343a3.02,3.02,0,0,1,.878-2.121L20.07,2.344a1.148,1.148,0,0,1,1.586,0A1.123,1.123,0,0,1,21.656,3.93Z"></path><path fill="currentColor" data-original="#000000" d="M23,8.979a1,1,0,0,0-1,1V15H18a3,3,0,0,0-3,3v4H5a3,3,0,0,1-3-3V5A3,3,0,0,1,5,2h9.042a1,1,0,0,0,0-2H5A5.006,5.006,0,0,0,0,5V19a5.006,5.006,0,0,0,5,5H16.343a4.968,4.968,0,0,0,3.536-1.464l2.656-2.658A4.968,4.968,0,0,0,24,16.343V9.979A1,1,0,0,0,23,8.979ZM18.465,21.122a2.975,2.975,0,0,1-1.465.8V18a1,1,0,0,1,1-1h3.925a3.016,3.016,0,0,1-.8,1.464Z"></path></svg>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="progress" style="margin-top: 10px; display: none;">
                                            <progress id="progressBar" value="0" max="100"></progress>
                                            <span id="percentage"></span>
                                        </div>
                                    </form>
                                </div>                              
                                <div class="ebook-profile-fields">
                                    <form class="form">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="ebook-input-feilds">
                                                    <label>
                                                            User Name
                                                        </label>
                                                    <input type="text" name="user-name" value="<?= $userinfo['user_name'];?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="ebook-input-feilds">
                                                    <label>
                                                            User Email Address
                                                        </label>
                                                    <input type="eamil" readonly name="user-email" value="<?= $userinfo['user_email'];?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="ebook-input-feilds ebook-password-filed">
                                                    <label>
                                                        Current Password
                                                    </label>
                                                    <div>
                                                        <input id="password-field" type="password" placeholder="Enter Password" name="password" value="">
                                                        <span toggle="#password-field" class="toggle-password">
                                                            <img src="<?=base_url();?>assets/images/user/eye.svg" alt="" class="eye">
                                                            <img src="<?=base_url();?>assets/images/user/open-eye.svg" alt="" class="open-eye">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="ebook-input-feilds ebook-password-filed">
                                                    <label>
                                                        New Password
                                                    </label>
                                                    <div>
                                                        <input id="password_field" type="password"  placeholder="Enter New Password" name="Cpassword" value="">
                                                        <span toggle="#password_field" class="toggle-pass">
                                                            <img src="<?=base_url();?>assets/images/user/eye.svg" alt="" class="eye">
                                                            <img src="<?=base_url();?>assets/images/user/open-eye.svg" alt="" class="open-eye">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ebook-btn-wrap mt-3 justify-content-start">
                                                <button type="button" class="ebook-btn user-update-password">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>