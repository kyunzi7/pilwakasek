<?php

class M_pemilih extends CI_Model
{

	function show_pemilih()
	{
		$hasil = $this->db->query("SELECT * FROM tb_siswa");
		return $hasil;
	}


	function insert_data()
	{
		$hasil = $this->db->query("SELECT id FROM pilwakasek.tb_siswa ORDER BY id DESC");
		if ($hasil->num_rows() > 0) {
			$a = $hasil->row()->id;
			$id = $a + 1;
		} else {
			$id = '001';
		}

		$field = array(
			// 'id' => uniqid(),
			'id' => $id,
			'nis' => $this->input->post('nis'),
			'password' => ($this->input->post('password')),
			'namasiswa' => $this->input->post('nama'),
			'kelas' => $this->input->post('kelas'),
			'absen' => '0'
		);

		print_r($field);

		$this->db->insert('tb_siswa', $field);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deletesiswa($id)
	{
		$suaraArray = array();
		$hasil = $this->db->query("SELECT *  FROM tb_siswa where id='$id'");
		foreach ($hasil->result_array() as $i) {
			$suaraArray['suara_1'] = $i['suara_1'];
			$suaraArray['suara_2'] = $i['suara_2'];
			$suaraArray['suara_3'] = $i['suara_3'];
			$suaraArray['suara_4'] = $i['suara_4'];
			$suaraArray['suara_5'] = $i['suara_5'];
		}

		foreach ($suaraArray as $idCalon) {
			$query = $this->db->query("SELECT totalsuara  FROM tb_calon where id='$idCalon'");
			foreach ($query->result_array() as $q) {
				$l = $q['totalsuara'];
				$l = $l - 1;
				$this->db->query("UPDATE tb_calon set totalsuara='$l' where id='$idCalon'");
			}
		}

		$this->db->where('id', $id);
		$this->db->delete('tb_siswa');


		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function truncate()
	{
		$this->db->query('TRUNCATE TABLE tb_siswa');

		$hasil = $this->db->query("SELECT *  FROM tb_calon");
		foreach ($hasil->result_array() as $i) :
			$b = $i['id'];
			$this->db->query("UPDATE tb_calon set totalsuara='0' where id='$b'");
		endforeach;

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function editsiswa($id)
	{
		$this->db->where('id', $id);
		$field = array(
			'namasiswa' => $this->input->post('nama'),
			'kelas' => $this->input->post('kelas'),
		);
		$this->db->update('tb_siswa', $field);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function editabsen($id)
	{
		$pengaw = $this->session->userdata('id');
		$field = array(
			'absen' => $id
		);

		$this->db->where('id', $id);
		$this->db->update('tb_siswa', $field);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function editabsenbatal($id)
	{
		$this->db->where('id', $id);
		$field = array(
			'absen' => '0'
		);
		$this->db->update('tb_siswa', $field);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function reset($id)
	{
		$suaraArray = array();
		$hasil = $this->db->query("SELECT *  FROM tb_siswa where id='$id'");
		foreach ($hasil->result_array() as $i) {
			$suaraArray['suara_1'] = $i['suara_1'];
			$suaraArray['suara_2'] = $i['suara_2'];
			$suaraArray['suara_3'] = $i['suara_3'];
			$suaraArray['suara_4'] = $i['suara_4'];
			$suaraArray['suara_5'] = $i['suara_5'];
		}

		foreach ($suaraArray as $idCalon) {
			$query = $this->db->query("SELECT totalsuara  FROM tb_calon where id='$idCalon'");
			// echo "{$idCalon} <br />";
			foreach ($query->result_array() as $q) {
				$l = $q['totalsuara'];
				$l = $l - 1;
				$this->db->query("UPDATE tb_calon set totalsuara='$l' where id='$idCalon'");
			}
		}

		$this->db->where('id', $id);
		$field = array(
			'suara_1' => '0',
			'suara_2' => '0',
			'suara_3' => '0',
			'suara_4' => '0',
			'suara_5' => '0',
		);
		$this->db->update('tb_siswa', $field);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}
