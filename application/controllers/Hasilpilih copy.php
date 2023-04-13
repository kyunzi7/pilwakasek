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
            $x['data'] = $this->mc->show_calon();
            $x['datapemilih'] = $this->mp->show_pemilih();
            $this->load->view('hasilpemilihan', $x);
      }
      public function export()
      {
            $x['data'] = $this->mc->show_calon();
            $x['datapemilih'] = $this->mp->show_pemilih();
            $this->load->view('hasilpemilihanexport', $x);
      }
}
