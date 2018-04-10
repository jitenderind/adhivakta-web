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
        if ($this->session->userdata('user')) {
            $this->data['pageTitle'] = DEFAULT_TITLE;
            $this->data['page'] = 'workspace';
            $this->load->view('page', $this->data);
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
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
                $userdata = array(
                    'user' => array(
                        'userId' => $result->userId,
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
                $this->session->set_userdata($userdata);
                //check for valid plan
                if($result->plan_type!='free' && date("Y-m-d")>date("Y-m-d",strtotime($result->plan_valid_till))){
                    echo 2;
                    die();
                }
                
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
            
            $data = array(
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 10]),
                'mobile' => $_POST['mobile'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'user_type' =>$_POST['user_type'],
                'plan_type' =>$_POST['plan_type'],
                'plan_start_date' =>date('Y-m-d H:i:s'),
                'plan_valid_till' =>date('Y-m-d H:i:s',strtotime("+15 days")),
                'registration_type' =>$_POST['registration_type'],
                'registered_on' => date('Y-m-d H:i:s')
            );
            //var_dump($data);
            $query = $this->db->insert($this->userTbl, $data);
            //var_dump($query);
            $userId = $this->db->insert_id();
            if ($userId) {
                
                // set session variables
                $userdata = array(
                    'user' => array(
                        'userId' => $userId,
                        'first_name' => $data['first_name'],
                        'email' => $data['email'],
                        'last_name' => $data['last_name'],
                        'lastLogin' => 'First Login',
                        'plan_type'=>$_POST['plan_type'],
                        'user_type'=>$_POST['user_type'],
                        'logins' => 0,
                        'loginIP' => $_SERVER['REMOTE_ADDR'],
                        'photo' => 'nobody_m.jpg',
                        'logged_in' => TRUE
                    )
                );
                
                
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
                
                // load dashboard
                redirect(base_url() . '/workspace', 'refresh');
            
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
        $data['updateDate']=date('Y-m-d H:i:s');
        $this->db->where('userId', $id);
        $this->db->update('user', $data);
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
            if ($query->result()) {
                // send email
                // get setting
                $this->load->library('Settings');
                $from_email = $this->settings->fetchSetting('SEND_FROM_EMAIL');
                $business_name = $this->settings->fetchSetting('BUSINESS_NAME');
                
                $this->load->library('email');
                
                $this->email->from($from_email, $business_name);
                $this->email->to($_POST['email']);
                $this->email->subject('Passwod reset link');
                
                $token = md5(uniqid(rand(), true));
                $link = base_url() . '/reset-password?token=' . $token;
                // die();
                
                $msg = 'Hello! ';
                $msg .= '<p>Your we have recieved request to reset password for your account. Please click the link to and enter your new password:</p>';
                $msg .= '<a href="' . $link . '">' . $link . '</a>';
                $msg .= '
                    <p>
                    Best Reagards,<br>
                    ' . $business_name . '
                    </p>
                    ';
                $this->email->message($msg);
                $this->email->set_mailtype("html");
                $this->email->send();
                
                //set token in db
                $array = array(
                    'token' => $token,
                    'token_valid_date' => date('Y-m-d H:i:s',strtotime('+15 days')),
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
                    //update record 
                    $data['password']=password_hash($this->input->post('password'), PASSWORD_DEFAULT, ['cost' => 15]);
                    $data['updated_on']=date('Y-m-d H:i:s');
                    $this->db->where('token', $token);
                    $this->db->update($this->userTbl,$data);
                    //echo $this->db->last_query();
                   
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
}