<?php 
$link = isset($token) && !empty($token) ? base_url().'password-reset?token='.$token : ''; ?>
<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Simple eBook Creator</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body style="margin:0;font-family: 'Roboto', sans-serif;line-height: 26px;">
	<table cellpadding="0" cellspacing="0" border="0" style="background-color:gainsboro; font-family: 'Nunito Sans', sans-serif; width:100%;">
		<tr>
			<td>
				<table cellpadding="0" cellspacing="0" border="0" style="padding: 95px 30px;width: 600px;margin:0 auto;">  
					<tr>
						<td style="clear: both !important;background-color:#f7f8fa; border-radius: 20px 20px 33px 33px;">
							<table align="center" cellpadding="0" cellspacing="0" border="0" style="width: 100%; border: none;border: none; ">
								<tr style="-webkit-font-smoothing: antialiased;  height: 100%;  -webkit-text-size-adjust: none;  width: 100% !important;">
									<td align="center" style=" float: left; padding: 20px 0px;text-align: center;width:100%;background-color: f2fefd;border-radius: 4px 4px 0px 0px;">
										<span style="padding-right: 10px;text-align: center;display:inline-block;">
											<img class="head-img" src="https://pixelarmor.io/assets/images/email-header.png">
										</span>
									</td>
								</tr>
							</table>
							<table cellpadding="0" cellspacing="0" border="0" style=" width: 100%; padding:20px 25px 24px;border-bottom: solid 1px #ebf6f8; margin-bottom: -20px;">
								<tr>
								<td style="font-size:24px;font-weight: 800; color:#232429; text-align:center;padding:0 20px;"> 
										<div style="white-space: normal;">Simple eBook Creator</div>
								</td>
								</tr>
								 <tr><td style="height:30px;"></td></tr>
								 <tr>
									<td style="font-size:18px; font-weight: 700;color:#232429;padding:0 25px;"><span>Hi</span> <span class="business-name"><?= $username = !empty($name) ? $name : 'There'; ?></span>,</td>
								</tr>
								<tr><td style="height:20px;"></td></tr>
								<?php if($email_for == 'update_user'){ ?>
								<tr>
									<td style="font-size:16px;line-height: 1.8;color:#747888; max-width:100px; padding:0 25px;">
									<div style="white-space: normal;">
									<?php
									if(in_array('OTO7', explode(',',$plan))){
										echo 'Your account has been updated. The username and password will be same for all the below applications.';
									}elseif(in_array('OTO8', explode(',',$plan))){
										echo 'Your account has been updated. The username and password will be same for both the below applications.';
									}else{
										echo 'Your account has been updated for the following product.';
									}                                  
									?>
										
										<span style="display:block; height:10px;"></span>
										
										<?php if(!empty($password)){ ?>
										<b>Username: </b><?= $email; ?>
										<span style="display:block;"></span>
										<b>Password: </b><?= $password; ?>
										<span style="display:block; height:20px;"></span>
										<?php } ?>
										
										<div style="background: #ffffff;padding: 20px 40px 10px;border-radius: 10px;">
										<?php
										   $li = '<h1>Your Upgrade OTOs Plans</h1><div style="display: inline-flex;flex-direction: row;flex-wrap: wrap;align-content: space-between;justify-content: flex-start;align-items: stretch;">';

                                           $plans = explode(',', $plan);
                                           foreach ($plans as $key => $pl) {
                                               // Check if it's the last item in the array
                                               if ($key == count($plans) - 1) {
                                                   $li .= '<h4 style="margin: 0 0 10px; color:#000;">' . $pl . '</h4>'; // No comma after the last item
                                               } else {
                                                   $li .= '<h4 style="margin: 0 0 10px; color:#000;">' . $pl . ', </h4>'; // Add comma after each item except the last
                                               }
                                           }
                                           
                                           $li .= '</div>';      
                                           echo $li;                                     
										?>
										</div>
									</div>
									</td>
								</tr>
								<tr>
									<td style="font-size:16px;line-height: 1.8;color:#000; max-width:100px; padding:25px 0px 0px;">
									<div style="white-space: normal;text-align:center; font-weight:bold;">
										Thank you for trusting us!
									</div>
									</td>
								</tr>
								<?php }elseif($email_for == 'new_user'){ ?>
									<tr>
										<td style="font-size:16px;line-height: 1.8;color:#747888; max-width:100px; padding:0 25px;">
											<div style="white-space: normal;">
												<strong>Thank you for joining the Simple eBook Creator family!</strong>
											</div>
											<div style="white-space: normal;">
												We have just registered your account, and you can find your access details below:
											</div>
											<div style="margin-top:20px;">
												<b>Login URL: </b><?= base_url().'login'; ?>
												<span style="display:block; height:10px;"></span>
												<b>Username: </b><?= $email; ?>
												<span style="display:block; height:10px;"></span>
												<b>Password: </b><?= $password; ?>
											</div>
											
											<?php
											  $li = '<h1>Your Purchase OTOs Plan</h1><div style="display: inline-flex;flex-direction: row;flex-wrap: wrap;align-content: space-between;justify-content: flex-start;align-items: stretch;">';

                                              $plans = explode(',', $plan);
                                              foreach ($plans as $key => $pl) {
                                                  // Check if it's the last item in the array
                                                  if ($key == count($plans) - 1) {
                                                      $li .= '<h4 style="margin: 0 0 10px; color:#000;">' . $pl . '</h4>'; // No comma after the last item
                                                  } else {
                                                      $li .= '<h4 style="margin: 0 0 10px; color:#000;">' . $pl . ', </h4>'; // Add comma after each item except the last
                                                  }
                                              }                                              
                                              $li .= '</div>';      
                                         ?>
											<div style="margin-top:20px;">
												<strong>Congratulations, and welcome to the family once again!</strong>
											</div>
										</td>
									</tr>
								<?php }elseif($email_for == 'password_reset'){ ?>
										<tr><td style="height:10px;"></td></tr>
										<tr>
											<td style="font-size:16px;line-height: 1.8;color:#747888; max-width:100px; padding:0 25px;">
												<div style="white-space: normal;">
													Someone has requested a password reset for the following account.<br>If this was a mistake, just ignore this email and nothing will happen.<br>To reset your password, click the following link<br><a href="<?= $link; ?>" style="color:#58616b;"><?= $link; ?></a>
												</div>
											</td>
										</tr>
								<?php } ?>
								
							</table>
							<table class="foot-table" cellpadding="0" cellspacing="0" border="0" style="width: 100%; 
							background-image:url('https://pixelarmor.io/assets/images/envelope.png');
							 background-size: cover; background-repeat: no-repeat;
							  background-position: center top; border-radius: 0px 0px 20px 20px;">
								<tr>
									<td style="height:180px;"></td>
								</tr>
								<tr>
									<td style="margin: 0;
									font-size: 16px;
									color: #fff;
									text-align: center;
									font-weight: 600;">Copyright @ <?= date('Y');?> Simple eBook Creator</td>
								</tr>
								<tr>
									<td style="height:10px;"></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>