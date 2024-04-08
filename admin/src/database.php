<?php
// session_start();
class Database{
  
  // specify your own database credentials
  
  public $db_host = "atwlive.com";
  public $db_name = "atwlivetw_main";
  public $db_user = "atwlivetw_main";
  public $db_pass = "atwlivetw_main";
  public $db_con;

  public function __construct(){
   
    try{
        $this->db_con = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_user, $this->db_pass);
    }catch(PDOException $exception){
        echo "db_conection error: " . $exception->getMessage();
    }
    //echo 'Connect good';
    return $this->db_con;


  }


}