<?php

class M_calon extends CI_Model
{

	private $_table = "tb_calon";

	public $id;
	public $namacalon;
	public $visi;
	public $misi;
	public $id_divisi;
	public $foto = "default.jpg";
	function show_calon()
	{

		$hasil = $this->db->query("SELECT * FROM tb_calon AS c INNER JOIN tb_divisi AS d ON c.id_divisi = d.id_divisi");
		return $hasil;
	}
	function insert_data()
	{
		$post = $this->input->post();
		$this->id = uniqid();
		$this->namacalon = $post["namacalon"];
		$this->visi = $post["visi"];
		$this->misi = $post["misi"];
		$this->id_divisi = $post["divisi"];
		$this->foto = $this->_uploadImage();
		$this->db->insert('tb_calon', $this);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deletecalon($id)
	{
		$hasil = $this->db->query("SELECT *  FROM tb_siswa");
		foreach ($hasil->result_array() as $i) :
			$r = $i['id'];
			$k = $i['suara'];
			if ($k == $id) {
				$this->db->query("UPDATE tb_siswa set suara='0' where id='$r'");
			};
		endforeach;

		$this->db->where('id', $id);
		$this->db->delete('tb_calon');
		// $this->_deleteImage($id);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function truncate()
	{
		$hasil = $this->db->query("SELECT *  FROM tb_siswa");
		foreach ($hasil->result_array() as $i) :
			$b = $i['id'];
			$this->db->query("UPDATE tb_siswa set suara='0' where id='$b'");
		endforeach;

		$this->db->query('TRUNCATE TABLE tb_calon');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function editcalon($id)
	{
		$this->db->where('id', $id);
		$post = $this->input->post();

		$this->id = $id;
		$this->namacalon = $post["namacalon"];
		$this->visi = $post["visi"];
		$this->misi = $post["misi"];
		$this->id_divisi = $post["divisi"];
		if (!empty($_FILES["upfoto"]["name"])) {
			$this->foto = $this->_uploadImage();
		} else {
			$this->foto = $id . '.jpg';
		}

		// print_r($this);

		$this->db->update('tb_calon', $this);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	// TODO : PILIH CALON BACKUP
	// public function pilihcalon($id)
	// {

	// 	$hasil = $this->db->query("SELECT totalsuara  FROM tb_calon where id='$id'");
	// 	foreach ($hasil->result_array() as $i) :
	// 		$k = $i['totalsuara'];
	// 		$k = $k + 1;
	// 		$this->db->query("UPDATE tb_calon set totalsuara='$k' where id='$id'");
	// 	endforeach;


	// 	$loginnis = $this->session->userdata('nis');
	// 	$field2 = array(
	// 		'suara' => $id
	// 	);
	// 	$this->db->where('nis', $loginnis);
	// 	$this->db->update('tb_siswa', $field2);

	// 	if ($this->db->affected_rows() > 0) {
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}
	// }
	// 	private function _uploadImage()
	// {
	// 	$data=$this->input->post();
	//     $config['upload_path']          = './upload';
	//     $config['allowed_types']        = 'gif|jpg|png';
	//     $config['file_name']            = $data['upfoto'];
	//     $config['overwrite']			= true;

	//     $this->load->library('upload', $config);
	//     $hasil=$this->upload->do_upload('upfoto');

	//     if ($hasil) {
	//         return $this->upload->$hasil("file_name");
	//     }else
	//     return "default.jpg";


	// 	}

	public function pilihcalon($suara)
	{
		$setDataSuara = array();
		foreach ($suara as $key => $value) {
			$setDataSuara[$key] = $value;
			$hasil = $this->db->query("SELECT totalsuara  FROM tb_calon where id='$value'");
			foreach ($hasil->result_array() as $i) :
				$k = $i['totalsuara'];
				// echo "SEBELUM DI TAMBAH {$value} : {$k} ----------- ";
				$k = $k + 1;
				// echo "SETELAH DI TAMBAH {$value} : {$k}";

				$this->db->query("UPDATE tb_calon set totalsuara='$k' where id='$value'");
			endforeach;
		}
		$loginnis = $this->session->userdata('nis');
		$this->db->where('nis', $loginnis);
		$this->db->update('tb_siswa', $setDataSuara);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	private function _uploadImage()
	{
		$config['upload_path']          = './upload/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['file_name']            = $this->id;
		$config['overwrite']			= true;
		// $config['max_size']             = 1024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('upfoto')) {
			return $this->upload->data("file_name");
		}

		return "default.jpg";
	}

	// private function _deleteImage($id)
	// {
	// 	$product = $this->$id;
	// 	if ($product->image != "default.jpg") {
	// 		$filename = explode(".", $product->image)[0];
	// 		return array_map('unlink', glob(FCPATH."upload/$filename.*"));
	// 	}
	// }

	function show_calon_by_divisi($id_divisi)
	{

		$hasil = $this->db->query("SELECT * FROM tb_calon AS c INNER JOIN tb_divisi AS d ON c.id_divisi = d.id_divisi WHERE c.id_divisi=$id_divisi");
		return $hasil;
	}
}
