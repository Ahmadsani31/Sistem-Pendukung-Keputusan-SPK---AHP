<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Delete
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

class Delete extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Query_model', 'builder');
  }

  public function index()
  {
    $table =  $this->uri->segment(2);
    $primary =  $this->uri->segment(3);
    $id =  $this->uri->segment(4);
    switch ($table) {
      case 'kriteria':
        $values = array(
          $primary => $id
        );
        $param =  $this->builder->HapusN($table, $values);
        break;
      case 'alternatif':
        $values = array(
          $primary => $id
        );
        $param =  $this->builder->HapusN($table, $values);
        break;

      default:
        $param = 0;
        break;
    }
    if ($param > 0) {
      $this->session->set_flashdata('success', 'User Delete successfully');
    } else {
      $this->session->set_flashdata('error', 'Something is wrong.');
    }
    redirect($_SERVER['HTTP_REFERER']);
  }
}


/* End of file Delete.php */
/* Location: ./application/controllers/Delete.php */