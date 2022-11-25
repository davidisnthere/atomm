<?php
class Email_model extends CI_Model{
    public function __construct(){
		parent::__construct();
        //Load email library

        $this->load->library('email');
        $this->smtp_from = 'no-replay@401xd.com';
        $this->sender_name = 'Smart Forum';
        $res = $this->db->get('admin');
        if($r = $res->result()){
			foreach($r as $rr){
                $this->sender_name = $rr->name;
            }
		}
	}
    public function send_welcome_mail($email, $vcode){
        $data = array();
        $data['activation_link'] = base_url().'users/verify_account/'.$vcode;
        $body = $this->load->view('email/welcome_email',$data,TRUE); 
        $message = $body;
        $subject = 'Welcome from '.$this->sender_name;
        $this->send($email, $subject, $message);
        
        
    }
    public function send_reset_link($email, $vcode, $name){
        $data = array();
        $data['reset_link'] = base_url().'users/validat_reset_link/'.$vcode;
        $data['name'] = $name;
        $body = $this->load->view('email/reset_email',$data,TRUE); 
        $message = $body;
        $subject = 'Password Reset Link';
        $this->send($email, $subject, $message);
    }

    public function send_notification_email($msg, $email, $name){
        $data = array();
        $data['name'] = $name;
        $data['msg'] = $msg;
        $body = $this->load->view('email/notifiationt_email',$data,TRUE); 
        $message = $body;
        $subject = 'Notification from '.$this->sender_name;
        $this->send($email, $subject, $message);
    }

    public function admin_reset_email($vcode, $name){
        $data = array();
        $data['reset_link'] = base_url().'admin/validat_reset_link/'.$vcode;
        $data['name'] = $name;
        $body = $this->load->view('email/admin_reset_email',$data,TRUE); 
        $message = $body;
        $subject = 'Admin Password Reset Link '.$this->sender_name;
        $this->send($email, $subject, $message);
    }
    public function get_settings(){
        $res = $this->db->get('settings');
        if($r = $res->result()){
            foreach($r as $rr){
                return $rr;
            }
        }
    }
    public function send($email, $subject, $message){
        $setting = $this->get_settings();
        if($setting->smtp == 1){
            echo $this->send_smtp($email, $subject, $message, $setting);
        }else{
           echo  $this->send_mail($email, $subject, $message);
        }
    }
    public function send_mail($email, $subject, $message){
       
         $from_email = "no-replay@401xd.com"; 
         $to_email = $email;

         //Load email library 
         $this->load->library('email'); 
         $config['mailtype'] = 'html';
         $this->email->initialize($config);
         
         $this->email->from($from_email, $this->sender_name); 
         $this->email->to($to_email);
         $this->email->subject($subject); 
         $this->email->message($message); 

         //Send mail 
         if($this->email->send()) 
         return "Email sent successfully"; 
         else 
         return "Error in sending Email";
    }

    public function send_smtp($email, $subject, $message, $setting){
        //SMTP & mail configuration
        $config = array(
            'protocol'  => 'mail',
            'smtp_host' => $setting->host,
            'smtp_port' => $setting->port,
            'smtp_user' => $setting->user,
            'smtp_pass' => $setting->pswd,
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        

        $this->email->to($email);
        $this->email->from($setting->user, $this->sender_name);
        $this->email->subject($subject);
        $this->email->message($message);

        //Send email
        if($this->email->send()){
            return "Email sent successfully"; 
        }else{
            echo $this->email->print_debugger(array('headers'));
        }
    }


 }
?>