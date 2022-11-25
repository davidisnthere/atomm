<?php
class Upload_model extends CI_Model{
    public function __construct(){
		parent::__construct();

        $this->load->library('file');
	}

    public function send_welcome_mail(){

        $message = '<h1>Sending email via SMTP server</h1>';
        $message .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';
        $email = 'smarteye2015@gmail.com';
        $subject = 'Welcome to Smart Forum';
        if($this->mail_type == 'SMTP'){
            echo $this->send_smtp($email, $subject, $message);
        }else{
           echo  $this->send_mail($email, $subject, $message);
        }
        
    }

    public function send_verification_link(){

    }

    public function send_reset_link(){

    }

    public function send_notification_email(){

    }

    public function send_mail($email, $subject, $message){
         $from_email = "your@example.com"; 
         $to_email = $this->input->post('email'); 

         //Load email library 
         $this->load->library('email'); 

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

    public function send_smtp($email, $subject, $message){
        //SMTP & mail configuration
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'katyusharoc@gmail.com',
            'smtp_pass' => '',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        

        $this->email->to($email);
        $this->email->from($this->smtp_from, $this->sender_name);
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