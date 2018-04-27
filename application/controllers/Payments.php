<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payments extends CI_Controller
{
    private $tbl='payments';
    
    public function add_payment(){
        $this->load->database();
        $id = $this->input->post('userId');
        //get unpaid invoice 
        $query = $this->db->select('*')->where( array(
            'userId' => $id,
            'status'=>'Pending'
        ))->get($this->tbl);
        $result = $query->result();
        if($result){
            //update existing 
            $data['amount']=$this->input->post('amount');
            $data['gst']=(float)(($data['amount']*18)/100);
            $data['payableAmount']=(float)($data['amount']+$data['gst']);
            $data['txn_id']=$this->input->post('txn_id');
            $data['status']='Paid';
            $data['paymentDetails']=$this->input->post('plan');
            $data['paymentDate']=date("Y-m-d H:i:s");
            $this->db->set($data);
            $this->db->where(array('paymentId'=>$result[0]->paymentId));
            $this->db->update($this->tbl);
            
        } else {
            //add new
            $data['userId']=$id;
            $data['invoiceId']=time();
            $data['paymentType']='Subscription Payment';
            $data['amount']=$this->input->post('amount');
            $data['gst']=(float)(($data['amount']*18)/100);
            $data['payableAmount']=(float)($data['amount']+$data['gst']);
            $data['txn_id']=$this->input->post('txn_id');
            $data['paymentDetails']=$this->input->post('plan');
            $data['status']='Paid';
            $data['invoiceDate']=$data['paymentDate']=date("Y-m-d H:i:s");
            $this->db->insert($this->tbl, $data);
        }
        //update plan in user table
        $this->db->set(array('plan_type'=>$this->input->post('plan'),'plan_start_date'=>date('Y-m-d H:i:s'),'plan_valid_till'=>date('Y-m-d H:i:s',strtotime("+1 year"))));
        $this->db->where(array('userId'=>$id));
        $this->db->update('users');
        $this->load->library('session');
        $session=$this->session->userdata('user');
        unset($session['non-payment']);
        $this->session->set_userdata($session);
        
        //generate invoice
        $this->load->library('pdfgenerator');
        
        //send payment confirmation email 
        $this->load->library('email');
        $emailArray = array('to'=>$_POST['email'],'subject'=>'Account created! Please verify your email');
        $data=array('first_name'=>$_POST['first_name'],'verify_link'=>base_url().'verify-account?t='.base64_encode(base64_encode(base64_encode($token))));
        $this->email->sendEmail($emailArray,'payment_confirmation',$data);
      return;
    }
    
    public function user_payments($userId){
        $this->load->database();
        $query = $this->db->select('*')->where( array(
            'userId' => $userId,
        ))->order_by('invoiceDate','desc')->get($this->tbl);
        $result = $query->result();
        echo json_encode($result);
    }
    
    public function show_invoice($invoiceId){
        $this->load->database();
        $query = $this->db->select('payments.*,users.first_name,users.last_name,users.plan_type')->join('users', 'users.userId = payments.userId')->where( array(
            'payments.invoiceId' => $invoiceId,
        ))->get($this->tbl);
        $result = $query->result();
        $this->load->library('pdfgenerator');
        $data['data']=$result[0];
       $body = $this->load->view('invoice_template/invoice',$data,TRUE);
       echo $this->pdfgenerator->generate($body);
        
    }
    
    public function add_invoice($invoiceId){
        $this->load->database();
        $query = $this->db->select('payments.*,users.first_name,users.last_name,users.plan_type')->join('users', 'users.userId = payments.userId')->where( array(
            'payments.invoiceId' => $invoiceId,
        ))->get($this->tbl);
        $result = $query->result();
        $header = $this->load->view('email_template/email_header',$data);
        $body = $this->load->view('email_template/payment_confirmation',$result);
        $footer = $this->load->view('email_template/email_footer',$data);
    
    }
}

?>