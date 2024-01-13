<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Kriteria
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

require_once 'vendor/autoload.php';

use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\CodeigniterAdapter;


class Kriteria extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Auth_model', 'auth');
    $this->auth->afterLogin();
    $this->load->model('Query_model', 'builder');
  }

  public function index()
  {

    $data['title'] = 'Kriteria';
    $this->load->view('v_kriteria', $data, FALSE);
  }

  public function kelola($id)
  {
    $data = [
      'id' => '',
      'nama' => '',
      'code' => '',
    ];
    if ($id != 0) {
      $sql =  $this->builder->select_('', 'kriteria', 'id="' . $id . '"');
      if ($sql != '?') {
        $row = $sql->row();
        $data = [
          'id' => $row->id,
          'nama' => $row->nama,
          'code' => $row->code,
        ];
      }
    }
    $data['title'] = 'Kriteria';
    $this->load->view('v_kriteria-kelola', $data, FALSE);
  }

  public function simpan()
  {
    $post = $this->input->post();


    $data = [
      'nama' => $post['nama'],
      'code' => $post['code']
    ];

    if ($post['id'] == 0) {
      $param = $this->builder->TambahN('kriteria', $data);
    } else {
      $param = $this->builder->UpdateN('kriteria', $data, 'id', $post['id']);
    }
    if ($param > 0) {
      $this->session->set_flashdata('success', 'User Updated successfully');
    } else {
      $this->session->set_flashdata('error', 'Something is wrong.');
    }
    redirect(base_url('kriteria'));
  }
}


/* End of file Kriteria.php */
/* Location: ./application/controllers/Kriteria.php */