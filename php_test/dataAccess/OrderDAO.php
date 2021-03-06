<?php

class orderDAO
{
    // set database config for mysql
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

    // insert record
    public function insertRecord($obj)
    {
        try
        {
            $timestamp = date("Y-m-d H:i:s");
            $this->open_db();
            $query = $this->condb->prepare("INSERT INTO `order` (cId,purchase_Date,country,device) VALUES (?, ?, ?, ?)");
            $query->bind_param("ssss", $obj->cId, $timestamp, $obj->country, $obj->device);
            $query->execute();
            $res= $query->get_result();
            $oId=$this->condb->insert_id;
            $query->close();
            $this->close_db();

            $this->open_db();
            $query2 = $this->condb->prepare("INSERT INTO order_Items (oId,EAN,quantity,price) VALUES (?, ?, ?, ?)");
            $query2->bind_param("ssss", $oId, $obj->EAN, $obj->quantity, $obj->price);
            $query2->execute();
            $query2->close();
            $this->close_db();
            return $oId;
        }
        catch (Exception $error)
        {
            $this->close_db();
            throw $error;
        }
    }

    //update record
    public function updateRecord($obj)
    {
        try
        {
            $this->open_db();
            $query=$this->condb->prepare("UPDATE `order` SET cId=?,purchase_Date=?,country=?,device=? WHERE id=?");
            $query->bind_param("ssi", $obj->cId,$_SERVER['REQUEST_TIME'],$obj->country,$obj->device,$obj->id);
            $query->execute();
            $res=$query->get_result();
            $query->close();
            $this->close_db();
            return true;
        }
        catch (Exception $error)
        {
            $this->close_db();
            throw $error;
        }
    }

    // delete record
    public function deleteRecord($id)
    {
        try{
            $this->open_db();
            $query=$this->condb->prepare("DELETE FROM `order` WHERE id=?");
            $query->bind_param("i",$id);
            $query->execute();
            $res=$query->get_result();
            $query->close();
            $this->close_db();
            return true;
        }
        catch (Exception $error)
        {
            $this->closeDb();
            throw $error;
        }
    }

    // select record
    public function selectRecord($id)
    {
        try
        {
            $this->open_db();
            if($id>0)
            {
                $query=$this->condb->prepare("SELECT `order`.id,`order`.cId, `order`.purchase_Date,`order`.country,`order`.device, 
                                                order_Items.EAN, order_Items.quantity, order_Items.price
                                                FROM   `order`
                                                LEFT JOIN order_Items
                                                ON `order`.id = order_Items.oId
                                                WHERE `order`.cId=?");
                $query->bind_param("i",$id);
            }
            else
            {$query=$this->condb->prepare("SELECT * FROM `order`");	}

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

