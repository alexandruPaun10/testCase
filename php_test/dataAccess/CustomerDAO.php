<?php
	
	class customerDAO
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
            return $this->condb;
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
				$query=$this->condb->prepare("INSERT INTO customer (firstName,LastName,email) VALUES (?, ?, ?)");
				$query->bind_param("sss",$obj->firstName,$obj->lastName,$obj->email);
				$query->execute();
				$res= $query->get_result();
				$last_id=$this->condb->insert_id;
				$query->close();
				$this->close_db();
				return $last_id;
			}
			catch (Exception $e) 
			{
				$this->close_db();	
            	throw $e;
        	}
		}

        //update record
		public function updateRecord($obj)
		{
			try
			{	
				$this->open_db();
				$query=$this->condb->prepare("UPDATE customer SET firstName=?,lastName=?,email=? WHERE id=?");
				$query->bind_param("sssi",$obj->firstName,$obj->lastName,$obj->email,$obj->id);
				$query->execute();
				$res=$query->get_result();						
				$query->close();
				$this->close_db();
				return true;
			}
			catch (Exception $e) 
			{
            	$this->close_db();
            	throw $e;
        	}
        }

         // delete record
		public function deleteRecord($id)
		{	
			try{
				$this->open_db();
				$query=$this->condb->prepare("DELETE FROM customer WHERE id=?");
				$query->bind_param("i",$id);
				$query->execute();
				$res=$query->get_result();
				$query->close();
				$this->close_db();
				return true;	
			}
			catch (Exception $e) 
			{
            	$this->closeDb();
            	throw $e;
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
					$query=$this->condb->prepare("SELECT * FROM customer WHERE id=?");
					$query->bind_param("i",$id);
				}
                else
                {$query=$this->condb->prepare("SELECT * FROM customer");	}

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
?>