<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Perhitungan
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Perhitungan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Auth_model', 'auth');
    $this->auth->afterLogin();
    $this->load->model('Query_model', 'builder');
  }

  public function kriteria()
  {
    $sql =  $this->builder->select_('', 'kriteria', '', 'id');
    $sqlN =  $this->builder->select_('', 'nilai_perbandingan', '', 'nilai');
    foreach ($sql->result_array() as $ketA) {
      $data[] = [
        'id' => $ketA['id'],
        'nama' => $ketA['nama'],
      ];
    }

    $data['kriteria'] =  $data;
    $data['title'] = 'Kriteria';
    $data['uuid'] = $this->uuid->v4();
    $data['perbandingan'] = $sqlN->result_array();
    $this->load->view('v_perhitungan-pilih-kriteria', $data, false);
  }

  public function simpan_hitung_kriteria()
  {
    $post = $this->input->post();

    foreach ($post['xy'] as $nxy) {


      $hxy = explode("_", $nxy);

      if ($hxy[0] == $hxy[1]) {
        $datamatrik[$hxy[0]][$hxy[1]] = 1;
      } else {
        if (isset($post[$hxy[0] . '_' . $hxy[1]])) {
          if ($post[$hxy[0] . '_' . $hxy[1]] > 0) {
            $datamatrik[$hxy[0]][$hxy[1]] = $post[$hxy[0] . '_' . $hxy[1]];
          } elseif ($post[$hxy[0] . '_' . $hxy[1]] < 0) {
            $datamatrik[$hxy[0]][$hxy[1]] = abs(1 / $post[$hxy[0] . '_' . $hxy[1]]);
          }
        }

        if (isset($post[$hxy[1] . '_' . $hxy[0]])) {
          if ($post[$hxy[1] . '_' . $hxy[0]] > 0) {
            $datamatrik[$hxy[0]][$hxy[1]] = abs(1 / $post[$hxy[1] . '_' . $hxy[0]]);
          } elseif ($post[$hxy[1] . '_' . $hxy[0]] < 0) {
            $datamatrik[$hxy[0]][$hxy[1]] = abs($post[$hxy[1] . '_' . $hxy[0]]);
          }
        }
      }
    }
    $this->db->empty_table('perbandingan_kriteria');
    $nox = 1;
    foreach ($datamatrik as $key => $value) {
      $noy = 1;
      foreach ($value as $a => $b) {
        $data[] = [
          'x' => $nox,
          'y' => $noy,
          'nilai' => $b
        ];
        $noy++;
      }
      $nox++;
    }

    $this->db->insert_batch('perbandingan_kriteria', $data);
    $param = $this->db->insert_id();
    if ($param > 0) {
      // redirect(base_url('kriteria/hitung_hasil'));
      redirect(base_url('perhitungan/alternatif/' . $post['uuid']));
    } else {
      show_404();
    }
  }

  public function alternatif($uuid)
  {
    if (!empty($uuid)) {
      # code...
      $sql = $this->builder->select_('', 'kriteria', '', 'code');
      $sqlAlter =  $this->builder->select_('', 'alternatif', '', 'id');
      $no = 1;
      foreach ($sqlAlter->result_array() as $alte) {
        $dataAlter[$no++] = [
          'id' => $alte['id'],
          'nama' => $alte['nama'],
        ];
      }
      $data['alternatif'] = $dataAlter;


      $data['totalKriteria'] =  $sql->result_array();
      $data['title'] = 'Alternatif';
      $data['uuid'] = $uuid;
      $this->load->view('v_perhitungan-pilih-alternatif', $data, FALSE);
    } else {
      show_404();
    }
  }

  public function simpan_hitung_alternatif()
  {
    $post = $this->input->post();

    $sql = $this->builder->select_('', 'kriteria', '', 'id');

    $totAlte = $this->db->count_all_results('kriteria', FALSE);
    // echo $totAlte;
    $i = 1;
    foreach ($sql->result_array() as  $va) {
      for ($a = 0; $a < count($post['xy' . $i]); $a++) {
        $hxy = explode("_", $post['xy' . $i][$a]);
        if ($hxy[0] == $hxy[1]) {
          $datamatrik[$va['id']][$hxy[0]][$hxy[1]] = 1;
        } else {
          if (isset($post['nilai' . $i . '_' . $hxy[0] . '_' . $hxy[1]])) {
            if ($post['nilai' . $i . '_' . $hxy[0] . '_' . $hxy[1]] > 0) {
              $datamatrik[$va['id']][$hxy[0]][$hxy[1]] = $post['nilai' . $i . '_'  . $hxy[0] . '_' . $hxy[1]];
            } elseif ($post['nilai' . $i . '_'  . $hxy[0] . '_' . $hxy[1]] < 0) {
              $datamatrik[$va['id']][$hxy[0]][$hxy[1]] = abs(1 / $post['nilai' . $i . '_' . $hxy[0] . '_' . $hxy[1]]);
            }
          }

          if (isset($post['nilai' . $i . '_'  . $hxy[1] . '_' . $hxy[0]])) {
            if ($post['nilai' . $i . '_' . $hxy[1] . '_' . $hxy[0]] > 0) {
              $datamatrik[$va['id']][$hxy[0]][$hxy[1]] = abs(1 / $post['nilai' . $i . '_'  . $hxy[1] . '_' . $hxy[0]]);
            } elseif ($post['nilai' . $i . '_' . $hxy[1] . '_' . $hxy[0]] < 0) {
              $datamatrik[$va['id']][$hxy[0]][$hxy[1]] = abs($post['nilai' . $i . '_' . $hxy[1] . '_' . $hxy[0]]);
            }
          }
        }
      }
      $i++;
    }
    $this->db->empty_table('perbandingan_alternatif');
    foreach ($datamatrik as $key => $value) {
      $nox = 1;

      foreach ($value as $a => $b) {
        $noy = 1;

        foreach ($b as $c) {
          $data[] = [
            'kriteriaid' => $key,
            'x' => $nox,
            'y' => $noy,
            'nilai' => $c
          ];
          $noy++;
        }
        $nox++;
      }
    }
    $this->db->insert_batch('perbandingan_alternatif', $data);
    $param = $this->db->insert_id();
    if ($param > 0) {
      // redirect(base_url('alternatif/hitung_hasil/' . $post['uuid']));
      redirect(base_url('perhitungan/hasil/' . $post['uuid']));
    } else {
      show_404();
    }
  }

  public function hasil($uuid)
  {
    // echo '<pre>';
    // echo print_r($_SESSION);
    // echo '</pre>';
    // exit();
    $sqKrit =  $this->builder->select_('', 'kriteria', '', 'code');
    $sqPerKrit =  $this->builder->select_('', 'perbandingan_kriteria');
    $noK = 1;
    foreach ($sqKrit->result_array() as $vaKriteria) {
      $dataKriteria[$noK++] = [
        'id' => $vaKriteria['id'],
        'nama' => $vaKriteria['nama'],
      ];
    }

    foreach ($sqPerKrit->result_array() as $HKriteria) {
      $dataKet[$HKriteria['x']][$HKriteria['y']] = $HKriteria['nilai'];
    }


    $sqAlter =  $this->builder->select_('', 'alternatif', '', 'code');
    $sqPerAlter =  $this->builder->select_('', 'perbandingan_alternatif');
    $no = 1;
    foreach ($sqAlter->result_array() as $vaAlter) {
      $dataAlter[$no++] = [
        'id' => $vaAlter['id'],
        'nama' => $vaAlter['nama']
      ];
    }

    foreach ($sqPerAlter->result_array() as $HAlter) {
      $dataHAlter[$HAlter['kriteriaid']][$HAlter['x']][$HAlter['y']] = $HAlter['nilai'];
    }

    $sqlRI =  $this->builder->select_('', 'ir', 'jumlah="' . count($dataKriteria) . '"')->row();

    // echo '<pre>';
    // echo print_r($dataPvKriteria);
    // echo '</pre>';

    $sqLap =  $this->builder->select_('', 'laporan_perhitungan', 'uuid="' . $uuid . '"');
    if ($sqLap->num_rows() == 0) {
      $totAlte = $this->db->count_all_results('laporan_perhitungan', FALSE);
      $dataJson = [
        'uuid' => $uuid,
        'nama' => 'Laporan SPK - AHP ke ' . ($totAlte + 1),
        'tb_kriteria' => json_encode($dataKriteria),
        'tb_alternatif' => json_encode($dataAlter),
        'nilai_perbandingan_kriteria' => json_encode($dataKet),
        'nilai_perbandingan_alternatif' => json_encode($dataHAlter),
        'nilai_ri' => $sqlRI->nilai,
        'user_buat' => $_SESSION['nama'],
        'tgl_buat' => date('Y-m-d H:i:s'),
      ];
      $this->db->insert('laporan_perhitungan', $dataJson);
    }


    $data['title'] = 'Hasil Perhitungan SPK Metode AHP';
    $data['alternatif'] = $dataAlter;
    $data['HAlter'] = $dataHAlter;
    $data['kriteria'] = $dataKriteria;
    $data['Hkrit'] = $dataKet;
    $data['nilai_ri'] = $sqlRI->nilai;
    $this->load->view('v_perhitungan-hasil', $data, FALSE);
  }


  public function laporan($uuid)
  {

    $sqLap =  $this->builder->select_('', 'laporan_perhitungan', 'uuid="' . $uuid  . '"');
    if ($sqLap->num_rows() > 0) {
      $q = $sqLap->row();
      $arr = json_decode($q->tb_kriteria, true);

      $data = [
        'title' => 'Laporan Hasil Perhitungan SPK Metode AHP',
        'kriteria' => json_decode($q->tb_kriteria, true),
        'alternatif' => json_decode($q->tb_alternatif, true),
        'Hkrit' => json_decode($q->nilai_perbandingan_kriteria, true),
        'HAlter' => json_decode($q->nilai_perbandingan_alternatif, true),
        'nilai_ri' => $q->nilai_ri
      ];
      $this->load->view('v_perhitungan-laporan', $data, FALSE);
    }
  }
}


/* End of file Perhitungan.php */
/* Location: ./application/controllers/Perhitungan.php */