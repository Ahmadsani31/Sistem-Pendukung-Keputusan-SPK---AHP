<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Libraries RSAencrypt
 *
 * This Libraries for ...
 * 
 * @package		CodeIgniter
 * @category	Libraries
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class RSAencrypt
{

  // ------------------------------------------------------------------------

  public function __construct()
  {
    // 
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------

  private static $secretKey = 'aplikasi_spk_ahp';
  private static $secretIv = '199601312024';
  private static $encryptMethod = "AES-256-CBC";

  public static function ptEncrypt($string)
  {
    $key = hash('sha512', self::$secretKey);
    // $iv = substr(hash('sha512', self::$secretIv), 0, 16);
    // $result = openssl_encrypt($string, self::$encryptMethod, $key, 0, $iv);
    // return $result = base64_encode($result);

    // $cipher = "AES-256-CBC";
    $ivlen = openssl_cipher_iv_length(self::$encryptMethod);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext = openssl_encrypt($string, self::$encryptMethod, $key, OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext, $key, true);
    return base64_encode($iv . $hmac . $ciphertext);
  }
  public static function ptDecrypt($string)
  {
    $key = hash('sha512', self::$secretKey);
    // $iv = substr(hash('sha512', self::$secretIv), 0, 16);
    // $result = openssl_decrypt(base64_decode($string), self::$encryptMethod, $key, 0, $iv);
    // return $result;


    // $cipher = "AES-256-CBC";
    $c = base64_decode($string);
    $ivlen = openssl_cipher_iv_length(self::$encryptMethod);
    $iv = substr($c, 0, $ivlen);
    $hmac = substr($c, $ivlen, $sha2len = 32);
    $ciphertext = substr($c, $ivlen + $sha2len);
    $original_plaintext = openssl_decrypt($ciphertext, self::$encryptMethod, $key, OPENSSL_RAW_DATA, $iv);
    $calcmac = hash_hmac('sha256', $ciphertext, $key, true);
    if (hash_equals($hmac, $calcmac)) {
      return $original_plaintext;
    }
    return false;
  }

  // ------------------------------------------------------------------------
}

/* End of file RSAencrypt.php */
/* Location: ./application/libraries/RSAencrypt.php */