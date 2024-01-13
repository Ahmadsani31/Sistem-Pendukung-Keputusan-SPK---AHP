<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Alternatif
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

class Alternatif extends CI_Controller
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

    $data['title'] = 'Alternatif';
    $this->load->view('v_alternatif', $data, FALSE);
  }

  public function kelola($id)
  {
    $data = [
      'id' => '',
      'nama' => '',
      'code' => '',
    ];
    if ($id != 0) {
      $sql =  $this->builder->select_('', 'alternatif', 'id="' . $id . '"');
      if ($sql != '?') {
        $row = $sql->row();
        $data = [
          'id' => $row->id,
          'nama' => $row->nama,
          'code' => $row->code,
        ];
      }
    }
    $data['title'] = 'Alternatif';
    $this->load->view('v_alternatif-kelola', $data, FALSE);
  }

  public function simpan()
  {
    $post = $this->input->post();


    $data = [
      'nama' => $post['nama'],
      'code' => $post['code']
    ];

    if ($post['id'] == 0) {
      $param = $this->builder->TambahN('alternatif', $data);
    } else {
      $param = $this->builder->UpdateN('alternatif', $data, 'id', $post['id']);
    }
    if ($param > 0) {
      $this->session->set_flashdata('success', 'User Updated successfully');
    } else {
      $this->session->set_flashdata('error', 'Something is wrong.');
    }

    redirect('/alternatif');
  }
}


/* End of file Alternatif.php */
/* Location: ./application/controllers/Alternatif.php */