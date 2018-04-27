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
}

?>