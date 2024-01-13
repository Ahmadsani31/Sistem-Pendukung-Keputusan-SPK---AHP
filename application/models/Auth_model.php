<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Auth_model
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

class Auth_model extends CI_Model
{

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------

  public function afterLogin()
  {
    $isLogin =  $this->session->userdata('logged_in');
    if (!$isLogin === TRUE) {
      $this->session->sess_destroy();
      $this->session->set_flashdata('notif', '<div class="alert alert-danger">Silahkan login !</div>');
      redirect(base_url('auth'));
    }
  }

  public function beforeLogin()
  {
    $isLogin =  $this->session->userdata('logged_in');
    if ($isLogin === TRUE) {
      redirect(base_url('home'));
    }
  }

  // ------------------------------------------------------------------------
  public function login($data)
  {
    $query =  $this->db->query('SELECT * FROM user WHERE username="' . $data['username'] . '"');
    if ($query->num_rows() > 0) {
      $sql = $query->row();
      $verify = password_verify($data['password'], $sql->password);
      if ($verify) {

        $newdata = array(
          'logged_in' => TRUE,
          'nama'  => $sql->nama,
          'userid'     => $sql->id,
        );
        $this->session->set_userdata($newdata);

        redirect(base_url('home'));
      } else {
        $this->session->set_flashdata('notif', '<div class="alert alert-danger">Password Salah !</div>');
        redirect(base_url('auth'));
      }
    } else {
      $this->session->set_flashdata('notif', '<div class="alert alert-danger">Password Salah !</div>');
      redirect(base_url('auth'));
    }
  }

  // ------------------------------------------------------------------------

}

/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */