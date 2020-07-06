<?php

class graphDAO
{
    function __construct($consetup)
    {
        $this->host = $consetup->host;
        $this->user = $consetup->user;
        $this->pass =  $consetup->pass;
        $this->db = $consetup->db;
    }
    // Open mysql data base and create database for project
    public function open_db()
    {
        $this->condb=new mysqli($this->host,$this->user,$this->pass,$this->db);

        // Check connection
        if ($this->condb->connect_error) {
            die("Connection failed: " . $this->condb->connect_error);
        }
    }

    // close database
    public function close_db()
    {
        $this->condb->close();
    }

    //Count orders
    public function countOrders() {
        try
        {
            $this->open_db();
            $query=$this->condb->prepare("SELECT COUNT(*) FROM `order`;");
            $query->execute();
            $res=$query->get_result();
            $query->close();
            $this->close_db();
            return $res;
        }
        catch(Exception $error)
        {
            $this->close_db();
            throw $error;
        }
    }

}