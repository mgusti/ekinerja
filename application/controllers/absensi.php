<?php
defined('BASEPATH') or exit('No direct script access allowed');

class absensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // is_logged_in();
        $this->load->library('form_validation');
    }

    public function absenonline()
    {

        error_reporting(0);
        $data['title'] = 'Absen Online';
        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $data['bulan'] = $this->db->get_where('bulan', ['kode_bulan' => date('m')])->row_array();
        $data['bln'] = $this->db->get('bulan')->result_array();
        $data['shift'] = $this->db->get('shift')->result_array();
        $data['ket_absen'] = $this->db->get('ket_absen')->result_array();
        $this->db->select('*, ket_absen.keterangan as kt');
        $this->db->from('absen');
        $this->db->join('shift', 'shift.kd_shift = absen.shift');
        $this->db->join('ket_absen', 'ket_absen.kd_ket_absen = absen.keterangan');
        $this->db->where('id_user', $data['user']['id_user']);
        $this->db->where('month(tgl_absen)', $this->input->get('bulan'));
        $this->db->where('year(tgl_absen)', $this->input->get('tahun'));
        $this->db->order_by('tgl_absen', 'ASC');
        $data['absen'] = $this->db->get()->result_array();

        $this->db->select('ket_absen.keterangan as kt,  count(IFNULL(absen.keterangan , 0) )  as jumlah');
        $this->db->from('absen');
        $this->db->join('ket_absen', 'ket_absen.kd_ket_absen = absen.keterangan', 'left');
        $this->db->group_by('absen.keterangan');
        $this->db->where('absen.id_user', $data['user']['id_user']);
        $this->db->where('month(absen.tgl_absen)', $this->input->get('bulan'));
        $this->db->where('year(absen.tgl_absen)', $this->input->get('tahun'));

        $data['count_absen'] = $this->db->get()->result_array();

        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('absen/absenonline', $data);
        $this->load->view('temp/footer');
    }

    public function iabsen()
    {
        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        date_default_timezone_set('Asia/Jakarta');

        $tglinput = $this->input->post('tgl');

        $tglsekarang = date('Y-m-d');

        if ($tglinput > $tglsekarang) {
            $this->session->set_flashdata('eror', 'tidak bisa input absen melewati tanggal sekrang');
            redirect('absensi/absenonline');
        } else {
            $us = $data['user']['id_user'];
            $query = $this->db->query("SELECT * FROM absen WHERE tgl_absen='$tglinput' and id_user='$us'");

            $rekam =  $query->num_rows();
            if ($rekam > 0) {
                $this->session->set_flashdata('eror', 'Tanggal Absen yang di inputkan sudah ada, silahkan cek kembali');
                redirect('absensi/absenonline');
            } else {
                $data = [
                    "id_user" => $data['user']['id_user'],
                    "kd_ruangan" => $data['user']['kd_ruangan'],
                    "tgl_absen" => $tglinput,
                    "shift" => $this->input->post('shift'),
                    "keterangan" => $this->input->post('ket'),
                    "user_input" => $data['user']['id_user'],
                    "waktu_input" => date('Y-m-d h:i:s'),
                    "peripikasi" => 0
                ];
                $this->db->insert('absen', $data);
                $this->session->set_flashdata('messege', 'Ditambah');
                redirect('absensi/absenonline');
            }
        }
    }

    public function eabsen($kd)
    {
        $this->db->where('kd_absen', $kd);
        $this->db->Set('shift', $this->input->post('eshift'));
        $this->db->Set('keterangan', $this->input->post('eket'));
        $this->db->update('absen');
        $this->session->set_flashdata('messege', 'DiUbah');
        redirect('absensi/absenonline');
    }

    public function elaporanabsen($kd)
    {
        $bl = $this->input->post('bulan2');
        $th = $this->input->post('tahun2');
        $sc = $this->input->post('search2');
        $tgl = $this->input->post('etgl');
        $this->db->where('kd_absen', $kd);
        $this->db->Set('shift', $this->input->post('eshift'));
        $this->db->Set('keterangan', $this->input->post('eket'));
        $this->db->Set('hasil_perip', $this->input->post('hasil'));
        $this->db->Set('peripikasi', $this->input->post('conf'));
        $this->db->update('absen');
        $this->session->set_flashdata('messege', 'DiUbah');
        redirect('absensi/laporanabsen/?bulan=' . $bl . '&tahun=' . $th . '&search=' . $sc);
    }

    public function absenperorang()
    {
    }

    public function laporanabsen()
    {
        $data['title'] = 'Laporan Absen';
        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['bln'] = $this->db->get_where('bulan')->result_array();
        $tgl = $this->input->get('tgl');
        $data['itg'] = $tgl;
        if ($tgl == "") {
            $ht = date('Y-m-d');
        } else {
            $ht = $tgl;
        }
        $data['bulan'] = $this->db->get_where('bulan', ['kode_bulan' => date('m')])->row_array();
        $data['shift'] = $this->db->get('shift')->result_array();
        $data['ket_absen'] = $this->db->get('ket_absen')->result_array();

        $this->db->select('*');
        $this->db->from('absen');
        $this->db->join('user', 'user.id_user = absen.id_user', 'left');
        $this->db->join('shift', 'shift.kd_shift = absen.shift', 'left');
        $this->db->join('ket_absen', 'ket_absen.kd_ket_absen = absen.keterangan', 'left');
        $this->db->where('st_peg', 1);
        $this->db->where('month(tgl_absen)', $this->input->get('bulan'));
        $this->db->where('year(tgl_absen)', $this->input->get('tahun'));
        $this->db->like('nik', $this->input->get('search'));
        $this->db->like('beda_pns', $this->input->get('beda'));
        $this->db->order_by('absen.tgl_absen', 'ASC');
        $data['absen'] = $this->db->get()->result_array();

        $this->db->from('user');
        $this->db->where('st_peg', 1);
        $data['peg'] = $this->db->count_all_results();

        $this->db->from('absen');
        $this->db->where('tgl_absen', $ht);
        $data['jabsen'] = $this->db->count_all_results();


        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('absen/laporanabsen', $data);
        $this->load->view('temp/footer');
    }

    public function rekapabsen()
    {
        error_reporting(0);
        $data['title'] = 'Rekap Absen';
        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();


        $data['bulan'] = $this->db->get('bulan')->result_array();
        $data['shift'] = $this->db->get('shift')->result_array();
        $data['ket_absen'] = $this->db->get('ket_absen')->result_array();

        $this->db->select('*, sum(absen.keterangan = 6) as jh, sum(absen.keterangan = 1) as ja, sum(absen.keterangan = 2) as ji, sum(absen.keterangan = 4) as jdl,  sum(absen.keterangan = 3) as jdc, sum(absen.keterangan = 7) as lbr, count(keterangan)as jabsen ');
        //$this->db->select('user.nik,user.nama, user.st_peg');
        $this->db->from('absen');
        $this->db->join('user', 'user.id_user = absen.id_user', 'right');
        $this->db->where('month(absen.tgl_absen)', $this->input->get('bulan'));
        $this->db->where('year(absen.tgl_absen)', $this->input->get('tahun'));
        $this->db->where('user.beda_pns', $this->input->get('role'));
        $this->db->group_by('user.id_user');


        $data['rekap'] = $this->db->get()->result_array();

        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('absen/rekapabsen', $data);
        $this->load->view('temp/footer');
    }

    public function cetakrekapabsen()
    {
        $this->db->select('*, sum(absen.keterangan = 6) as jh, sum(absen.keterangan = 1) as ja, sum(absen.keterangan = 2) as ji, sum(absen.keterangan = 4) as jdl,  sum(absen.keterangan = 3) as jdc, sum(absen.keterangan = 7) as lbr, count(keterangan)as jabsen ');
        //$this->db->select('user.nik,user.nama, user.st_peg');
        $this->db->from('absen');
        $this->db->join('user', 'user.id_user = absen.id_user', 'right');
        $this->db->where('month(absen.tgl_absen)', $this->input->get('bulan'));
        $this->db->where('year(absen.tgl_absen)', $this->input->get('tahun'));
        $this->db->where('user.st_peg', $this->input->get('role'));
        $this->db->group_by('user.id_user');


        $data['rekap'] = $this->db->get()->result_array();

        $data['bulan'] = $this->db->get_where('bulan', ['kode_bulan' => $this->input->get('bulan')])->row_array();
        $this->load->view('absen/cetakrekapabsen', $data);
    }

    public function verifikasi($tg, $kd)

    {

        $this->db->where('kd_absen', $kd);
        $this->db->set('peripikasi', 1);
        $this->db->update('absen');
        redirect('absensi/laporanabsen/?tgl=' . $tg);
    }

    public function pengajuancuti()
    {

        $data['title'] = 'Pengajuan Cuti';
        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();


        $data['bulan'] = $this->db->get('bulan')->result_array();
        $data['shift'] = $this->db->get('shift')->result_array();
        $data['ket_absen'] = $this->db->get('ket_absen')->result_array();

        $this->db->select('*, jenis_cuti.jenis_cuti as jt');
        $this->db->from('cuti');
        $this->db->join('jenis_cuti', 'cuti.jenis_cuti = jenis_cuti.kode_jenis_cuti');
        $this->db->where('id_user', $data['user']['id_user']);
        $data['cuti'] = $this->db->get()->result_array();

        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('absen/pengajuancuti', $data);
        $this->load->view('temp/footer');
    }

    public function icuti()
    {
        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $data = [
            'id_user' => $data['user']['id_user'],
            'jenis_cuti' => $this->input->post('jenis'),
            'tgl_input' => date('Y-m-d'),
            'acc_atasan' => 0,
            'acc_kepegawaian' => 0,
            'tgl_mulai_ajuan' => $this->input->post('tgl_mulai'),
            'tgl_selesai_ajuan' =>  $this->input->post('tgl_akhir'),
            'jumlah_hari' =>  $this->input->post('jumlah'),
            'keterangan_cuti' =>  $this->input->post('keterangan'),
        ];

        $this->db->insert('cuti', $data);
        $this->session->set_flashdata('messege', 'Ditambah');
        redirect('absensi/pengajuancuti');
    }

    public function ecuti($kd)
    {
        $data = [
            'jenis_cuti' => $this->input->post('jenis'),

            'acc_atasan' => 0,
            'acc_kepegawaian' => 0,
            'tgl_mulai_ajuan' => $this->input->post('tgl_mulai'),
            'tgl_selesai_ajuan' =>  $this->input->post('tgl_akhir'),
            'jumlah_hari' =>  $this->input->post('jumlah'),
            'keterangan_cuti' =>  $this->input->post('keterangan'),
        ];
        $this->db->where('kode_cuti', $kd);
        $this->db->update('cuti', $data);
        $this->session->set_flashdata('messege', 'DiUbah');
        redirect('absensi/pengajuancuti');
    }

    public function dcuti($kd)
    {
        $this->db->where('kode_cuti', $kd);
        $this->db->delete('cuti');
        $this->session->set_flashdata('messege', 'DiUhapus');
        redirect('absensi/pengajuancuti');
    }

    public function riwayatabsen()
    {
        $data['title'] = 'Riwayat Absen';

        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['bulan'] = $this->db->get('bulan')->result_array();
        $data['riwayat'] = $this->db->get('riwayat_absen')->result_array();


        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('absen/riwayatabsen', $data);
        $this->load->view('temp/footer');
    }

    public function iriwayatabsen()
    {
        $uploadimg = $_FILES['doc']['name'];
        if ($uploadimg) {
            $config['upload_path'] = './assets/pdf';
            $config['allowed_types'] = 'pdf';


            $this->load->library('upload', $config);

            if ($this->upload->do_upload('doc')) {


                $new_image = $this->upload->data('file_name');
                $this->db->set('pdf', $new_image);
            } else {
                $this->session->set_flashdata('eror', 'harus pdf');
                redirect('user/edituser');
            }
        }
        $this->db->set('bulan', $this->input->post('bulan'));
        $this->db->set('tahun', $this->input->post('tahun'));
        $this->db->insert('riwayat_absen');
        $this->session->set_flashdata('messege', 'DiTambah');
        redirect('absensi/riwayatabsen');
    }

    public function datacuti()
    {
        $data['title'] = 'Data Cuti';

        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['bulan'] = $this->db->get('bulan')->result_array();

        $this->db->select('*, jenis_cuti.jenis_cuti as jt');
        $this->db->from('cuti');
        $this->db->join('user', 'user.id_user = cuti.id_user');
        $this->db->join('jenis_cuti', 'jenis_cuti.kode_jenis_cuti= cuti.jenis_cuti');
        $data['cuti'] = $this->db->get()->result_array();


        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('absen/datacuti', $data);
        $this->load->view('temp/footer');
    }

    public function acc_cuti($kd)
    {
        $this->db->set('acc_kepegawaian', $this->input->post('persetujuan'));
        $this->db->set('keterangan_kepegawaian', $this->input->post('keterangan'));
        $this->db->where('kode_cuti', $kd);

        $this->db->update('cuti');
        $this->session->set_flashdata('messege', 'DiUpdate');
        redirect('absensi/datacuti');
    }

    public function cetak_cuti($kd)
    {
        $this->db->select('*, jenis_cuti.jenis_cuti as jt');
        $this->db->from('cuti');
        $this->db->join('user', 'user.id_user = cuti.id_user');
        $this->db->join('jenis_cuti', 'jenis_cuti.kode_jenis_cuti= cuti.jenis_cuti');
        $this->db->where('kode_cuti', $kd);
        $data['cuti'] = $this->db->get()->row_array();
        $this->load->view('absen/cetakcuti', $data);
    }
}
