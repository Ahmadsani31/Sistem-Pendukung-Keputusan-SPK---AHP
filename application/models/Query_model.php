<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Query_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Query_model extends CI_Model
{

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  function select_($select = '*', $from = '', $where = '', $order_by = '', $limit = '')
  {
    if ($from != '') {
      $this->db->select($select);
      $this->db->from($from);
      if ($where != '') {
        $this->db->where($where);
      }
      if ($order_by != '') {
        $this->db->order_by($order_by);
      }
      if ($limit != '') {
        $this->db->limit($limit);
      }
      $sql = $this->db->get();
      return $sql;
    } else {
      return '?';
    }
  }

  function GetaField($query, $Primary, $Key, $Field)
  {

    $query = $this->db->query("select $Field as Hasil from $query where $Primary = '$Key'")->row();

    return $query->Hasil;
  }

  function TambahN($table, $data)
  {

    // $UCreate = $this->session->userdata('_NamaUser');
    // $values  = array_merge($data, array(
    //   "DCreate" => date('Y-m-d H:i:s'),
    //   "UCreate" => $UCreate
    // ));

    $this->db->insert($table, $data);
    return $this->db->affected_rows();
  }

  function UpdateN($table, $data, $Primary, $value)
  {

    // $UEdited = $this->session->userdata('_NamaUser');
    // $values  = array_merge($data, array(
    //   "DEdited" => date('Y-m-d H:i:s'),
    //   "UEdited" => $UEdited
    // ));

    $this->db->where($Primary, $value);
    $this->db->update($table, $data);

    return $this->db->affected_rows();
  }

  function HapusN($table, $data)
  {

    // Hapus Data
    return $this->db->delete($table, $data);

    /* echo json_encode(array("param"=>1)); */
  }

  function Option($Table, $Primary, $Selected, $Nama, $where = '')
  {

    if ($Nama != "") {
      $Nama = $Nama;
    } else {
      $Nama = "Nama";
    }
    $data = "";

    $query = $this->db->query("SELECT * from $Table order by id ASC");

    foreach ($query->result_array() as $fetch) {

      if ($Selected == $fetch[$Primary]) {
        $sel = "selected";
      } else {
        $sel = "";
      }

      if ($Nama != "") {
        $Nama = $Nama;
      } else {
        $Nama = "Nama";
      }

      if ($Table == 'nilai_perbandingan') {
        $data .= '<option value="' . $fetch[$Primary] . '" ' . $sel . '>' . $fetch[$Nama] . ' (' . $fetch['nilai'] . ')</option>';
      } else {
        $data .= '<option value="' . $fetch[$Primary] . '" ' . $sel . '>' . $fetch[$Nama] . '</option>';
      }
    }

    return $data;
  }
  // ------------------------------------------------------------------------

}

/* End of file Query_model.php */
/* Location: ./application/models/Query_model.php */