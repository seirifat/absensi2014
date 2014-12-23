<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Kelas_model extends CI_Model
{
    public $db_tabel = 'absen';

    public function __construct()
    {
		parent :: __construct();
		
	}
	
	public function cari_semua()
	{
		return $this->db->order_by('id_absen','ASC')
					->get($this->db_tabel)->result();
	}
	
	public function buat_tabel($data)
	{
		$this->load->library('table');
		$tmpl = array(
					'row_alt_start' => '<tr class="zebra">'
				);
		$this->table->set_template($tmpl);
		$this->table->set_heading('No','NIS','Nama','Semester',,'Aksi');
		$no = 0;
		foreach($data as $row)
		{
			$this->table->add_row(
				++$no, 
				$row->id_kelas, 
				$row->kelas, 
				anchor('kelas/edit/'.$row->id_kelas,'Edit',array('Class'=>'delete','onClick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
			);
		}
		$tabel = $this->table->generate();
		return $tabel;
	}
	
}