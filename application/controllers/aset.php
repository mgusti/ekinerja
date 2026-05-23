<?php
defined('BASEPATH') or exit('No direct script access allowed');

class aset extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();

		is_logged_in();
		$this->load->library('form_validation');
		
    }
    
    public function index(){
		$data['title'] = 'Barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['barang'] = $this->db->get('aset_barang')->result_array();
		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('temp/topbar', $data);
		$this->load->view('aset/index', $data);
		$this->load->view('temp/footer');
    }
    
    public function tbarang(){
        $data['title'] = 'Input Data Barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['jenis'] = $this->db->get('aset_jenis')->result_array();
		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('temp/topbar', $data);
		$this->load->view('aset/tbarang', $data);
		$this->load->view('temp/footer');
	}
	
	public function ibarang(){
		$kd = $this->input->post('kode');
		
		$result = $this->db->get_where('aset_barang',['kdbarang' => $kd]);

		if($result->num_rows() >0){
			$this->session->set_flashdata('eror', 'Data Sudah Ada');
			redirect('aset');
		}else{
			$data = [
				'kdbarang' => $this->input->post('kode'),
				'nmbarang' => $this->input->post('nama'),
				'jenisbarang' =>$this->input->post('jenis'),
				'ukuran' => $this->input->post('ukuran'),
				'bahan' => $this->input->post('bahan'),
				'merk' => $this->input->post('merk')
			
			];
			$this->db->insert('aset_barang',$data);
			$this->session->set_flashdata('messege', 'DiTambahkan');
				redirect('aset');
		}
		
		
	}

	public function dbarang($kd){
		$this->db->where('kdbarang', $kd);
		$this->db->delete('aset_barang');
		
		$this->session->set_flashdata('messege', 'Dihapus');
		redirect('aset');

	}

	public function ebarang($kd){
		$data['title'] = 'Edit Barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->db->select('*');
		$this->db->from('aset_barang');
		$this->db->where('kdbarang', $kd);
		$data['barang'] = $this->db->get()->row_array(); 
		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('temp/topbar', $data);
		$this->load->view('aset/ebarang', $data);
		$this->load->view('temp/footer');
	}

	public function editbarang($kd){
		$this->db->where('kdbarang', $kd);
		$this->db->set('nmbarang', $this->input->post('nama'));
		$this->db->set('jenisbarang', $this->input->post('jenis'));
		$this->db->set('ukuran', $this->input->post('ukuran'));
		$this->db->set('bahan', $this->input->post('bahan'));
		$this->db->set('merk', $this->input->post('merk'));
		$this->db->update('aset_barang');
		$this->session->set_flashdata('messege', 'DiUbah');
		redirect('aset');

	}

	public function subbarang($kd){
		$data['title'] = 'Detail Barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->db->select('*, aset_barang.nmbarang as nama, aset_ruangan.nmruang as ruangan');
		$this->db->from('aset_sub_barang');
		$this->db->join('aset_barang', 'aset_barang.kdbarang = aset_sub_barang.kdbarang');
		$this->db->join('aset_ruangan', 'aset_ruangan.kdruang = aset_sub_barang.kdruang');
		$this->db->join('kondisi_barang', 'kondisi_barang.kdkondisi = aset_sub_barang.kondisi');
		$this->db->where('aset_sub_barang.kdbarang', $kd);
		$data['sub'] = $this->db->get()->result_array();
		$data['kode'] = $kd;
		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('temp/topbar', $data);
		$this->load->view('aset/subbarang', $data);
		$this->load->view('temp/footer');
	}

	public function dsubbarang($kd, $kode){
		$this->db->where('kdsub', $kd);
		$this->db->delete('aset_sub_barang');

		$this->session->set_flashdata('messege', 'DiHapus');
		redirect('aset/subbarang/' . $kode);
	}
	public function dallsubbarang($kode){
		$this->db->where('kdbarang', $kode);
		$this->db->delete('aset_sub_barang');

		$this->session->set_flashdata('messege', 'DiHapus');
		redirect('aset/subbarang/' . $kode);
	}

	public function isubbarang($kd){
		$data['title'] = 'Input Sub Barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['kode'] = $kd;
		$data['barang'] = $this->db->get_where('aset_barang', ['kdbarang' => $kd])->row_array();
		$data['ruang'] = $this->db->get('aset_ruangan')->result_array();
		$data['kondisi'] = $this->db->get('kondisi_barang')->result_array();
		$data['anggaran'] = $this->db->get('jenis_anggaran')->result_array();
		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('temp/topbar', $data);
		$this->load->view('aset/isubbarang', $data);
		$this->load->view('temp/footer');
	}

	public function simpansubbarang($kd){
		$jumlah  = $this->input->post('jumlah');
		
			 for ($i=0; $i < $jumlah ; $i++) { 
				$data[$i] =
				[
					'kdbarang'=> $this->input->post('kdbarang'),
					'kdruang'=> $this->input->post('ruang'),
					'kondisi'=> $this->input->post('kondisi'),
					'nilai_barang'=> $this->input->post('nilai'),
					'thn_anggaran'=> $this->input->post('tahun'),
					'jenis_anggaran'=> $this->input->post('jenis'),
					'tgl_masuk'=> $this->input->post('tglmasuk'),
					'tgl_distribusi'=> $this->input->post('tgldis'),
					'keterangan'=> $this->input->post('keterangan')
				];
			 }
					
					
				
	
			$this->db->insert_batch('aset_sub_barang', $data);
			$this->session->set_flashdata('messege', 'DiHapus');
			redirect('aset/subbarang/' . $kd);

		
	}

	public function rekapruang(){
		$data['title'] = 'Rekap Aset Ruangan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->db->select('*, aset_ruangan.nmruang as nmruangan, sum(kondisi=1) as baik, sum(kondisi=2) as sedang, sum(kondisi=3) as rusak, count(kdsub) as toba, sum(nilai_barang) as totnil');
		$this->db->from('aset_sub_barang');
		$this->db->join('aset_ruangan', 'aset_ruangan.kdruang = aset_sub_barang.kdruang');
		$this->db->group_by('aset_sub_barang.kdruang');
		$data['barang'] = $this->db->get()->result_array();
		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('temp/topbar', $data);
		$this->load->view('aset/rekapruang', $data);
		$this->load->view('temp/footer');
	}

	public function nilaiaset(){
		$data['title'] = 'Rekap Nilai Aset';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->db->select('thn_anggaran, sum(kondisi=1) as baik, sum(kondisi=1) * nilai_barang as nilaibaik , sum(kondisi=2) as sedang, sum(kondisi=2) * nilai_barang as nilaisedang, sum(kondisi=3) as rusak, sum(kondisi=3) * nilai_barang as nilairusak');
		$this->db->from('aset_sub_barang');
		$this->db->group_by('thn_anggaran');
		
		$data['tahun'] = $this->db->get()->result_array();
		
		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('temp/topbar', $data);
		$this->load->view('aset/nilaiaset', $data);
		$this->load->view('temp/footer');
	}

	

}