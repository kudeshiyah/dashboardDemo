<?php

error_reporting(-1);
ini_set('display_errors', 'On');

class DbConnection{
  private $db_conn;

  public function getDbConn(){
      // if ($_SERVER['SERVER_NAME'] != "localhost") {
      //   $m = new MongoClient("mongodb://139.59.183.156");
      // }
      // else {
      //   $m = new MongoClient();
      // }

      // if (isset($_SESSION['city'])) {
      //   if ($_SESSION['city'] == "City1") {
      //     $this->db_conn = $m->riddhisiddhi;
      //   }
      //   elseif($_SESSION['city'] == "City2") {
      //     $this->db_conn = $m->riddhi_falna;
      //   }
      //   elseif($_SESSION['city'] == "City3") {
      //     $this->db_conn = $m->riddhi_aburoad;
      //   }
      // }
      // else {
      //   $this->db_conn = $m->admin;
      // }
      // return();
  }

  public static function set_city($city)
  {
    if ($city == "all") {
      $_SESSION['city'] = "City1";
    } else {
      $_SESSION['city'] = $city;
    }
  }

  public static function get_city()
  {
    return  $_SESSION['city'];
  }
}
?>
