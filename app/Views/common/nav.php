<?php 
	$usersTxt = $cu_role == md5('adm')? 'Users' : 'Agency';
	$level = explode(',', $user['access_level']);	
	$redirect = $user['user_role'] == md5('adm')? base_url() . 'users' : base_url() . 'dashboard';
?>

<!-- Header Start -->
<header class="header-wrapper">
    <div class="header-inner-wrapper">
        <div class="row m-0 justify-content-between">
            <div class="page-title-wrapper">
                <a href="javascript:void(0);" class="toggle-btn">
                    <span></span>
                </a>
                    <!-- Header Logo -->
                <div class="logo-wrapper">
                    <a href="<?=base_url();?>" class="admin-logo">
                        <img src="<?=base_url();?>assets/images/logo.png" alt="">
                    </a>
                </div>
                <div class="page-title-box">
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
            <div class="user-info-wrapper">
                <a href="javascript:void(0);" class="user-info">
                    <div class="drop-down-header">
                        <h4>Welcome!</h4>
                        <p><?= isset($user['user_name']) && !empty($user['user_name']) ? $user['user_name'] : 'User'; ?></p>
                    </div>
                    <img class="user-profile-header-logo" src="<?= isset($user['profile_pic']) && !empty($user['profile_pic']) ? base_url().'/uploads/user-'. get_userid().'/'.$user['profile_pic'] :  base_url().'assets/images/user-img.jpg'?>" alt="" class="user-img">
                </a>
                <div class="user-info-box">
                    <ul>
                     <?php if(isset($user['user_role']) && $user['user_role'] !=4) {?>
                        <li>
                            <a href="<?=base_url('profile');?>">
                                <span class="ebook-head-svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"><path  fill="currentColor" data-original="#000000" d="M18.656.93,6.464,13.122A4.966,4.966,0,0,0,5,16.657V18a1,1,0,0,0,1,1H7.343a4.966,4.966,0,0,0,3.535-1.464L23.07,5.344a3.125,3.125,0,0,0,0-4.414A3.194,3.194,0,0,0,18.656.93Zm3,3L9.464,16.122A3.02,3.02,0,0,1,7.343,17H7v-.343a3.02,3.02,0,0,1,.878-2.121L20.07,2.344a1.148,1.148,0,0,1,1.586,0A1.123,1.123,0,0,1,21.656,3.93Z"/><path  fill="currentColor" data-original="#000000" d="M23,8.979a1,1,0,0,0-1,1V15H18a3,3,0,0,0-3,3v4H5a3,3,0,0,1-3-3V5A3,3,0,0,1,5,2h9.042a1,1,0,0,0,0-2H5A5.006,5.006,0,0,0,0,5V19a5.006,5.006,0,0,0,5,5H16.343a4.968,4.968,0,0,0,3.536-1.464l2.656-2.658A4.968,4.968,0,0,0,24,16.343V9.979A1,1,0,0,0,23,8.979ZM18.465,21.122a2.975,2.975,0,0,1-1.465.8V18a1,1,0,0,1,1-1h3.925a3.016,3.016,0,0,1-.8,1.464Z"  fill="currentColor" data-original="#000000"/></svg>
                                </span>
                                    Edit Profile
                            </a>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="<?=base_url().'logout';?>">
                                <span class="ebook-head-svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path d="M11.476 15a1 1 0 0 0-1 1v3a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3h2.476a3 3 0 0 1 3 3v3a1 1 0 0 0 2 0V5a5.006 5.006 0 0 0-5-5H5a5.006 5.006 0 0 0-5 5v14a5.006 5.006 0 0 0 5 5h2.476a5.006 5.006 0 0 0 5-5v-3a1 1 0 0 0-1-1Z" fill="currentColor" data-original="#000000"/><path d="m22.867 9.879-4.586-4.586a1 1 0 1 0-1.414 1.414l4.263 4.263L6 11a1 1 0 0 0 0 2l15.188-.03-4.323 4.323a1 1 0 1 0 1.414 1.414l4.586-4.586a3 3 0 0 0 .002-4.242Z" fill="currentColor" data-original="#000000"/></g></svg>
                                </span>
                                    Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
 <!-- Sidebar Start -->
<aside class="sidebar-wrapper">
    <div class="side-menu-wrap">
        <div class="aside-navigation">
            <ul class="main-menu">
                <li>
                    <a href="<?=base_url('dashboard');?>" class="<?=isset($page)&&$page=="dashboard"? "active" : "";?>">
                        <span class="icon-menu feather-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 512 512"><g><path d="M19 18.8C31.1 6.8 47.4.2 64.4.3 91.1.2 117.2.2 142 .2h39.4c33.9.1 62 28.2 62.6 62.8.7 41.3.7 79.7 0 117.2-.7 35.9-28.4 63.3-64.5 63.7-19.5.3-39.1.4-58.2.4-55.4.5-116.2 7.5-120.9-66 .2-21.5 0-42.7 0-64.1C1.7 82.2-7 43.1 19 18.8zM244.1 379.6c0 21.2-.1 43.2.1 64.8 1 36.2-28.7 68-64.9 67.4-30-.7-62.4.1-92.8-.1-23.9 1.1-50.5-.2-67.5-18.7C2.5 477.7-1.1 453.6.3 431.6c-.1-32.9-.1-66.9.2-100.4.1-28.6 19.4-53.5 47-60.8 25.8-5.2 49.9-1.6 78.9-2.7 16.7 0 33.3 0 50 .1 69.1 3.6 69.9 56.7 67.7 111.8zM476.1 303.7c76.3 75.4 21.3 208.8-86.2 208.1-106.8.6-163.2-132.6-86.2-207.9 45.5-47.5 126.9-48 172.4-.2zM268 178.9c-.5-40.7-.5-78.2 0-114.5C267.9 29.1 296.5.3 331.8.2h.8c38.3-.3 76.5-.3 116.5 0 33.1-.5 62.9 29.6 62.5 62.7.2 22.3 0 44.2 0 66.3-1.1 32 6.9 71.7-18.7 95.9-26.1 27.3-69.4 17-103.2 19.1-19.2 0-38.4-.1-57-.4-35.6.1-64.6-28.6-64.7-64.3v-.6z" fill="currentColor" opacity="1" data-original="#000000"/></g></svg>
                        </span>
                        <span class="menu-text">
                            Dashboard
                        </span>
                    </a>
                </li>
                <?php if(in_array('OTO5',$level) || in_array('OTO5_UL',$level)){?>
                <li>
                    <a href="<?=base_url('user');?>" class="<?=isset($page)&&$page=="user"? "active" : "";?>">
                        <span class="icon-menu">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 511.999 511.999"><g><path d="M438.09 273.32h-39.596c4.036 11.05 6.241 22.975 6.241 35.404v149.65c0 5.182-.902 10.156-2.543 14.782h65.461c24.453 0 44.346-19.894 44.346-44.346v-81.581c.001-40.753-33.155-73.909-73.909-73.909zM107.265 308.725c0-12.43 2.205-24.354 6.241-35.404H73.91c-40.754 0-73.91 33.156-73.91 73.91v81.581c0 24.452 19.893 44.346 44.346 44.346h65.462a44.144 44.144 0 0 1-2.543-14.783v-149.65zM301.261 234.815h-90.522c-40.754 0-73.91 33.156-73.91 73.91v149.65c0 8.163 6.618 14.782 14.782 14.782h208.778c8.164 0 14.782-6.618 14.782-14.782v-149.65c0-40.754-33.156-73.91-73.91-73.91zM256 38.84c-49.012 0-88.886 39.874-88.886 88.887 0 33.245 18.349 62.28 45.447 77.524 12.853 7.23 27.671 11.362 43.439 11.362s30.586-4.132 43.439-11.362c27.099-15.244 45.447-44.28 45.447-77.524 0-49.012-39.874-88.887-88.886-88.887zM99.918 121.689c-36.655 0-66.475 29.82-66.475 66.475 0 36.655 29.82 66.475 66.475 66.475a66.095 66.095 0 0 0 26.195-5.388c13.906-5.987 25.372-16.585 32.467-29.86a66.05 66.05 0 0 0 7.813-31.227c0-36.654-29.82-66.475-66.475-66.475zM412.082 121.689c-36.655 0-66.475 29.82-66.475 66.475a66.045 66.045 0 0 0 7.813 31.227c7.095 13.276 18.561 23.874 32.467 29.86a66.095 66.095 0 0 0 26.195 5.388c36.655 0 66.475-29.82 66.475-66.475 0-36.655-29.82-66.475-66.475-66.475z" fill="currentColor" opacity="1" data-original="#000000"/></g></svg>
                        </span>
                        <span class="menu-text">
                           <?=$usersTxt;?>
                        </span>
                    </a>
                </li>
                <?php }?>
                <li>
                    <a href="<?=base_url('book-list');?>" class="<?=isset($page)&&$page=="book-list"? "active" : "";?>">
                        <span class="icon-menu">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 459.319 459.319"><g><path d="M94.924 366.674h312.874c.958 0 1.886-.136 2.778-.349.071 0 .13.012.201.012 6.679 0 12.105-5.42 12.105-12.104V12.105C422.883 5.423 417.456 0 410.777 0H94.941c-32.22 0-58.428 26.214-58.428 58.425 0 .432.085.842.127 1.259-.042 29.755-.411 303.166-.042 339.109-.023.703-.109 1.389-.109 2.099 0 30.973 24.252 56.329 54.757 58.245.612.094 1.212.183 1.847.183h317.683c6.679 0 12.105-5.42 12.105-12.105V401.65c0-6.68-5.427-12.105-12.105-12.105s-12.105 5.426-12.105 12.105v33.461H94.924c-18.395 0-33.411-14.605-34.149-32.817.018-.325.077-.632.071-.963-.012-.532-.03-1.359-.042-2.459 1.058-17.924 15.935-32.198 34.12-32.198zm8.254-308.249c0-6.682 5.423-12.105 12.105-12.105s12.105 5.423 12.105 12.105V304.31c0 6.679-5.423 12.105-12.105 12.105s-12.105-5.427-12.105-12.105V58.425z" fill="currentColor" opacity="1" data-original="#000000" class=""/></g></svg>                           
                        </span>
                        <span class="menu-text">
                            Book List
                        </span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="<?=isset($page)&&$page=="setting"? "active" : "";?>">
                        <span class="icon-menu">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 548.25 548.25"><g><path fill-rule="evenodd" d="M341.292 17.672s19.099 55.412 19.099 55.386a217.387 217.387 0 0 1 44.702 25.831l57.553-11.169c6.681-1.3 13.566 1.071 18.054 6.197a274.353 274.353 0 0 1 52.76 91.417 19.13 19.13 0 0 1-3.647 18.742s-38.428 44.242-38.428 44.217a218.606 218.606 0 0 1 0 51.637l38.428 44.242a19.13 19.13 0 0 1 3.647 18.742 274.343 274.343 0 0 1-52.76 91.417c-4.488 5.126-11.373 7.497-18.054 6.197 0 0-57.553-11.169-57.528-11.169a217.595 217.595 0 0 1-44.727 25.806l-19.099 55.411a19.142 19.142 0 0 1-14.382 12.546 274.366 274.366 0 0 1-105.57 0 19.142 19.142 0 0 1-14.382-12.546s-19.099-55.411-19.099-55.386a217.346 217.346 0 0 1-44.702-25.832L85.604 460.53c-6.681 1.301-13.566-1.071-18.054-6.197a274.347 274.347 0 0 1-52.76-91.418 19.13 19.13 0 0 1 3.646-18.742s38.429-44.242 38.429-44.217a218.615 218.615 0 0 1 0-51.638l-38.428-44.242a19.133 19.133 0 0 1-3.647-18.742 274.372 274.372 0 0 1 52.759-91.418c4.488-5.126 11.373-7.497 18.054-6.196 0 0 57.553 11.169 57.528 11.169a217.62 217.62 0 0 1 44.727-25.806l19.099-55.411a19.142 19.142 0 0 1 14.382-12.546 274.366 274.366 0 0 1 105.57 0 19.14 19.14 0 0 1 14.383 12.546zM274.125 161.39c-62.22 0-112.736 50.515-112.736 112.736s50.515 112.735 112.736 112.735S386.86 336.345 386.86 274.125 336.345 161.39 274.125 161.39zm0 38.25c41.106 0 74.485 33.38 74.485 74.485s-33.379 74.485-74.485 74.485-74.485-33.379-74.485-74.485 33.379-74.485 74.485-74.485z" clip-rule="evenodd" fill="currentColor" opacity="1" data-original="#000000"/></g></svg>                              
                        </span>
                        <span class="menu-text">
                            Settings
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>