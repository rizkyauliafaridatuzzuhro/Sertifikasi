<?php
class m_surat extends CI_Model
{

    public function getSurat($number,$offset){
        $this->db->order_by('id', 'DESC');
		return $query = $this->db->get('surat',$number,$offset)->result();		
	}
 
	public function jumlah_data(){
		return $this->db->get('surat')->num_rows();
	}

    public function ambil_data($keyword=null){
        $this->db->order_by('id', 'DESC');
		$this->db->from('surat');
		if(!empty($keyword)){
			$this->db->like('judul',$keyword);
		}
		return $this->db->get()->result();
	}

    public function GetSuratById($id)
    {
        return $this->db->get_where("surat", array('id' => $id))->row();
    }

    public function AddSurat()
    {
        $foto = $this->input->post('file');

        $config['upload_path']          = './assets/surat';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 5024;
        $config['file_name']            = rand();

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $error =  $this->upload->display_errors();
            echo $error;
        }

        $upload_data = $this->upload->data();
        $file_name = $upload_data['file_name'];

        $data = array(
            'nomor' => $this->input->post('nomor'),
            'kategori' => $this->input->post('kategori'),
            'judul' => $this->input->post('judul'),
            'file' => $file_name,
            'waktu' => date('Y-m-d\TH:i:sP')
        );

        $this->db->insert('surat', $data);
        $this->session->set_flashdata('msg', 'Surat Berhasil Di Tambahkan !!!');
    }

    public function deleteSurat($id)
	{
		$_id = $this->db->get_where('surat', ['id' => $id])->row();
        $query = $this->db->delete('surat', ['id' => $id]);
        if ($query) {
            unlink("assets/surat/" . $_id->file);
        }

        $this->session->set_flashdata('delete', 'Surat Berhasil di Hapus !!!');
	}

    public function updateSurat($id)
    {
        $_file = $this->input->post('_file');

        $config['upload_path']          = './assets/surat';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 5024;
        $config['file_name']            = rand();

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {

            $data = array(
                'nomor' => $this->input->post('nomor'),
                'kategori' => $this->input->post('kategori'),
                'judul' => $this->input->post('judul'),
                'waktu' => date('Y-m-d\TH:i:sP')
            );

            $this->db->where('id',$id);
            $this->db->update('surat', $data);

            $this->session->set_flashdata('msg', 'Surat Berhasil Di Edit !!!');

        }else{

            if ($_file) {
                unlink("assets/surat/" . $_file);
                
                $_config['upload_path']          = './assets/surat';
                $_config['allowed_types']        = 'pdf';
                $_config['max_size']             = 5024;
                $_config['file_name']            = rand();
    
                $this->load->library('upload', $_config);
    
                $upload_data = $this->upload->data();
                $_file_name = $upload_data['file_name'];
        
                $data = array(
                    'file' => $_file_name,
                    'nomor' => $this->input->post('nomor'),
                    'kategori' => $this->input->post('kategori'),
                    'judul' => $this->input->post('judul'),
                    'waktu' => date('Y-m-d\TH:i:sP')
                );
    
                $this->db->where('id',$id);
                $this->db->update('surat', $data);

                $this->session->set_flashdata('msg', 'Surat Berhasil Di Ubah !!!');
            }

        }
    }
}