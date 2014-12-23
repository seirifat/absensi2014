<?php if(!defined('BASEPATH'))exit('No direct script access allowed');
class Login extends CI_Controller
{
    public  $data = array('pesan' => '');
    public function __construct()
    {
        parent :: __construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Login_model','login',TRUE);
    }

    public function index()
    {
		$this->data['title'] = "Login";
        if($this->session->userdata('login')==TRUE)
        {
            redirect('kelas');
        }
        else
        {
            if($this->login->validasi())
            {
                if($this->login->cek_user())
                {
                    redirect('kelas');
                }
                else
                {
                    $this->data['pesan'] = "User atau password salah.";
                    $this->load->view('login/login_form',$this->data);
                }
            }
            else
            {
                $this->load->view('login/login_form',$this->data);
            }
        }
    }

    public function logout()
    {
        $this->login->logout();
        redirect('login');
    }
}