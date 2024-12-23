
<?php 

//Check use is logged in or not.
function is_user_logged_in(){	
	$session = \Config\Services::session(); // Load Session library
	$status = isset($session->get()['isUserLoggedIn']) ? $session->get()['isUserLoggedIn'] : FALSE;

	if($status){
		return TRUE;
	}else{
		return FALSE;
	}
}

//Logged in user id
function get_userid(){	
	$session = \Config\Services::session(); // Load Session library
	return isset($session->get()['userId']) ? $session->get()['userId'] : array();
}

//Get User
function get_userdata($user_id){
	$dataArray = array(
		'table_name' => 'eb_users',
		'return_result' => 'multiple',
		'conditions' => array( 
			'ID'=> $user_id
		)
	);
	$DatabaseModel = new \App\Models\DatabaseModel;
	$users = $DatabaseModel->getRows($dataArray);
	return $users;
}

//Get Subusers Of The User
function get_subusers($user_id){
	$dataArray = array(
		'table_name' => 'eb_users',
		'return_result' => 'multiple',
		'conditions' => array( 
			'added_by'=> $user_id
		)
	);
	$DatabaseModel = new \App\Models\DatabaseModel;
	$subusers = $DatabaseModel->getRows($dataArray);
	
	return $subusers;
}

//Get parent of the user
function get_subusers_id($user_id){
	
	$dataArray = array(
		'table_name' => 'eb_users',
		'return_result' => 'multiple',
		'conditions' => array( 
			'added_by'=> $user_id
		)
	);
	$DatabaseModel = new \App\Models\DatabaseModel;
	$users = $DatabaseModel->getRows($dataArray);
	$ids[] = $user_id;
	if(!empty($users)){
		foreach( $users as $user ){
			$ids[] = $user['ID'];
		}	
	}
	return $ids;
}

function getUserByEmail($email){	
	if(is_email_exist($email)){

		$dataArray = array(
			'table_name' => 'eb_users',
			'return_result' => 'multiple',
			'conditions' => array( 
				'user_email'=> $email
			)
		);
		$DatabaseModel = new \App\Models\DatabaseModel;
		$users = $DatabaseModel->getRows($dataArray);
		
		return $users[0];
	}else{
		return array('status'=>0,'msg'=>'User not registered');
	}
}
//Password Check for the users authentication
function password_check($password, $existing_pass) {
	if (md5($password) === $existing_pass) {
		return true;
	} else {
		return false;
	}
}

//Return boolean value if email exist or not.
function is_email_exist($email){
	$dataArray = array(
		'table_name' => 'eb_users',
		'return_result' => 'single',
		'conditions' => array( 
			'user_email'=> trim( $email )
		)
	);
	$DatabaseModel = new \App\Models\DatabaseModel;
	
	$user = $DatabaseModel->getRows($dataArray);
	
	return !empty($user) ? true : false;
}

//Return boolean value if user active or not.
function is_user_active($email){
	$dataArray = array(
		'table_name' => 'eb_users',
		'return_result' => 'single',
		'conditions' => array( 
			'user_email'=> trim( $email ),
			'user_status' => 1
		)
	);
	$DatabaseModel = new \App\Models\DatabaseModel;
	$user = $DatabaseModel->getRows($dataArray);
	
	return !empty($user) ? true : false;
}
function vp_randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

//Delete Directory and it's inner files
function vp_deleteDir($dirPath) {
    if (is_dir($dirPath)) {
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				vp_deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
    }
}

//Get Files From Folder
function get_files_from_folder($path){
	//$dir = FCPATH . 'assets/images/objects/arrows';
	$dh  = opendir($path);
	$files = array();
	while (false !== ($filename = readdir($dh))) {
		if($filename != '.' && $filename != '..'){
			$files[] =  $filename;
		}
	}

	return $files;
}

function eBook_sendmail($recipient_data){
	
	$data = $recipient_data;

	$html = view('email-template/add_update_user',$data);

    $tos[] = array(
		'email' => $recipient_data['email'],
		'name' => '',
		'type' => 'to'
    );
    $message = array(
		'html' => $html,	
		'subject' => $recipient_data['subject'],
		'from_email' => 'support@christmassuite.in',
		'from_name' => 'Simple eBook Creator',
		'to' => $tos
    ); 	   
    $POSTFIELDS = array(
		'key' => 'md-a-D0S_v4dOh55YfcfTuXCg',
		'message' => $message
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://mandrillapp.com/api/1.0/messages/send.json');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POSTFIELDS));

    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    curl_close($ch);
	
	$response = json_decode($result,true);
	
	// Check if the response is valid and the email was sent successfully
	if (isset($response['status']) && $response['status'] != 'error' && (empty($response[0]['status']) || $response[0]['status'] != 'rejected')) {
		return 'sent';
	} else {		
		$status = sendmail_with_smtp($html, $recipient_data['subject'], $recipient_data['email']);
		
		if($status == 'sent'){
		    return 'sent';
		}else{
		    return $status;
		}
	}

	
}

if (!function_exists('sendmail_with_smtp')) {
	// use CodeIgniter\Config\Services;
    function sendmail_with_smtp($html, $sub, $to)
    {
		// Load the email service
		$email = \Config\Services::email();    

        // Email configuration
        $config = [
            'protocol' => 'smtp',
            'SMTPHost' => 'christmassuite.in',
            'SMTPPort' => 465,
            'SMTPUser' => 'support@christmassuite.in',
            'SMTPPass' => 'fn}IwT]K-7xv',
            'charset' => 'utf-8',
            'mailType' => 'html',
            'SMTPCrypto' => 'ssl',
            'newline' => "\r\n",
        ];

        // Initialize the email service with the configuration
        $email->initialize($config);

        // Set email parameters
        $frommail = 'support@christmassuite.in';
        $body = $html;

        $email->setFrom($frommail, 'Simple eBook Creator');
        $email->setTo($to);
        $email->setSubject($sub);
        $email->setMessage($body);

        // Send the email and handle success or failure
        if ($email->send()) {
            return "sent";
        } else {
            return $email->printDebugger();
        }
    }
}

function formatNumber($number) {
	if ($number >= 1000 && $number < 1000000) {
		// Convert to thousands and add 'k'
		return round($number / 1000, 1) . 'k';
	} elseif ($number >= 1000000 && $number < 1000000000) {
		// Convert to millions and add 'M'
		return round($number / 1000000, 1) . 'M';
	} elseif ($number >= 1000000000) {
		// Convert to billions and add 'B'
		return round($number / 1000000000, 1) . 'B';
	} else {
		// Return the number as is if it's less than 1000
		return (string)$number;
	}
}