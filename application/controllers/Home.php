<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 *
 * Controller Home
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

class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Auth_model', 'auth');
    $this->auth->afterLogin();
  }

  public function index()
  {

    if ($_SESSION['level'] == 1) {
      $data = [
        'title' => 'Laporan'
      ];
    } else {
      $data = [
        'title' => 'Dashboard'
      ];
    }

    $this->load->view('v_dashboard', $data, FALSE);
  }
}


/* End of file Home.php */
/* Location: ./application/controllers/Home.php */