<?php
class Laporansalesbycustomerdetail_Service
{
  private static $instance;
  private function __construct()
  {
  }

  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      $c = __CLASS__;
      self::$instance = new $c;
    }

    return self::$instance;
  }

  public function getlistsales()
  {
    $registry = Zend_Registry::getInstance();
    $db = $registry->get('db');

    try {
      // $query = "SELECT sub_salecentral.kode_barang, liquid.nama_barang, sub_salecentral.harga_jual, sub_salecentral.qty, salecentral.tgl_invoice, salecentral.sub_total, customer.nama_customer, sub_salecentral.no_invoice, salecentral.keterangan FROM sub_salecentral INNER JOIN liquid ON sub_salecentral.kode_barang = liquid.kode_barang INNER JOIN salecentral ON sub_salecentral.no_invoice = salecentral.no_invoice INNER JOIN customer ON salecentral.kode_customer = customer.kode_customer";
      // $result = $db->fetchAll($query);
      // $query2 = "SELECT sub_salecentral.kode_barang, accessories.nama_aksesoris AS nama_barang, sub_salecentral.harga_jual, sub_salecentral.qty, salecentral.tgl_invoice, salecentral.sub_total, customer.nama_customer, sub_salecentral.no_invoice, salecentral.keterangan FROM sub_salecentral INNER JOIN accessories ON sub_salecentral.kode_barang = accessories.kode_aksesoris INNER JOIN salecentral ON sub_salecentral.no_invoice = salecentral.no_invoice INNER JOIN customer ON salecentral.kode_customer = customer.kode_customer";
      // $result2 = $db->fetchAll($query2);
      // $query3 = "SELECT sub_salecentral.kode_barang, atomizer.nama_atomizer AS nama_barang, sub_salecentral.harga_jual, sub_salecentral.qty, salecentral.tgl_invoice, salecentral.sub_total, customer.nama_customer, sub_salecentral.no_invoice, salecentral.keterangan FROM sub_salecentral INNER JOIN atomizer ON sub_salecentral.kode_barang = atomizer.kode_atomizer INNER JOIN salecentral ON sub_salecentral.no_invoice = salecentral.no_invoice INNER JOIN customer ON salecentral.kode_customer = customer.kode_customer";
      // $result3 = $db->fetchAll($query3);
      // $query4 = "SELECT sub_salecentral.kode_barang, device.nama_device AS nama_barang, sub_salecentral.harga_jual, sub_salecentral.qty, salecentral.tgl_invoice, salecentral.sub_total, customer.nama_customer, sub_salecentral.no_invoice, salecentral.keterangan FROM sub_salecentral INNER JOIN device ON sub_salecentral.kode_barang = device.kode_device INNER JOIN salecentral ON sub_salecentral.no_invoice = salecentral.no_invoice INNER JOIN customer ON salecentral.kode_customer = customer.kode_customer";
      // $result4 = $db->fetchAll($query4);
      // return array_merge($result, $result2, $result3, $result4);
      $query = "SELECT customer.nama_customer, tgl_invoice, no_invoice, sub_total, diskon, salecentral.keterangan, jenis_diskon, total_biaya FROM salecentral INNER JOIN customer ON salecentral.kode_customer = customer.kode_customer";
      $result = $db->fetchAll($query);

      return $result;
    } catch (Exception $e) {
      echo $e->getMessage() . '<br>';
      return $e->getMessage(); //'Data tidak ada <br>';
    }
  }

  public function getTotalByCustomer()
  {
    $registry = Zend_Registry::getInstance();
    $db = $registry->get('db');
    try {
      $query = "SELECT salecentral.kode_customer, customer.nama_customer, SUM(sub_total) AS total
      FROM salecentral JOIN customer ON salecentral.kode_customer = customer.kode_customer GROUP BY kode_customer;";
      $result = $db->fetchAll($query);
      return $result;
    } catch(Exception $e) {
      echo $e->getMessage() . '<br>';
      return $e->getMessage();
    }
  }
}
