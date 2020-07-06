<?php
require 'dataAccess/graphDAO.php';

class graphController  {

    function __construct()
    {
        $this->objconfig = new config();
        $this->objsm =  new graphDAO($this->objconfig);
    }

    public function mvcHandlerGraph()
    {
        $act = isset($_GET['act']) ? $_GET['act'] : NULL;
        switch ($act)
        {
            case 'getCount' :
                $this->getOrderCount();
                break;
            case 'getNewOrderCount':
                $this->updateOrder();
                break;
            case 'getLastMonthRevenue' :
                $this -> deleteOrder();
                break;
            case 'getCustomers' :
                $this ->listOrder();
                break;
            default:
                $this ->getOrderCount();
        }
    }

    public function getOrderCount()
    {

        $res = $this->objsm->countOrders();
        $row = $res->fetch_array(MYSQLI_NUM);
    }
}