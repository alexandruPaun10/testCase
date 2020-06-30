<?php


class databaseLogic
{
// set database config for mysql
    function __construct($consetup)
    {
        $this->host = $consetup->host;
        $this->user = $consetup->user;
        $this->pass = $consetup->pass;
        $this->db = $consetup->db;
    }

    public function createDB()
    {
        $this->condb = new mysqli($this->host, $this->user, $this->pass, $this->db);

//        $sql = "DROP TABLE Items;";
//        if ($this->condb->query($sql) === TRUE) {
//            echo "Table dropped successfully";
//        }

        // Create database
        $sql = "CREATE DATABASE testCaseDB";
        if ($this->condb->query($sql) === TRUE) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $this->condb->error;
        }

        // Sql to create db tables

        $sql = "CREATE TABLE customer (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    firstName VARCHAR(30) NOT NULL,
                    lastName VARCHAR(30) NOT NULL,
                    email VARCHAR(50)
                    )";

        if ($this->condb->query($sql) === TRUE) {
            echo "Table Customer created successfully";
        } else {
            echo "Error creating table: " . $this->condb->error;
        }

//        $sql = "CREATE TABLE `order` (
//                      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//                      cId INT(6) UNSIGNED,
//                      purchase_Date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//                      country VARCHAR(50),
//                      device VARCHAR (50),
////                      FOREIGN KEY (cid) REFERENCES customer(id)
//                      )";

        if ($this->condb->query($sql) === TRUE) {
            echo "Table Order created successfully";
        } else {
            echo "Error creating table: " . $this->condb->error;
        }

//        $sql = "CREATE TABLE order_Items (
//                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//                    oId INT(6) UNSIGNED,
//                    EAN VARCHAR (30) NOT NULL,
//                    quantity INT(6) NOT NULL,
//                    price DECIMAL(10,2),
//                   FOREIGN KEY (oid) REFERENCES `order`(id)
//                    )";

        if ($this->condb->query($sql) === TRUE) {
            echo "Table Order_Items created successfully";
        } else {
            echo "Error creating table: " . $this->condb->error;
        }
    }
}
