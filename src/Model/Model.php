<?php

use Ramsey\Uuid\Uuid;

class Model
{
    private $db;
    private $hostname;
    private $dbname;
    private $username;
    private $password;

    public function __construct()
    {
        $this->hostname = 'localhost';
        $this->dbname = 'test_crawler';
        $this->username = 'root';
        $this->password = '';

        $this->db = new PDO('mysql:host=' . $this->hostname . ';dbname=' . $this->dbname . ';charset=utf8mb4', $this->username, $this->password);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function db()
    {
        return $this->db;
    }

    public function createResultsTable()
    {

        $sql = "CREATE TABLE results (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(250) NOT NULL,
            url TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
        return $this->db->query($sql);
    }

    public function createUserTable()
    {

        $sql = "CREATE TABLE user (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(250) NOT NULL,
            password VARCHAR(250) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
        return $this->db->query($sql);
    }

    public function createContentTable()
    {

        $sql = "CREATE TABLE content (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(250) NOT NULL,
            url VARCHAR(250) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
        return $this->db->query($sql);
    }

    public function dropTable($table_name)
    {
        return $this->db->query("DROP TABLE {$table_name}");
    }


    public function addUser()
    {
        try {
            $sql = "INSERT INTO user(username,password) VALUES(:username,:password)";
            return $this->db->prepare($sql);
        } catch (PDOException $e) {
            return $sql . "<br>" . $e->getMessage();
        }
    }

    public function checkUser($username)
    {
        return $this->db->query("SELECT COUNT(*) as row_count FROM user WHERE username = '$username'");
    }

    public function getUser($username)
    {
        return $this->db->query("SELECT *  FROM user WHERE username = '$username'");
    }

    public function storeResults()
    {
        $query = "INSERT INTO results(title,url) VALUES(:title,:url)";
        return $this->db->prepare($query);
    }

    public function getResults()
    {
        return $this->db->query('SELECT * FROM results');
    }

    public function deleteLastResults()
    {
        return $this->db->query('DELETE FROM results');
    }

    public function postContent()
    {
        try {
            $sql = "INSERT INTO content(title,url) VALUES(:title,:url)";
            return $this->db->prepare($sql);
        } catch (PDOException $e) {
            return $sql . "<br>" . $e->getMessage();
        }
    }

    public function getContent()
    {
        return $this->db->query('SELECT * FROM content');
    }

    public function countContentRows()
    {
        return $this->db->query("SELECT COUNT(*) as row_count FROM content");
    }


    
}
