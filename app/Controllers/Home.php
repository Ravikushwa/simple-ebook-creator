<?php

namespace App\Controllers;

class Home extends BaseController{

    public function index(){       
      
        if(!is_user_logged_in()){
            header("Location:".base_url());
            die;
        }
        $data['title'] = ucfirst('dashboard'); // Capitalize the first letter 
        $data['page'] = "dashboard";
        $data['cu_role'] = $this->session->get()['role'];
        $data['user'] = get_userdata( get_userid())[0];
        return view('common/head', $data)
        . view('common/nav', $data)
        . view('backend/dashboard',$data)
        . view('common/foot');
    }
    
    public function User(){
        if(!is_user_logged_in()){
            header("Location:".base_url());
            die;
        }
   
        $data['title'] = ucfirst('users'); // Capitalize the first letter       
        $data['page'] = "user";
        $data['cu_role'] = $this->session->get()['role'];
        $data['UserData'] = get_subusers(get_userid());
        $data['user'] = get_userdata( get_userid())[0];
        $data['usersTxt'] = $this->session->get()['role'] == md5('adm')? 'Users' : 'Agency';
        return view('common/head', $data)
        . view('common/nav', $data)
        . view('backend/users',$data)
        . view('common/foot');
    }

    public function Profile(){
        if(isset($this->session->get()['role']) && $this->session->get()['role'] !=4) {
            
            if(!is_user_logged_in()){
                header("Location:".base_url());
                die;
            }
            $data['title'] = ucfirst('profile'); // Capitalize the first letter       
            $data['page'] = "profile";
            $data['cu_role'] = $this->session->get()['role'];        
            $data['UserID'] = get_userid();
            $data['user'] = get_userdata( get_userid())[0];
            return view('common/head', $data)
            . view('common/nav', $data)
            . view('backend/profile',$data)
            . view('common/foot');
        }else{
            header("Location:".base_url());
            die;   
        }
    }

    public function BookList(){
        if(!is_user_logged_in()){
            header("Location:".base_url());
            die;
        }
   
        $data['title'] = ucfirst('BookList'); // Capitalize the first letter       
        $data['page'] = "book-list";
        $data['cu_role'] = $this->session->get()['role'];        
        $data['user'] = get_userdata( get_userid())[0];
        return view('common/head', $data)
        . view('common/nav', $data)
        . view('backend/book_list',$data)
        . view('common/foot');
    }  

    public function ChangeuserStatus(){
        $data_arr['user_status'] = $_POST['status'] == 'true' ? 1 : 0;
        $data_arr['last_update'] = date("Y-m-d H:i:s");
		
        $response = $this->Db_model->update_data_limit('eb_users',$data_arr,array('ID'=>$_POST['id']),1);

		if($response > 0){
			echo json_encode(array('status'=>1));           
		}else{
			echo json_encode(array('status'=>0));			           
		}
        die();	
    }

    public function ProfileUpload(){

        $file = $this->request->getFile('file'); 
       
         // Check if a file is uploaded
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Validate the file
            $validSize = $file->getSizeByUnit('mb') <= 100; // Maximum 100 MB
            $validType = in_array($file->getMimeType(), ['image/png', 'image/jpeg','image/jpg']);

            if ($validSize && $validType) {
                // Move file to public/uploads directory
                $newName = $file->getRandomName();

                $user = get_userdata(get_userid())[0];

                if(is_file('uploads/user-'.get_userid().'/'.$user['profile_pic'])){
                    if(!empty($user['profile_pic'])){
                        unlink('uploads/user-'.get_userid().'/'.$user['profile_pic']);
                    }
                }
                
                try {                    
                    $file->move('uploads/user-'.get_userid(), $newName);

                    $dataArray = array(                                       
                        'profile_pic' => $newName            
                    );
                    $update = $this->Db_model->update_data_limit('eb_users',$dataArray,array('ID'=>get_userid()),1); 

                    echo json_encode(['status' => 'success', 'message' => 'File uploaded successfully']);
                    die;                    
                } catch (\Exception $e) {                    
                    echo json_encode(['status' => 'error', 'message' => 'Failed to upload file: ' . $e->getMessage()]);
                    die;
                } 
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid file type or size']);
                die;
            }
        }

