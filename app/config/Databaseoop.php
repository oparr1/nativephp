<?php
// returns the current directory
// database configuration 
require_once __DIR__ . '/app/config.php';

class Database {

    //======================================================================
    // MYSQLI
    //======================================================================

    private $conn;
    private static $_instance; //The single instance
    private $servername = DB_SERVERNAME;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $dbname = DB_NAME;

    // Calls when we create new object e.g $db = new Database();
    public static function getInstance() {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
    return self::$_instance;
    }

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);      
        $this->conn->set_charset("utf8"); // Change to Utf8

        if($this->conn->connect_error) {
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
        }
    } 

    // Automatically close connection
    public function __destruct() {
      mysqli_close($this->conn); // echo "Connection closed";
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }

    // Get mysqli connection
    public function getConnected() {
        return $this->conn;
    }

    //======================================================================
    // SAFE INPUT / OUTPUT
    //======================================================================

    // Escape output safely - Use on all database echo / OUTPUT
    function html($data) {
      $data = htmlspecialchars($data, ENT_QUOTES); // <>
        return $data;
    }

    // Clean input before post - Use for Insert and update
  function clean_input($data, $default = NULL) {
    // trim(); // no whitespaces
    // stripslashes(); // \\\
    // strip_tags(); // <p></p>
    // mysqli_real_escape_string(); // when using dynamic queries without prepared statement

    // return isset and sanitized POST
      return isset($_POST[$data]) ? stripslashes(trim($_POST[$data])) : $default;
  } 

}