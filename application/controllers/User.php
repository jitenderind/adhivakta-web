<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * http://example.com/index.php/welcome
     * - or -
     * http://example.com/index.php/welcome/index
     * - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * 
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    private $userTbl ='users';
    public function index()
    {
        $this->load->helper('url'); // loading url helper to load assests
        $this->load->library('session');
        $session=$this->session->userdata('user');
        if ($this->session->userdata('user')) {
            if($session['non-payment']==1){
                $this->plans();
                return false;
            }
            $this->data['pageTitle'] = DEFAULT_TITLE;
            $this->data['page'] = 'workspace';
            $this->load->view('page', $this->data);
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }

    public function page($page)
    {
        $this->load->helper('url'); // loading url helper to load assests
        $this->load->library('session');
        $session=$this->session->userdata('user');
        if ($this->session->userdata('user')) {
            if($session['non-payment']==1){
                $this->plans();
                return false;
            }
            $this->data['pageTitle'] = DEFAULT_TITLE;
            $this->data['page'] = $page;
            $this->load->view('page', $this->data);
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }
    
    public function plans()
    {
        $this->load->library('session');
        $this->load->helper('url'); // loading url helper to load assests
        
            $this->data['pageTitle'] = DEFAULT_TITLE;
            $this->data['page'] = 'plans';
            $this->load->database();
            $query = $this->db->get('plans');
            $r['result'] = $query->result();
            $r['user']=$_SESSION['user'];
            $this->load->view('common/header', $this->data);
            $this->load->view('subscription-plans', $r);
            $this->load->view('common/footer', $this->data);
    }
    
    public function login()
    {
        $this->load->library('session');
        $this->load->helper('url', 'form'); // loading url helper to load assests
        
        if($_POST['email']){
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'This email is not associated with any account.'
                )
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.'
                )
            )
        );
        
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            echo  "<span class='text-danger'>".validation_errors()."</span>";
        } else {
            $this->form_validation->set_message('_check_valid_username', 'Error Message');
            // check for login process
            $this->load->database();
            $query = $this->db->get_where($this->userTbl, array(
                'email' => $_POST['email'],
            ));
            
            $result = $query->result();
            $result = $result[0];
            // successful login
            if ($result) {
                //verify account
                if($result->verified!=1){
                    echo 'Your account is not verified. Please check your email to verify your account';
                }
                
                if(password_verify($_POST['password'],$result->password)){
                // set session variables
                if($result->parentUserId!=0){
                    $userId=$result->parentUserId;
                    $myId = $result->userId;
                } else {
                    $userId=$result->userId;
                    $myId = $result->userId;
                }
                $userdata = array(
                    'user' => array(
                        'userId' => $userId,
                        'myId' => $myId,
                        'first_name' => $result->first_name,
                        'email' => $result->email,
                        'last_name' => $result->last_name,
                        'plan_type'=>$result->plan_type,
                        'user_type'=>$result->user_type,
                        'lastLogin' => $result->lastLogin,
                        'logins' => $result->logins,
                        'loginIP' => $_SERVER['REMOTE_ADDR'],
                        'photo' => $result->photo,
                        'logged_in' => TRUE
                    )
                );
                
                // set notification interval
               // $this->load->library('settings');
                //$userdata['notification_check_interval'] = $this->settings->fetchSetting('NOTIFICATION_CHECK_INTERVAL');
               
                //check for valid plan
                if($result->plan_type!='free' && date("Y-m-d")>date("Y-m-d",strtotime($result->plan_valid_till))){
                    $userdata['user']['non-payment']=1;
                    $this->session->set_userdata($userdata);
                    echo 2;
                    die();
                }
                $this->session->set_userdata($userdata);
                // set login details
                $array = array(
                    'logins' => 1,
                    'loginIP' => $_SERVER['REMOTE_ADDR'],
                    'lastLogin' => date('Y-m-d H:i:s')
                );
                $this->db->set($array);
                $this->db->where('userId', $result->userId);
                $this->db->update($this->userTbl);
                echo 1;
                // load dashboard
                //redirect(base_url() . 'user/dashboard', 'refresh');
                } else {
                    //Invalid password
                    echo "Incorrect Password";
                }
            } else {
                // incorrect login details
                echo "Provided details do not match with any account";
            }
        }
        } else {
            if ($_SESSION['user']) {
                redirect(base_url(), 'refresh');
            }
            $this->data['pageTitle'] = DEFAULT_TITLE;
            $this->load->view('common/header', $this->data);
            $this->load->view('login', $this->data);
            $this->load->view('common/footer');
        }
    }

    public function register()
    {
        $this->load->library('session');
        $this->load->helper('url', 'form'); // loading url helper to load assests
                                            // check for login
        if ($_SESSION['user']) {
            redirect(base_url() , 'refresh');
        }
        
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'first_name',
                'label' => 'First Name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide your %s.'
                )
            ),
            array(
                'field' => 'last_name',
                'label' => 'last name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide %s.'
                )
            ),
            array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide your %s.'
                )
            ),
            array(
                'field' => 'mobile',
                'label' => 'Mobile',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide your %s.'
                )
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide %s.'
                )
            ),
            array(
                'field' => 'confirm_password',
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]',
                'errors' => array(
                    'required' => 'password must match.'
                )
            )
        );
        
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->data['pageTitle'] = DEFAULT_TITLE;
            $this->data['reg_error'] = validation_errors();
            $this->load->view('common/header', $this->data);
            $this->load->view('register', $this->data);
            $this->load->view('common/footer');
        } else {
            // add user to database
            
            // check for login process
            $this->load->database();
            $this->load->helper('string');
            //check if user exist
            $this->db->where(
                'email', $_POST['email']
            );
            
            $this->db->or_where(
                'mobile', $_POST['mobile']
            );
            $query = $this->db->get($this->userTbl);
            $result = $query->result();
            if($result){
                redirect(base_url() . 'login?r=account_exist', 'refresh');
            } 
            $token = random_string('alnum',15);
            
            $data = array(
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 10]),
                'mobile' => $_POST['mobile'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'parentUserId' => $_POST['parentUserId'],
                'user_type' =>$_POST['user_type'],
                'plan_type' =>$_POST['plan_type'],
                'plan_start_date' =>date('Y-m-d H:i:s'),
                'plan_valid_till' =>date('Y-m-d H:i:s',strtotime("+15 days")),
                'registration_type' =>$_POST['registration_type'],
                'token' =>$token,
                'loginIP' => $_SERVER['REMOTE_ADDR'],
                'registered_on' => date('Y-m-d H:i:s')
            );
            //var_dump($data);
            $query = $this->db->insert($this->userTbl, $data);
            //var_dump($query);
            $userId = $this->db->insert_id();
            $curl = curl_init();
            if($_POST['staff']==0){
                $curl_request="POST";
                $url=API_URL."staff/add";
                $params=array('parentUserId'=>$userId,'userId'=>$userId,'first_name'=>$_POST['first_name'],'last_name'=>$_POST['last_name'],'user_type'=>$_POST['user_type'],'email'=>$_POST['email']);
            } else {
                $curl_request="PUT";
                $url=API_URL."edit-staff/".$_POST['staff'];
                $params=array('userId'=>$userId);
            }
            $postData = '';
            //create name value pairs seperated by &
            foreach($params as $k => $v)
            {
                $postData .= $k . '='.$v.'&';
            }
            $postData = rtrim($postData, '&');
            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_POSTFIELDS=>$postData,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $curl_request,
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $2y$04$v2GRtfPdR9Vmx/.JnH/pd.wvoQ2AshJhBhIFdvxmtpwIUUvbMT91O",
            "Cache-Control: no-cache",
            "Postman-Token: 2b5d48bd-ffd6-4dec-b50c-5b31e0b9e699"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($userId) {
                //add default settings
                $array = array(
                    array('userId'=>$userId,'type'=>'Auto Renew Subscription','value'=>0),
                    array('userId'=>$userId,'type'=>'Web Notification','value'=>1),
                    array('userId'=>$userId,'type'=>'Push Notification','value'=>1),
                    array('userId'=>$userId,'type'=>'Email Notification','value'=>1),
                    array('userId'=>$userId,'type'=>'Case Listing Reminder','value'=>1),
                    array('userId'=>$userId,'type'=>'Case Update Reminder','value'=>1),
                    array('userId'=>$userId,'type'=>'Daily Task Reminder','value'=>1),
                    array('userId'=>$userId,'type'=>'Sync with Google Calendar','value'=>0),
                );
                $this->db->insert_batch('user_settings', $array);
                //load email class
                $this->load->library('email');
                $emailArray = array('to'=>$_POST['email'],'subject'=>'Account created! Please verify your email');
                $data=array('first_name'=>$_POST['first_name'],'verify_link'=>base_url().'verify-account?t='.base64_encode(base64_encode(base64_encode($token))));
                $this->email->sendEmail($emailArray,'register',$data);
                redirect(base_url() . 'verify-account', 'refresh');
            
            } else {
                // incorrect login details
                $this->data['pageTitle'] = DEFAULT_TITLE;
            $this->data['reg_error'] = validation_errors();
            $this->load->view('common/header', $this->data);
            $this->load->view('register', $this->data);
            $this->load->view('common/footer');
            }
        }
    }

    public function logout()
    {
        $this->load->library('session');
        $this->load->helper('url'); // loading url helper to load assests
        $this->session->unset_userdata('user');
        redirect(base_url(), 'refresh');
    }

    public function updateProfile()
    {
        $this->load->database();
        $id = $this->input->post('pk');
        $key = $this->input->post('name');
        $data[$key] = $this->input->post('value');
        
        if ($key == 'avatar') {
            $this->load->library('session');
            $_SESSION['user']['photo'] = $data[$key];
        } else if($key=="password"){
            $data[$key]=md5($this->input->post('value'));
            $data['raw_pass']=$this->input->post('value');
        }
        $data['updated_on']=date('Y-m-d H:i:s');
        $this->db->where('userId', $id);
        $this->db->update($this->userTbl, $data);
        // echo $this->db->last_query();
        if ($this->db->affected_rows() < 1) {
            return true;
        } else {
            return false;
        }
    }


    public function forgot_password()
    {
        $this->load->helper('url', 'form'); // loading url helper to load assests
        $this->load->library('form_validation');
        if($_POST){
        $config = array(
            array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.'
                )
            )
        );
        
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            echo "<span class='text-danger'>".validation_errors()."</span>";
        } else {
            // check if user exist
            $this->load->database();
            $this->db->where('email', $_POST['email']);
            $query = $this->db->get($this->userTbl);
            $result = $query->row();
            if ($result) {
                // send email
                $this->load->library('email');
                $this->load->helper('string');
                $token = random_string('alnum',15);
                $link = base_url() . 'reset-password?token=' . $token;
                
                $emailArray = array('to'=>$result->email,'subject'=>'Account Recovery');
                $data=array('first_name'=>$result->first_name,'email'=>$result->email,'link'=>$link);
                $this->email->sendEmail($emailArray,'account-recovery',$data);
                
                //set token in db
                $array = array(
                    'token' => $token,
                    'token_valid_date' => date('Y-m-d H:i:s',strtotime('+1 days')),
                    'lastLogin' => date('Y-m-d H:i:s')
                );
                $this->db->set($array);
                $this->db->where('email', $_POST['email']);
                $this->db->update($this->userTbl);
                echo "<span class='text-primary'>Details sent to your email. Please follow instrucation sent in mail</span>";
            } else {
                // no account
                echo "<span class='text-danger'>This Email is not associated with any account</span>";
            }
        } 
        } else {
            $this->data['pageTitle'] = DEFAULT_TITLE;
            $this->load->view('common/header', $this->data);
            $this->load->view('forgot_password', $this->data);
            $this->load->view('common/footer');
        }
    }

    public function reset_password()
    {
        // check for valid token
        $this->load->helper('url', 'form');
        if ($this->input->post('password')) {
            $token = $this->input->post('token');
            
            // check for account
            $this->load->database();
            $this->db->where('token', $token);
            $query = $this->db->get($this->userTbl);
            $result = $query->result();
            $result = $result[0];
            if ($result) {
                if($result->token_valid_date<date("Y-m-d H:i:s")){
                    echo "<span class='text-danger'>Token Expired. Please regenerate token <a href='/recover-password'>here</a></span>";
                } else {
                $this->load->library('form_validation');
                $config = array(
                    array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'You must provide a %s.'
                        )
                    ),
                    array(
                        'field' => 'confirm_password',
                        'label' => 'Confirm Password',
                        'rules' => 'required|matches[password]',
                        'errors' => array(
                            'required' => 'You must provide a %s.'
                        )
                    )
                );
                
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() !== FALSE) {
                    $this->db->where('token', $token);
                    $query = $this->db->get($this->userTbl);
                    $result = $query->row();
                    //update record 
                    $data['password']=password_hash($this->input->post('password'), PASSWORD_DEFAULT, ['cost' => 15]);
                    $data['updated_on']=date('Y-m-d H:i:s');
                    $data['token']='';
                    $data['token_valid_date']='';
                    $this->db->where('token', $token);
                    $this->db->update($this->userTbl,$data);
                    //echo $this->db->last_query();
                    
                    $this->load->library('email');
                    
                    $emailArray = array('to'=>$result->email,'subject'=>'Account Password Changed');
                    $data=array('first_name'=>$result->first_name);
                    $this->email->sendEmail($emailArray,'account-recovered',$data);
                   
                    echo "<span class='text-primary'>Password changed! you can sign in using new password</span>";
                    
                } else {
                    echo "<span class='text-danger'>".validation_errors()."</span>";
                }
            }
            } else {
                echo  "<span class='text-danger'>Invalid token. You are not allowed to change password</span>";
            }
        } else {
            $this->data['token']=$_GET['token'];
            $this->load->view('common/header', $this->data);
            $this->load->view('reset_password', $this->data);
            $this->load->view('common/footer');
        }
        
        // reset password
    }
    
    public function update_password()
    {
        // check for valid token
        $this->load->helper('url', 'form');
        if ($this->input->post('current_password')) {
                    $this->load->library('form_validation');
                    $config = array(
                        array(
                            'field' => 'current_password',
                            'label' => 'Password',
                            'rules' => 'required',
                            'errors' => array(
                                'required' => 'You must provide a %s.'
                            )
                        ),
                        array(
                            'field' => 'new_password',
                            'label' => 'New Password',
                            'rules' => 'required',
                            'errors' => array(
                                'required' => 'You must provide a %s.'
                            )
                        ),
                        array(
                            'field' => 'confirm_password',
                            'label' => 'Confirm Password',
                            'rules' => 'required|matches[new_password]',
                            'errors' => array(
                                'required' => 'You must provide a %s.'
                            )
                        )
                    );
    
                    $this->form_validation->set_rules($config);
                    if ($this->form_validation->run() !== FALSE) {
                        $this->load->database();
                        $this->db->where('userId', $this->input->post('userId'));
                        $query = $this->db->get($this->userTbl);
                        $result = $query->row();
                        
                        if(password_verify($this->input->post('current_password'),$result->password)){
                            //update record
                            $data['password']=password_hash($this->input->post('new_password'), PASSWORD_DEFAULT, ['cost' => 15]);
                            $data['updated_on']=date('Y-m-d H:i:s');
                            $this->db->where('userId', $this->input->post('userId'));
                            $this->db->update($this->userTbl,$data);
                            //echo $this->db->last_query();
                            
                            $this->load->library('email');
                            
                            $emailArray = array('to'=>$result->email,'subject'=>'Account Password Changed');
                            $data=array('first_name'=>$result->first_name);
                            $this->email->sendEmail($emailArray,'account-recovered',$data);
                             
                            echo "<span class='text-primary'>Password changed!</span>";
                        } else {
                            echo "<span class='text-danger'>Incorrect current password. Please use current password to update your account password</span>";
                        }
                        
    
                    } else {
                        echo "<span class='text-danger'>".validation_errors()."</span>";
                    }
        } else {
            echo "<span class='text-danger'>Password Not Provided</span>";
        }
    
        // reset password
    }
    public function verify_account(){
        $this->load->helper('url');
        if($_GET['t']){
            $token=base64_decode(base64_decode(base64_decode($_GET['t'])));
            $this->load->database();
            $this->db->set(array('verified'=>1));
            $this->db->where('token', $token);
            $this->db->update($this->userTbl);
            if($this->db->affected_rows()>0){
                $verificationData['image']="user-welcome.png";
                $verificationData['msg']='Your account is now verified. You can login and enjoy services for 15 days as demo period. You can select your plan any time within 15 days. To login and start demo period, click <a href="'.base_url().'/login">here<a/>';
                $verificationData['heading']="Start demo now";
                $verificationData['status']="Account Verified!!!";
                //send email for successful verification email
                $this->load->library('email');
                $this->db->select('first_name,email');
                $this->db->from($this->userTbl);
                $this->db->where('token', $token);
                $q = $this->db->get();
                $r=$q->row();
                $emailArray = array('to'=>$r->email,'subject'=>'Welcome to Adhivakta E-diary! Start using services');
                $data=array('first_name'=>$r->first_name);
                $this->email->sendEmail($emailArray,'verified',$data);
            } else {
                $verificationData['image']="unsubscribe.png";
                $verificationData['msg']="Your account can't be verifed. Token is invalid. Please check email and use exact link as sent in email.";
                $verificationData['heading']="Verification failed";
                $verificationData['status']="Error!!!";
            }
            $this->load->view('common/header', $this->data);
            $this->load->view('verified-account', $verificationData);
            $this->load->view('common/footer');
        } else {
        
        $this->load->view('common/header', $this->data);
        $this->load->view('verify-account', $this->data);
        $this->load->view('common/footer');
        }
    }
    
    
    public function all_user_staff($userId){
        //laod database 
        $this->load->database();
        $query = $this->db->select('userId,first_name,last_name,user_type')->where( array(
            'parentUserId' => $userId,
        ))->or_where( array(
            'userId' => $userId,
        ))->get($this->userTbl);
        
        $result = $query->result();
        echo json_encode($result);
    }
    
    
    public function account_details($id){
        $this->load->database();
        $query = $this->db->select('*')->where( array(
            'userId' => $id,
        ))->get($this->userTbl);
        
        $result = $query->result();
        echo json_encode($result);
    }
    
    public function account_settings($id){
        $this->load->database();
        $query = $this->db->select('*')->where( array(
            'userId' => $id,
        ))->get('user_settings');
    
        $result = $query->result();
        echo json_encode($result);
    }
    
    public function update_settings(){
    $this->load->database();
        $id = $this->input->post('userId');
        $key = $this->input->post('type');
        $data[$key] = $this->input->post('value');
        
        $this->db->where('userId', $id);
        $this->db->update('user_settings', $data);
        if ($this->db->affected_rows() < 1) {
            return true;
        } else {
            return false;
        }
    }
}