<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Home extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();

            $this->load->model('m_surat');
        }

        public function index()
        {
            $jumlah_data = $this->m_surat->jumlah_data();
            $config['base_url'] = base_url().'/Home/index/';
            $config['total_rows'] = $jumlah_data;
            $config['per_page'] = 10;
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
            $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close']    = '</span></li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close']  = '</span>Next</li>';
            $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close']  = '</span></li>';
            $from = $this->uri->segment(3);
            $this->pagination->initialize($config);		
            $data['surat'] = $this->m_surat->getSurat($config['per_page'],$from);

            $this->load->view('index',$data);
        }

        public function cari()
        {
            $keyword = $this->input->get('keyword');
            $data = $this->m_surat->ambil_data($keyword);
            $data = array(
                'keyword'	=> $keyword,
                'surat'		=> $data
            );
            $this->load->view('index',$data);
        }

        public function lihat($id)
        {
            $data['berita'] = $this->m_surat->getSuratById($id);
            $this->load->view('lihat',$data);
        }

        public function about()
        {
            $this->load->view('about');
        }

        public function arsip()
        {
            $this->load->view('arsip');
        }

        public function TambahSurat()
        {
            $this->m_surat->addSurat();
            redirect('Home/index');
        }

        public function HapusSurat($id)
        {
            $this->m_surat->deleteSurat($id);
            redirect('Home/index');
        }

        public function UnduhSurat($id)
        {
            if(!empty($id)){
                $file1 = $this->m_surat->GetSuratById($id);
                $file = 'assets/surat/'.$file1->file;
                force_download($file, NULL);
            }
        }

        public function EditSurat($id)
        {
            $this->m_surat->updateSurat($id);
            redirect('Home/index');
        }
    }
