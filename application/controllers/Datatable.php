<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path
require_once 'vendor/autoload.php';

use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\CodeigniterAdapter;

/**
 *
 * Controller Datatable
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

class Datatable extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $table = $this->input->post('tabel', true);
    $dt = new Datatables(new CodeigniterAdapter());

    switch ($table) {
      case 'kriteria':

        $dt->query('SELECT id,nama,code FROM kriteria');
        $dt->add('Action', function ($data) {
          $btn = "<a href=" . base_url('kriteria/kelola/') . $data['id'] . " class='btn btn-sm btn-primary mr-2 mb-1'><i class='fa fa-edit'></i> Edit</a>";
          $btn .= "<a href=" . base_url('delete/kriteria/id/') . $data['id'] . " class='btn btn-sm btn-danger mb-1'><i class='fa fa-trash'></i> Hapus</a>";
          return $btn;
        });
        echo $dt->generate();
        break;
      case 'alternatif':

        $dt->query('SELECT id,nama,code FROM alternatif');
        $dt->add('Action', function ($data) {
          $btn = "<a href=" . base_url('alternatif/kelola/') . $data['id'] . " class='btn btn-sm btn-primary mr-2 mb-1'><i class='fa fa-edit'></i> Edit</a>";
          $btn .= "<a href=" . base_url('delete/alternatif/id/') . $data['id'] . " class='btn btn-sm btn-danger mb-1'><i class='fa fa-trash'></i> Hapus</a>";
          return $btn;
        });
        echo $dt->generate();
        break;
      case 'laporan':

        $dt->query('SELECT uuid,nama,tgl_buat,user_buat FROM laporan_perhitungan');
        $dt->add('Action', function ($data) {
          $btn = "<a href=" . base_url('perhitungan/laporan/') . $data['uuid'] . " class='btn btn-sm btn-primary mr-2 mb-1'><i class='fa fa-edit'></i> Lihat</a>";
          $btn .= "<a href=" . base_url('perhitungan/laporan-print/') . $data['uuid'] . " target='_blank' class='btn btn-sm btn-info mr-2 mb-1'><i class='fa fa-edit'></i> print</a>";
          $btn .= "<a href=" . base_url('delete/laporan/uuid/') . $data['uuid'] . " class='btn btn-sm btn-danger mb-1'><i class='fa fa-trash'></i> Hapus</a>";
          return $btn;
        });
        $dt->edit('nama', function ($data) {
          return $data['nama'];
        });

        $dt->edit('tgl_buat', function ($data) {
          return TanggalIndo($data['tgl_buat']);
        });
        echo $dt->generate()->toJson();
        break;
      default:
        # code...
        break;
    }
  }
}


/* End of file Datatable.php */
/* Location: ./application/controllers/Datatable.php */