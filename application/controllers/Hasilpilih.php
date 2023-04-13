<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasilpilih extends CI_Controller
{
      function __construct()
      {
            parent::__construct();
            $this->load->model('M_calon', 'mc');
            $this->load->model('M_divisi', 'md');
            $this->load->model('M_pemilih', 'mp');
      }
      public function index()
      {
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
            $x['datapemilih'] = $this->mp->show_pemilih();

            // print_r($x);
            // print_r($dataByDivisi);
            $this->load->view('hasilpemilihan', $x);
      }
      public function export()
      {
            $x['data'] = $this->mc->show_calon();
            $x['datapemilih'] = $this->mp->show_pemilih();
            $this->load->view('hasilpemilihanexport', $x);
      }
}
