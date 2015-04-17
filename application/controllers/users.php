<?php

date_default_timezone_set('Etc/UTC');
require 'application/libraries/phpMailer/PHPMailerAutoload.php';
require 'application/libraries/phpMailer/class.phpmailer.php';

class Users extends CI_Controller{
    
    public function register(){
        if($this->session->userdata('logged_in')){
            redirect('home/index');
        }
        $this->form_validation->set_rules('first_name','First Name','trim|required|xss_clean');
        $this->form_validation->set_rules('last_name','Last Name','trim|required|xss_clean');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean');
        
        $this->form_validation->set_rules('username','Username','trim|required|min_length[4]|xss_clean');      
        $this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[50]|xss_clean');
        $this->form_validation->set_rules('password2','Confirm Password','trim|required|matches[password]|xss_clean');
        
        if($this->form_validation->run() == FALSE){
            //Load view and layout
            $data['main_content'] = 'users/register';
            $this->load->view('layouts/main',$data);
        //Validation has ran and passed    
        } else {
           if($this->User_model->create_member()){
                
          //Create a new PHPMailer instance
          $mail = new PHPMailer;
          $mail->isSMTP();
          $mail->Host = "smtp.gmail.com";
          $mail->Port = 587;
          $mail->SMTPDebug  = 2;
          //Whether to use SMTP authentication
          $mail->SMTPAuth = true;
          //Username to use for SMTP authentication
          $mail->Username = "testinguwebmail@gmail.com";
          //Password to use for SMTP authentication
          $mail->Password = "uwebmail1515";
          //Set who the message is to be sent from
          $mail->setFrom('nonreply@uwebmail.com', 'First Last');
          //Set who the message is to be sent to
          $mail->addAddress('luisgzvs@gmail.com', 'Test');
          //Set the subject line
          $mail->Subject = 'UWEbMail verification';      
          //Read an HTML message body from an external file, convert referenced images to embedded,
          //convert HTML into a basic plain-text alternative body
          $mail->msgHTML('This is a plain-text message body');

          //Replace the plain text body with one created manually
          $mail->AltBody = 'This is a plain-text message body';

          
          //send the message, check for errors
          if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
          } else {
            echo "Message sent!";
          }

          //esto ocasiona que no se ejecute el codigo anterior o al menos que no se muestren los mensajes

          $this->session->set_flashdata('registered', 'You are now registered, please confirm your account');
          redirect('home/index');

           }
        }
    }
    
    
    public function login(){
        $this->form_validation->set_rules('username','Username','trim|required|min_length[4]|xss_clean');      
        $this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[50]|xss_clean');        
        
        if($this->form_validation->run() == FALSE){
            //Set error
            $this->session->set_flashdata('login_failed', 'Sorry, the login info that you entered is invalid');
            redirect('home/index');
        } else {
           //Get from post
           $username = $this->input->post('username');
           $password = $this->input->post('password');
               
           //Get user id from model
           $user_id = $this->User_model->login_user($username,$password);
               
           //Validate user
           if($user_id){
               //Create array of user data
               $user_data = array(
                       'user_id'   => $user_id,
                       'username'  => $username,
                       'logged_in' => true
                );
                //Set session userdata
               $this->session->set_userdata($user_data);
                                  
               redirect('home/index');
            } else {
                //Set error
                $this->session->set_flashdata('login_failed', 'Sorry, the login info that you entered is invalid');
                redirect('home/index');
            }
        }
    }
    
    
    public function logout(){
        //Unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        
         //Set message
        $this->session->set_flashdata('logged_out', 'You have been logged out');
        redirect('home/index');
    }
    
    
}