<?php

namespace App\Controllers;

class Auth extends BaseController
{
   public function index(string $page = 'login')
   {       
      if(is_user_logged_in()){
         header("Location:".base_url('dashboard'));
         die;
      }
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['app_baseURL'] = base_url(); // Set base URL
      return view('common/auth_header', $data)
      . view('auth/' . $page)
      . view('common/auth_footer');
   }
   
   public function UserAuth(){
      $user = getUserByEmail($_POST['email']);
      $curPass = $_POST['user_pass'];      

      // if($user['user_role'] != md5('adm')){
         if(!empty($user)){
            if( password_check($curPass, $user["user_pass"]) ){
               
               $this->session->set('isUserLoggedIn', TRUE); 
               $this->session->set('userId', $user['ID']);
               $this->session->set('role', $user['user_role']);

               if(isset($_POST['remember'])){
                  set_cookie('vp_user_email', $_POST['email'], 86400 * 30 ); //Remember me for 30 days
                  set_cookie('vp_user_password', base64_encode($_POST['password']), 86400 * 30 ); //Remember me for 30 days.
               }    				
               echo json_encode(array('status' => 'success'));
            }else{
                  echo json_encode(array('status' => 'not_match'));
            }
         }else{
            if( is_email_exist($_POST['email']) && !is_user_active($_POST['email']) ){
               echo json_encode(array('status' => 'user_inactive'));
            }else{
               echo json_encode(array('status' => 'not_exist'));
            }
         }
      // }else{
      //       echo json_encode(array('status' => 'not_exist'));
      // }
      
      die();	
   }
   public function ResetPassword(){
      if(is_user_logged_in()){
         header("Location:".base_url('dashboard'));
         die;
      }
      $data['title'] = ucfirst('resset password'); // Capitalize the first letter
      $data['app_baseURL'] = base_url(); // Set base URL
      return view('common/auth_header', $data)
      . view('auth/reset-password')
      . view('common/auth_footer');
   }
   public function ResetPass(){
      $user = getUserByEmail($_POST['email']);
     
      if(isset($user) && !empty($user)){
         $newPAss = vp_randomPassword();

         $dataArray = array( 
            'user_pass' =>md5($newPAss)
        );
     
         $update = $this->Db_model->update_data_limit('eb_users',$dataArray,array('user_email'=>$_POST['email']),1); 
         if($update){
            $MailData = [];
            $MailData['name'] = $user['user_name'];
            $MailData['email'] =$_POST['email'];
            $MailData['email_for'] = "password_reset";
            $MailData['subject'] = "Reset Your Password";
            $MailData['NewPass'] = vp_randomPassword();
            eBook_sendmail($MailData);

            echo json_encode(array('status'=>1,'msg'=>'A new password has been successfully sent to your email'));
            die;
         }else{
            echo json_encode(array('status'=>2,'msg'=>'Something is going wrong please try again.'));
            die;            
         }
      }else{
         echo json_encode(array('status'=>0,'msg'=>'This email is not registered with us.'));
         die;            
      }
   }
   public function Logout(){
      // Load the session service
      $session = \Config\Services::session();

      // Destroy the session
      $session->destroy();

      // Redirect to the login page or home page
      return redirect()->to(base_url());
   }
}
