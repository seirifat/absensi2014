<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model
{
    public $db_table = 'user';
    public function load_form_rules()
    {
        $form_rules = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'Require'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'require'
            )
        );
        return $form_rules;
    }
    public function validasi()
    {
        $form = $this->load_form_rules();
        $this->form_validation->set_rules($form);
        if($this->form_validation->run())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function cek_user()
    {
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$query = $this->db->where('username', $username)
						->where('password',$password)
						->limit(1)
						->get($this->db_table);
		if($query->num_rows() == 1)
		{
			$data = array('username' => $username, 'login' => TRUE);
			$this->session->set_userdata($data);
			return true;
		}
		else
		{
			return false;
		}
    }
	
	public function logout()
	{
		$this->session->unset_userdata(array('username' => '' , 'login' => FALSE));
		$this->session->sess_destroy();
	}
	
}