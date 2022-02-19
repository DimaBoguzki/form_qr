<?php


abstract class DB{
  protected mysqli $_conn;

  private const HOSTNAME="localhost";
  private const USER="root";
  private const PASSWORD="";

  const DB_NAME='matala';

  public function __construct() {
    try{
      $this->_conn=new mysqli(self::HOSTNAME, self::USER, self::PASSWORD);
      $this->_conn->query("CREATE DATABASE IF NOT EXISTS ".self::DB_NAME);
      if(!$this->_conn->select_db(self::DB_NAME)){
        die('cans use matala db');
      }
    }
    catch(Exception $e){
      echo "Failed to connect to MySQL: " . $e->getMessage();
      die();
    }
  }
}

class UserQuery extends DB {

  const TABLE_NAME='user';

  function __construct() {
    parent::__construct();
    if($res=$this->_conn->query("SHOW TABLES LIKE '".self::TABLE_NAME."'"))
      $res->num_rows == 0 && $this->_createTable();
  }

  public function InserUser(string $id, string $name, string $phone, string $mail, string $code) : bool {
    return $this->_conn->query(
        "INSERT INTO ".self::TABLE_NAME." (id, name, phone, mail, qr_code) VALUES ('$id','$name', '$phone', '$mail','$code')"
      );
  }
  public function getLast(){
    $res=$this->_conn->query("SELECT * FROM ".self::TABLE_NAME." ORDER BY id DESC LIMIT 1");
    return $res->fetch_assoc();
  }
  public function getUserById(string $id){
    $res=$this->_conn->query("SELECT * FROM ".self::TABLE_NAME." WHERE id='$id'");
    return $res->fetch_assoc();
  }
  private function _createTable() : void {
    $sql="CREATE TABLE ".self::TABLE_NAME."(
      id VARCHAR(16) PRIMARY KEY,
      name VARCHAR(128) NULL,
      phone VARCHAR(10) NULL,
      mail VARCHAR(128),
      qr_code VARCHAR(10),
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
    if (!$this->_conn->query($sql)) 
      die("Fail Table ".self::TABLE_NAME." created");
  }
}
//TIMESTAMP