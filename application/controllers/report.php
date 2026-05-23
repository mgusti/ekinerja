<?php
defined('BASEPATH') or exit('No direct script access allowed');

class report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        $this->load->library('form_validation');
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->db->from('user');
        $this->db->where('role_id = 2');
        $data['tkk'] = $this->db->count_all_results();
        $data['bln'] = $this->db->get('bulan')->result_array();
        $data['bulan'] = $this->input->post('bulan');
        $data['tahun'] = $this->input->post('tahun');



        $this->db->select('*, count(deskripsi)as des, ruangan.nama_Ruangan as nmr');
        $this->db->from('kinerja');
        $this->db->join('user', 'user.id_user = kinerja.user_id', 'right');
        $this->db->join('ruangan', 'user.kd_ruangan = ruangan.kd_ruangan', 'right');

        $this->db->group_by('user.kd_ruangan');
        $this->db->order_by('count(deskripsi)', 'DESC');
        $this->db->where('month(tgl)', $data['bulan']);
        $this->db->where('year(tgl)', $data['tahun']);

        $data['group_tkk'] = $this->db->get()->result_array();

        $this->db->select(
            '*, 
            count(deskripsi)as des,
            jabatan.nama_jabatan as nmj,
            ruangan.nama_ruangan as nmr,'
        );
        $this->db->from('kinerja');
        $this->db->join('user', 'user.id_user = kinerja.user_id', 'right');
        $this->db->join('jabatan', 'user.kd_jabatan = jabatan.kd_jabatan', 'right');
        $this->db->join('ruangan', 'user.kd_ruangan = ruangan.kd_ruangan', 'right');
        $this->db->order_by('count(deskripsi)', 'DESC');
        $this->db->group_by('user.kd_jabatan');
        $this->db->group_by('user.kd_ruangan');
        $this->db->where('user.role_id', '2');
        $this->db->where('month(tgl)', $data['bulan']);
        $this->db->where('year(tgl)', $data['tahun']);

        $data['group_jabatan'] = $this->db->get()->result_array();

        $this->db->select('*, count(user.nama) as jml, ruangan.nama_ruangan as nmr, jabatan.nama_jabatan as nmj');
        $this->db->from('user');
        $this->db->join('jabatan', 'user.kd_jabatan = jabatan.kd_jabatan', 'right');
        $this->db->join('ruangan', 'user.kd_ruangan = ruangan.kd_ruangan', 'right');
        $this->db->where('user.role_id', '2');
        $this->db->group_by('user.kd_jabatan');
        $this->db->group_by('user.kd_ruangan');
        $this->db->order_by('count(user.nama)', 'DESC');
        $data['jmltkk'] = $this->db->get()->result_array();

        $this->db->select('*, user.nik as niks, user.nama as namas, count(distinct tgl) as jml');
        $this->db->from('kinerja');
        $this->db->join('user', 'user.id_user = kinerja.user_id', 'right');
        $this->db->group_by('kinerja.user_id');
        $this->db->where('user.role_id', '2');
        $this->db->where('month(tgl)', $data['bulan']);
        $this->db->where('year(tgl)', $data['tahun']);
        $this->db->where('setujui', 1);
        $this->db->order_by('count(distinct tgl)', 'DESC');
        $this->db->order_by('timestamp', 'ASC');
        $data['jmlresponse'] = $this->db->get()->result_array();


        $thn = $data['tahun'];
        $bln = $data['bulan'];
        $query = $this->db->query("SELECT *, ruangan.nama_ruangan as nmr FROM user inner join ruangan on ruangan.kd_ruangan = user.kd_ruangan WHERE user.role_id = 2 and NOT EXISTS (SELECT * FROM kinerja WHERE  user.id_user = kinerja.user_id) ");
        $data["hhh"] = $query->result_array();




        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('report/dashboard', $data);
        $this->load->view('temp/footer');
    }

    public function kinerjatkk($id, $bulan, $tahun)
    {

        $data['title'] = 'Table Kinerja';
        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->db->select('*');
        $this->db->from('kinerja');
        $this->db->where('month(tgl)', $bulan);
        $this->db->where('year(tgl)', $tahun);
        $this->db->where('user_id', $id);

        $data['tkk'] = $this->db->get()->result_array();

        $this->load->view('penilaian/kinerjatkk', $data);
    }

    public function cetaktkktimestamp($bulan, $tahun)
    {
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->db->from('user');
        $this->db->where('role_id = 2');
        $data['tkk'] = $this->db->count_all_results();

        $this->db->from('kinerja');
        $this->db->group_by('kinerja.user_id');
        $this->db->where('month(tgl)', $data['bulan']);
        $this->db->where('year(tgl)', $data['tahun']);
        $this->db->where('setujui', '0');
        $data['jmltkk'] = $this->db->count_all_results();

        $this->db->from('kinerja');
        $this->db->group_by('kinerja.user_id');
        $this->db->where('month(tgl)', $data['bulan']);
        $this->db->where('year(tgl)', $data['tahun']);
        $this->db->where('setujui', '1');
        $data['jmlacc'] = $this->db->count_all_results();





        $this->db->select('*, user.nik as niks, user.nama as namas, count(distinct tgl) as jml, ruangan.nama_ruangan as nmr');
        $this->db->from('kinerja');
        $this->db->join('user', 'user.id_user = kinerja.user_id', 'left');
        $this->db->join('ruangan', 'user.kd_ruangan = ruangan.kd_ruangan', 'left');
        $this->db->group_by('kinerja.user_id');
        $this->db->where('user.role_id', '2');
        $this->db->where('month(tgl)', $data['bulan']);
        $this->db->where('year(tgl)', $data['tahun']);
        $this->db->where('setujui', 1);
        
        $this->db->order_by('user.nomor_kontrak', 'ASC');
        $data['jmlresponse'] = $this->db->get()->result_array();


        $this->load->view('report/cetaktkktimestamp', $data);
    }

    public function cetaktidakinput()
    {
        $query = $this->db->query("SELECT *, ruangan.nama_ruangan as nmr FROM user inner join ruangan on ruangan.kd_ruangan = user.kd_ruangan WHERE user.role_id = 2 and NOT EXISTS (SELECT * FROM kinerja WHERE  user.id_user = kinerja.user_id) ");
        $data["hhh"] = $query->result_array();
        $this->load->view('report/cetaktidakinput', $data);
    }
}
