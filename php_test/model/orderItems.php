<?php


class orderItems
{
    // table fields
    public $id;
    public $oId;
    public $EAN;
    public $quantity;
    public $price;

    // message string
    public $id_msg;
    public $oId_msg;
    public $EAN_msg;
    public $quantity_msg;
    public $price_msg;

    // constructor set default value
    function __construct()
    {
        $id=$oId=$quantity=$price=0;
        $EAN="";
        $id_msg=$oId=$EAN_msg=$quantity_msg=$price_msg="";
    }
}