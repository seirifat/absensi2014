<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Kelas_model extends CI_Model
{
    public $db_tabel = 'kelas';

    public function __construct()
    {
		parent :: __construct();
		
	}
	
	public function cari($id_kelas)
	{
		return $this->db->where('id_kelas',$id_kelas)
						->limit(1)
						->get($this->db_tabel)
						->row();
	}
	
	public function cari_semua()
	{
		return $this->db->order_by('id_kelas','ASC')
					->get($this->db_tabel)->result();
	}
	
	public function buat_tabel($data)
	{
		$this->load->library('table');
		$tmpl = array(
					'row_alt_start' => '<tr class="zebra">'
				);
		$this->table->set_template($tmpl);
		$this->table->set_heading('No','Kode Kelas','Nama Kelas','Aksi');
		$no = 0;
		foreach($data as $row)
		{
			$this->table->add_row(
				++$no, 
				$row->id_kelas, 
				$row->kelas, 
				anchor('kelas/edit/'.$row->id_kelas,'Edit',array('class'=>'edit')).' '.
				anchor('kelas/hapus/'.$row->id_kelas,'Hapus',array('class' => 'delete','onClick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
			);
		}
		$tabel = $this->table->generate();
		return $tabel;
	}
	
	public function tambah()
	{
		$kelas = array(
			'id_kelas' => $this->input->post('id_kelas'),
			'kelas' => $this->input->post('kelas')
		);
		$this->db->insert($this->db_tabel,$kelas);
		if($this->db->affected_rows()>0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function load_form_rules_tambah()
	{
		$form_rules = array(
			array(
				'field' => 'id_kelas',
				'label' => 'Kode_kelas',
				'rules' => "required|numeric|exact_length[2]|is_unique[$this->db_tabel.id_kelas]"
			),
			array(
				'field' => 'kelas',
				'label' => 'Nama Kelas',
				'rules' => "required|max_length[32]|is_unique[$this->db_tabel.kelas]"
			)
		);
		return $form_rules;
	}
	
	public function load_form_rules_edit()
	{
		$form_rules = array(
			array(
				'field' => 'id_kelas',
				'label' => 'Kode kelas',
				'rules' => "required|numeric|exact_length[2]|callback_is_id_kelas_exist"
			),
			array(
				'field' => 'kelas',
				'label' => 'Nama Kelas',
				'rules' => "required|max_length[32]|callback_is_kelas_exist]"
			)
		);
		return $form_rules;
	}
	
	public function validasi_tambah()
	{
		$form = $this->load_form_rules_tambah();
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
	public function validasi_edit()
	{
		$form = $this->load_form_rules_edit();
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
	
	public function edit($id_kelas)
	{
		$kelas = array(
			'id_kelas' => $this->input->post('id_kelas'),
			'kelas'=>$this->input->post('kelas')
			);
		$this->db->where('id_kelas',$id_kelas);
		$this->db->update($this->db_tabel, $kelas);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}
	
	public function hapus($id_kelas)
	{
		$this->db->where('id_kelas',$id_kelas)
					->delete($this->db_tabel);
		if($this->db->affected_rows()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
}