        echo  json_encode(['status' => 'error', 'message' => 'File upload failed']);
        die;        
    }

    public function UpdateUserPassword(){

        $user = get_userdata(get_userid())[0];
        if(!isset($_POST['password']) || empty($_POST['password'])){
            $dataArray = array(                                       
                'user_name' => $_POST['user-name']        
            );
            $update = $this->Db_model->update_data_limit('eb_users',$dataArray,array('ID'=>get_userid()),1); 
            if($update){
                echo json_encode(array('status'=>1,'msg'=>'User Details Successfully Update '));
                die;
            }else{
                echo json_encode(array('status'=>0,'msg'=>'Something went wrong '));
                die;
            }
        }else{
            if(isset($user['user_pass']) && !empty($user['user_pass']) && $user['user_pass']==md5($_POST['password'])){
    
                $dataArray = array(                                       
                    'user_name' => $_POST['user-name'],            
                    'user_pass' => md5($_POST['password'])            
                );
                $update = $this->Db_model->update_data_limit('eb_users',$dataArray,array('ID'=>get_userid()),1); 
                if($update){
                    echo json_encode(array('status'=>1,'msg'=>'User Details Successfully Update '));
                    die;
                }else{
                    echo json_encode(array('status'=>0,'msg'=>'Something went wrong '));
                    die;
                }
            }else{
                echo json_encode(array('status'=>0,'msg'=>'Current Password Are not Match'));
                die;
            }
        }
    }

    public function UserAdd(){

        $users = get_subusers(get_userid());
        $cuser = get_userdata(get_userid())[0];
        $userInfo = json_decode($_POST['data'],true);
        
        if($_POST['action']=="add_user"){
                if(!is_email_exist( $userInfo['email'] )){

                $level = explode(',', $cuser['access_level']);
                
                if($cuser['user_role'] != "b09c600fddc573f117449b3723f23d64" && !in_array("OTO5_UL", $level) ){
                    $limit = 0;
                    if(in_array("OTO5", $level)){
                        $limit = 100;
                    }
                    
                    if(count($users) >= $limit){
                        echo json_encode(array('status'=>3,'msg'=>'limit_cross'));
                        die;                       
                    }

                }
                
                $plan = isset($userInfo['plan']) ? $userInfo['plan']: 'FE';
                
                $role = $userInfo['user_role'] == "54#OUImdm4%4" ? 1 : ($userInfo['user_role'] == ":()#$99rrtR" ? 2 : 3);
                
                if($role==3){                  
                    $date = $cuser['user_registered']; // Original date
                    $datetime = new \DateTime($date);
                    $datetime->modify('+7 days'); // Add 7 days
                    $agencyActiveDate =  $datetime->format('l, d F Y H:i:s A');                         
                   
                    if($agencyActiveDate < date('l, d F Y H:i:s A')){
                        echo json_encode(array('status'=>4,'msg'=>'This feature is currently disabled, you can use it after','date'=>date('F j l, Y H:i:s', strtotime($agencyActiveDate))));
                        die;   
                    }
                }
            
                $dataArray = array(               
                    'user_name' => $userInfo['name'], 
                    'user_pass' => md5( $userInfo['password'] ),
                    'user_email' => $userInfo['email'],
                    'user_role' => $role,
                    'access_level' => $plan,
                    'auth_key' => md5($userInfo['email']),
                    'user_status' => 1,
                    'profile_pic' => 'logo2.png',
                    'added_by' => get_userid(),
                    'user_registered' => date("Y-m-d H:i:s")               
                );
            
                $insert = $this->Db_model->insert_data('eb_users',$dataArray); 
                           
                if(!empty($insert) && is_int($insert)){
                    if (!is_dir('uploads/user-'.get_userid())) {
                        mkdir('./uploads/user-' . get_userid(), 0777, TRUE);
                        
                    }
                    if(isset($_POST['send_email']) && $_POST['send_email'] == 'true'){
                        $MailData = [];
                        $MailData['name'] = $userInfo['name'];
                        $MailData['email'] = $userInfo['email'];
                        $MailData['LoginPassword'] =$userInfo['password'];
                        // $MailData['email_for'] = "update_user";
                        // $MailData['email_for'] = "password_reset";
                        $MailData['email_for'] = "new_user";
                        $MailData['subject'] = "Create New Access";
                        eBook_sendmail($MailData);
                        
                    }
                    echo json_encode(array('status'=>1,'msg'=>'Successfully Added User'));
                    die;
                }else{ 
                    echo json_encode(array('status'=>0,'msg'=>'Something went wrong'));
                    die;           
                }
            }else{
                echo json_encode(array('status'=>2,'msg'=>'This email already exists'));
                die;
            }
        }else{
            $plan = isset($userInfo['plan']) ? $userInfo['plan']: $cuser['access_level'];
        
            $role = $userInfo['user_role'] == "54#OUImdm4%4" ? 1 : ($userInfo['user_role'] == ":()#$99rrtR" ? 2 : 3);
        
            if(isset($userInfo['password']) && !empty($userInfo['password'])){
                $pass = md5( $userInfo['password'] );
            }else{
                $pass = $cuser['user_pass'];
            }
            $dataArray = array(               
                'user_name' => $userInfo['name'], 
                'user_pass' =>$pass,               
                'user_role' => $role,
                'access_level' => $plan,
                'user_status' => 1,
                'last_update' => date("Y-m-d H:i:s")               
            );
         
            $update = $this->Db_model->update_data_limit('eb_users',$dataArray,array('ID'=>$userInfo['ID']),1); 
          
            if(!empty($update)){
                if (!is_dir(WRITEPATH . 'uploads/user-'.get_userid())) {
                    mkdir(WRITEPATH . './uploads/user-' . get_userid(), 0777, TRUE);
                    
                }
                if(isset($_POST['sendmail']) && $_POST['sendmail'] == 'true'){
                   
                    $userInfo['email_for'] = "update_user";
                    // $MailData['email_for'] = "password_reset";                   
                    $userInfo['subject'] = "User Upgrade Your Account";
                    $MailData['LoginPassword'] =$pass;
                    eBook_sendmail($userInfo);
                    
                }
                echo json_encode(array('status'=>5,'msg'=>'Successfully Added User'));
                die;
            }else{ 
                echo json_encode(array('status'=>0,'msg'=>'Something went wrong'));
                die;           
            }           
        }       
    }  

	public function DeleteUser(){
	
		$userid = explode(',', $_POST['userid']);
		$count = 0;		
		
		foreach( $userid as $id ){
			if(!empty($id)){				
                $count += $this->Db_model->delete_data('eb_users',array('ID'=>$id));
			}
		}
		echo $count;
		
		die();
	}
}
