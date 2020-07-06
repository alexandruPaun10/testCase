<?php
    require 'dataAccess/CustomerDAO.php';
    require 'model/customer.php';
    require 'orderController.php';
    require_once 'config.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

    class customerController
    {

        function __construct()
        {
            $this->objconfig = new config();
            $this->objsm = new customerDAO($this->objconfig);
        }

        // mvc handler request
        public function mvcHandler()
        {
            $act = isset($_GET['act']) ? $_GET['act'] : NULL;
            switch ($act) {
                case 'add' :
                    $this->insert();
                    break;
                case 'update':
                    $this->update();
                    break;
                case 'delete' :
                    $this->delete();
                    break;
                default:
                    $this->list();
            }
        }

        // page redirection
        public function pageRedirect($url)
        {
            header('Location:' . $url);
        }

        // check validation
        public function checkValidation($customerTbl)
        {
            $noerror = true;
            // Validate firstName
            if (empty($customerTbl->firstName)) {
                $customerTbl->firstName_msg = "Field is empty.";
                $noerror = false;
            } elseif (!filter_var($customerTbl->firstName, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
                $customerTbl->firstName_msg = "Invalid entry.";
                $noerror = false;
            } else {
                $customerTbl->firstName_msg = "";
            }

            // Validate lastName
            if (empty($customerTbl->lastName)) {
                $customerTbl->lastName_msg = "Field is empty.";
                $noerror = false;
            } elseif (!filter_var($customerTbl->lastName, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
                $customerTbl->lastName_msg = "Invalid entry.";
                $noerror = false;
            } else {
                $customerTbl->lastName_msg = "";
            }

            // Validate email
            if (empty($customerTbl->email)) {
                $customerTbl->email_msg = "Field is empty.";
                $noerror = false;
            } elseif (!filter_var($customerTbl->email, FILTER_VALIDATE_EMAIL)) {
                $customerTbl->email_msg = "Invalid entry.";
                $noerror = false;
            } else {
                $customerTbl->email_msg = "";
            }
            return $noerror;
        }

        // add new record
        public function insert()
        {
            try {
                $customerTbl = new customer();
                if (isset($_POST['addbtn'])) {
                    // read form value
                    $customerTbl->firstName = trim($_POST['firstName']);
                    $customerTbl->lastName = trim($_POST['lastName']);
                    $customerTbl->email = trim($_POST['email']);

                    //call validation
                    $chk = $this->checkValidation($customerTbl);
                    if ($chk) {
                        //call insert record            
                        $pid = $this->objsm->insertRecord($customerTbl);
                        if ($pid > 0) {
                            $this->list();
                        } else {
                            echo "Somthing is wrong..., try again.";
                        }
                    } else {
                        $_SESSION['customertbl0'] = serialize($customerTbl);//add session obj
                        $this->pageRedirect("view/insert.php");
                    }
                }
            } catch (Exception $e) {
                $this->close_db();
                throw $e;
            }
        }
        // update record
        public function update()
        {
            try {

                if (isset($_POST['updatebtn'])) {
                    $customerTbl = unserialize($_SESSION['customertbl0']);
                    $customerTbl->firstName = trim($_POST['firstName']);
                    $customerTbl->lastName = trim($_POST['lastName']);
                    $customerTbl->email = trim($_POST['email']);

                    // check validation  
                    $chk = $this->checkValidation($customerTbl);
                    if ($chk) {
                        $res = $this->objsm->updateRecord($customerTbl);
                        if ($res) {
                            $this->list();
                        } else {
                            echo "Somthing is wrong..., try again.";
                        }
                    } else {
                        $_SESSION['customertbl0'] = serialize($customerTbl);
                        $this->pageRedirect("view/update.php");
                    }
                } elseif (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
                    $id = $_GET['id'];
                    $result = $this->objsm->selectRecord($id);
                    $row = mysqli_fetch_array($result);
                    $customerTbl = new customer();
                    $customerTbl->id = $row["id"];
                    $customerTbl->firstName = $row["firstName"];
                    $customerTbl->lastName = $row["lastName"];
                    $customerTbl->email = $row["email"];
                    $_SESSION['customertbl0'] = serialize($customerTbl);
                    $this->pageRedirect('view/update.php');
                } else {
                    echo "Invalid operation.";
                }
            } catch (Exception $e) {
                $this->close_db();
                throw $e;
            }
        }

        // delete record
        public function delete()
        {
            try {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $res = $this->objsm->deleteRecord($id);
                    if ($res) {
                        $this->pageRedirect('index.php');
                    } else {
                        echo "Somthing is wrong..., try again.";
                    }
                } else {
                    echo "Invalid operation.";
                }
            } catch (Exception $e) {
                $this->close_db();
                throw $e;
            }
        }

        public function list()
        {
            $result = $this->objsm->selectRecord(0);
            include "view/list.php";
        }
    }
