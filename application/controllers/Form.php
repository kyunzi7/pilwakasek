<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_calon', 'mc');
		$this->load->model('M_divisi', 'md');
	}

	public function index()
	{
		// $x['data'] = $this->mc->show_calon();
		// $x['data_divisi'] = $this->md->show_divisi();
		$data_divisi = $this->md->show_divisi();
		foreach ($data_divisi->result_array() as $j) {
			$id = $j['id_divisi'];
			$dataByDivisi = $this->mc->show_calon_by_divisi($id);
			if ($dataByDivisi->num_rows()) {
				$x['data_by_divisi'][$id] = $dataByDivisi->result();
			}
			// $x['data_by_divisi'][$id] = $dataByDivisi;

			// foreach ($dataByDivisi->result_array() as $j) {
			//       $x['dataByDivisi_' . $id] = $j;
			// }
		}
		$x['data_divisi'] = $data_divisi;

		$this->load->view('formpemilihan', $x);
	}
	// public function pilih($id)
	// {
	// 	$result = $this->mc->pilihcalon($id);
	// 	// if($result){
	// 	// 	$this->session->set_flashdata('success_msg','Data berhasil diubah');
	// 	// }else{
	// 	// 	$this->session->set_flashdata('error_msg','Gagal mengubah data');
	// 	// }
	// 	redirect(base_url("?pesan=terimakasih"));
	// }

	public function pilihCalonWaka()
	{
		$my_array = $this->input->post('pilihan');
		foreach ($my_array as $a => $d) {
			foreach ($d as $value) {
				echo "{$a} : {$value}";
				echo "<br />";
				// $this->mc->pilihcalon($value);
			}
		}
	}
}
