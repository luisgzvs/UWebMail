<?php
class User_model extends CI_Model{
     
    public function create_member(){

        $code = rand(1000,99999);
        $new_member_insert = array(
            'first_name'       => $this->input->post('first_name'),
            'last_name'        => $this->input->post('last_name'),
            'email'            => $this->input->post('email'),
            'username'         => $this->input->post('username'),                    
            'password'         => md5($this->input->post('password')),
            'active'          =>'0',
            'code'             =>$code 
        );
         //Enviar correo
           $this->load->library('email');

          $config['protocol']   = 'smtp';
          $config['charset']    = 'utf-8';
          $config['smtp_host']  = 'ssl://smtp.googlemail.com';
          $config['smtp_port']  = '465';
          $config['mailtype']   = 'html';
          $config['smtp_user']  = 'testinguwebmail@gmail.com';
          $config['smtp_pass']  = 'uwebmail1515';
          $config['newline']    = "\r\n";
          $config['starttls']   = TRUE;

                    
          $this->email->initialize($config);
          $this->email->clear();


        $this->email->from('testinguwebmail@uwmail.com','UWebMail');
        $this->email->to($this->input->post('email',TRUE));
        $this->email->subject('Confirm your account-UWEBMAIL');
        $this->email->message('<h1>Pleases click the link below to comfirm your account
                                <a href="'.base_url().'users/confirm/'.$code.'">ConfirmAccount</a>
                                <b> <br/> Thanks for registration!</b></h1>');
         
        $this->email->send();


        $insert = $this->db->insert('users', $new_member_insert);
        return $insert;


  }
    

    public function update_user($code)
    {
        $this->db->where('code',$code);
        $this->db->update('users',array('active'=>'1'));
    }

    public function check_state()
    {
        $check = array('email'=>$this->input->post('email',TRUE),
         'password' => $this->input->post('password',TRUE),
          'active' => 1);
                                     
        $this->db->where('users', $check);                             
		$consulta = $this->db->get('users');                                    
                                     
        if($consulta->num_rows() == '1')
        {
            return true;

        }
        else{
            return false;
        }

    }
    
    public function very($code,$campo)
    {
        
        $this->db->where('users',array($code => $campo));
        $consulta = $this->db->get('users');
        if ($consulta->num_rows() == 1) {
                return true;
        }
        else
        {
            return false;
        }
    }
        
    public function login_user($username,$passowrd){
        //Secure password
        $enc_password = md5($passowrd);
        
        //Validate
        $this->db->where('username',$username);
        $this->db->where('password',$enc_password);
        
        $result = $this->db->get('users');
        if($result->num_rows() == 1){
            return $result->row(0)->id;
        } else {
            return false;
        }
    }
        
}