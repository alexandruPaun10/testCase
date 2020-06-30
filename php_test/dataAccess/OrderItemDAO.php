<?php


class OrderItemDAO
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
        } else {
            echo "Connection succesful: " . $this->condb->get_server_info();
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
            $this->open_db();
            $query=$this->condb->prepare("INSERT INTO order_Items (oId,EAN,quantity,price) VALUES (?, ?, ?,?)");
            $query->bind_param("ss",$obj->oId,$obj->EAN,$obj->quantity,$obj->price);
            $query->execute();
            $res= $query->get_result();
            $last_id=$this->condb->insert_id;
            $query->close();
            $this->close_db();
            return $last_id;
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
            $query=$this->condb->prepare("UPDATE order_Items SET oId=?,EAN=?,quantity=?,price=? WHERE id=?");
            $query->bind_param("ssi", $obj->oId,$obj->EAN,$obj->quantity,$obj->price,$obj->id);
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
            $query=$this->condb->prepare("DELETE FROM order_Items WHERE id=?");
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
                $query=$this->condb->prepare("SELECT * FROM order_Items WHERE id=?");
                $query->bind_param("i",$id);
            }
            else
            {$query=$this->condb->prepare("SELECT * FROM order_Items");	}

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