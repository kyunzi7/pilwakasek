<?php

class M_divisi extends CI_Model
{
    private $_table = "tb_divisi";

    public $id_divisi;
    public $nama_divisi;
    public $ket_divisi;

    function show_divisi()
    {

        $hasil = $this->db->query("SELECT * FROM tb_divisi");
        return $hasil;
    }
}
