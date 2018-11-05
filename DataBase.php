<?php

class DataBase
{
    private static $db = null;
    private $mysqli;
    private $sym_query = "{?}";

    public static function getDB($host, $username, $pass, $db_name)
    {
        if (self::$db == null) {
            $link = mysqli_connect($host, $username, $pass);
            if (!$link) {
                die('Check host, user and pass. Could not connect: ' . mysqli_error($link));
            }
                $db_selected = mysqli_select_db($link,$db_name);
            if (!$db_selected) {
                $sql = 'CREATE DATABASE ' . $db_name;
                if (!mysqli_query($link, $sql)) {
                        die('Error creating database: ' . mysqli_error($link));
                }
            }
            mysqli_close($link);
            self::$db = new DataBase($host, $username, $pass, $db_name);
        }
        self::$db->createUserTable();
        return self::$db;
    }

    public function createUserTable(){
        if(!$this->mysqli->query("CREATE TABLE IF NOT EXISTS `users` (`id` int(11) NOT NULL auto_increment PRIMARY KEY,   
          `name` varchar(250)  NOT NULL,       
          `surname` varchar(250)  NOT NULL,     
          `login` varchar(250)  NOT NULL,
          `email` varchar(250)  NOT NULL,
          `password` varchar(250)  NOT NULL,
          `gender` varchar(20)  NOT NULL,
          `birth` DATE NOT NULL)")) {die("Error creating table: ". mysqli_error($this->mysqli));}
    }
    public function getConnection(){
        return $this->mysqli;
    }
    private function __construct($host, $username, $pass, $db_name)
    {
        $this->mysqli = new mysqli($host, $username, $pass, $db_name);
        $this->mysqli->query("SET lc_time_names = 'ru_RU'");
        $this->mysqli->query("SET NAMES 'utf8'");
    }

    private function getQuery($query, $params)
    {
        if ($params) {
            for ($i = 0; $i < count($params); $i++) {
                $pos = strpos($query, $this->sym_query);
                $arg = "'" . $this->mysqli->real_escape_string($params[$i]) . "'";
                $query = substr_replace($query, $arg, $pos, strlen($this->sym_query));
            }
        }
        return $query;
    }

    public function select($query, $params = false)
    {
        $result_set = $this->mysqli->query($this->getQuery($query, $params));
        if (!$result_set) return false;
        return $this->resultSetToArray($result_set);
    }

    public function selectRow($query, $params = false)
    {
        $result_set = $this->mysqli->query($this->getQuery($query, $params));
        if ($result_set->num_rows != 1) return false;
        else return $result_set->fetch_assoc();
    }

    public function selectCell($query, $params = false)
    {
        $result_set = $this->mysqli->query($this->getQuery($query, $params));
        if ((!$result_set) || ($result_set->num_rows != 1)) return false;
        else {
            $arr = array_values($result_set->fetch_assoc());
            return $arr[0];
        }
    }

    public function query($query, $params = false)
    {
        $success = $this->mysqli->query($this->getQuery($query, $params));
        if ($success) {
            if ($this->mysqli->insert_id === 0) return true;
            else return $this->mysqli->insert_id;
        } else return false;
    }

    private function resultSetToArray($result_set)
    {
        $array = array();
        while (($row = $result_set->fetch_assoc()) != false) {
            $array[] = $row;
        }
        return $array;
    }

    public function __destruct()
    {
        if ($this->mysqli) $this->mysqli->close();
    }
}

?>