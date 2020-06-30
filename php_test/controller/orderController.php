<?php
    require 'dataAccess/orderDAO.php';
    require 'model/order.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

class orderController
{
    function __construct()
    {
        $this->objconfig = new config();
        $this->objsm =  new orderDAO($this->objconfig);
    }

    // mvc handler request
    public function mvcHandlerOrder()
    {
        $act = isset($_GET['act']) ? $_GET['act'] : NULL;
        switch ($act)
        {
            case 'add' :
                $this->insert();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete' :
                $this -> delete();
                break;
            default:
                $this->list();
        }
    }
    // page redirection
    public function pageRedirect($url)
    {
        header('Location:'.$url);
    }
    // check validation
    public function checkValidation($orderTbl)
    {    $noerror=true;

        // Validate purchase Date
        if(empty($orderTbl->purchase_Date)){
            $orderTbl->purchase_Date_msg = "Field is empty.";$noerror=false;
        } elseif(!filter_var($orderTbl->purchase_Date, FILTER_VALIDATE_DATE, array("options"=>array("regexp"=>"~^\d{2}/\d{2}/\d{4}$~")))){
            $orderTbl->purchase_Date_msg = "Invalid entry.";$noerror=false;
        }else{$orderTbl->purchase_Date_msg ="";}

        // Validate device
        if(empty($orderTbl->device)){
            $orderTbl->device_msg = "Field is empty.";$noerror=false;
        } elseif(!filter_var($orderTbl->device_msg, FILTER_VALIDATE_EMAIL)){
            $orderTbl->device_msg = "Invalid entry.";$noerror=false;
        }else{$orderTbl->device_msg ="";}

        // Validate country
        if(empty($orderTbl->country)){
            $orderTbl->country_msg = "Field is empty.";$noerror=false;
        } elseif(!filter_var($orderTbl->country, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $orderTbl->country_msg = "Invalid entry.";$noerror=false;
        }else{$orderTbl->country_msg ="";}
        return $noerror;


    }

    // add new record
    public function insert()
    {
        try{
            $orderTbl =new order();
            if (isset($HTTP_POST_VARS['addbtn']))
            {
                // read form value
                $orderTbl->purchase_Date = trim($HTTP_POST_VARS['purchase_Date']);
                $orderTbl->country = trim($HTTP_POST_VARS['country']);
                $orderTbl->device = trim($HTTP_POST_VARS['device']);

                //call validation
                $chk=$this->checkValidation($orderTbl);
                if($chk)
                {
                    //call insert record
                    $pid = $this -> objsm ->insertRecord($orderTbl);
                    if($pid>0){
                        $this->list();
                    }else{
                        echo "Somthing is wrong..., try again.";
                    }
                }else
                {
                    $_SESSION['orderTbl0']=serialize($orderTbl);//add session obj
                    $this->pageRedirect("view/insertOrder.php");
                }
            }
        }catch (Exception $error)
        {
            $this->close_db();
            throw $error;
        }
    }
    // update record
    public function update()
    {
        try
        {

            if (isset($HTTP_POST_VARS['updatebtn']))
            {
                $orderTbl=unserialize($_SESSION['orderTbl0']);
                $orderTbl->purchase_Date = trim($HTTP_POST_VARS['purchase_Date']);
                $orderTbl->country = trim($HTTP_POST_VARS['country']);
                $orderTbl->device = trim($HTTP_POST_VARS['device']);

                // check validation
                $chk=$this->checkValidation($orderTbl);
                if($chk)
                {
                    $res = $this -> objsm ->updateRecord($orderTbl);
                    if($res){
                        $this->list();
                    }else{
                        echo "Somthing is wrong..., try again.";
                    }
                }else
                {
                    $_SESSION['customertbl0']=serialize($orderTbl);
                    $this->pageRedirect("view/updateOrder.php");
                }
            }elseif(isset($HTTP_GET_VARS["id"]) && !empty(trim($HTTP_GET_VARS["id"]))){
                $id=$HTTP_GET_VARS['id'];
                $result=$this->objsm->selectRecord($id);
                $row=mysqli_fetch_array($result);
                $orderTbl=new order();
                $orderTbl->id=$row["id"];
                $orderTbl->cId=$row["cId"];
                $orderTbl->purchase_Date=$row["purchase_Date"];
                $orderTbl->country=$row["country"];
                $orderTbl->device=$row["device"];
                $_SESSION['$orderTbl0']=serialize($orderTbl);
                $this->pageRedirect('view/updateOrder.php');
            }else{
                echo "Invalid operation.";
            }
        }
        catch (Exception $error)
        {
            $this->close_db();
            throw $error;
        }
    }
    // delete record
    public function delete()
    {
        try
        {
            if (isset($_GET['cid']))
            {
                $id=$_GET['cid'];
                $res=$this->objsm->deleteRecord($id);
                if($res){
                    $this->pageRedirect('indexOrder.php');
                }else{
                    echo "Somthing is wrong..., try again.";
                }
            }else{
                echo "Invalid operation.";
            }
        }
        catch (Exception $error)
        {
            $this->close_db();
            throw $error;
        }
    }
    public function list(){
        $result=$this->objsm->selectRecord(0);
        include "view/listOrder.php";
    }
}