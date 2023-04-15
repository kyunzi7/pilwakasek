<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengawas extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_pemilih', 'mp');
		$this->load->model('M_divisi', 'md');
		$this->load->model('M_calon', 'mc');
	}
	public function index()
	{
		$x['data'] = $this->mp->show_pemilih();
		$this->load->view('viewpengawas', $x);
	}
	public function edit($id)
	{
		$result = $this->mp->editabsen($id);
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Data berhasil diubah');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal mengubah data');
		}
		redirect(base_url('Pengawas'));
	}
	public function editbatal($id)
	{
		$result = $this->mp->editabsenbatal($id);
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Data berhasil diubah');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal mengubah data');
		}
		redirect(base_url('Pengawas'));
	}
	public function hasilpemilihan()
	{
		// $this->load->model('M_calon','mc');
		// $x['data']=$this->mc->show_calon();
		// $x['datapemilih']=$this->mp->show_pemilih();
		// $this->load->view('hasilpemilihanpeng',$x);

		$data_divisi = $this->md->show_divisi();
		foreach ($data_divisi->result_array() as $j) {
			$id = $j['id_divisi'];
			$dataByDivisi = $this->mc->show_calon_by_divisi($id);
			if ($dataByDivisi->num_rows()) {
				$x['data_by_divisi'][$id] = $dataByDivisi->result();
			}
		}
		$x['data_divisi'] = $data_divisi;
		$x['datapemilih'] = $this->mp->show_pemilih();
		$this->load->view('hasilpemilihanpeng', $x);
	}
}
