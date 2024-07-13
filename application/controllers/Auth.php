
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

   public function __construct()
   {
      parent::__construct();
      $this->load->library(['form_validation', 'session']);
      $this->load->database(); 
      $this->load->helper(['url', 'form']);
   }

   public function index()
   {
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
      $this->form_validation->set_rules('password', 'Password', 'trim|required');
      $data['title'] = 'Login Page';

      if ($this->form_validation->run() == false)
      {
         $this->load->view('templates/auth_header', $data);
         $this->load->view('auth/login');
         $this->load->view('templates/auth_footer');
      }
      else {
         $this->_login();
      }
   }

   private function _login()
   {
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $user = $this->db->get_where('user', ['email' => $email])->row_array();
     
      if ($user) {
         // If user exists
         if ($user['is_active'] == 1) {
            //check password
            if (password_verify($password, $user['password'])) {
               // If password is correct
               $data = [
                  'email' => $user['email'],
                  'role_id' => $user['role_id']
               ];
               $this->session->set_userdata($data);
               if ($user['role_id'] == 1){
                  redirect('admin');
               }
               else{
                  redirect('user');
               }
            }
            else {
               // If password is incorrect
               $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Invalid Password.</div>');
               redirect('auth');
            }
         }
         else {
            // If user is not activated
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated.</div>');
            redirect('auth');
         }
      }
      else {
         // If user does not exist
         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered.</div>');
         redirect('auth');
      }
   }

   public function registration()
   {
      $this->form_validation->set_rules('name', 'Name', 'required|trim');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
         'is_unique' => 'This Email has already registered!'
      ]);
      $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
         'matches' => 'Passwords do not match!',
         'min_length' => 'Password is too short'
      ]);
      $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

      if ($this->form_validation->run() == false)
      {
         $data['title'] = 'Registration Page';
         $this->load->view('templates/auth_header', $data);
         $this->load->view('auth/registration');
         $this->load->view('templates/auth_footer');
      }
      else
      {
         $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => 1,
            'date_created' => time()
         ];

         $this->db->insert('user', $data);
         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulations! Your account has been created. Please login.</div>');

         redirect('auth');
      }
   }

   public function logout()
   {
      $this->session->unset_userdata('email');
      $this->session->unset_userdata('role_id');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logout.</div>');

         redirect('auth');
   }
}