<?php


class orderDTO
{
    // table fields
    public $id;
    public $cId;
    public $purchase_Date;
    public $country;
    public $device;
    public $EAN;
    public $quantity;
    public $price;

    // message string
    public $id_msg;
    public $cId_msg;
    public $purchase_Date_msg;
    public $country_msg;
    public $device_msg;
    public $EAN_msg;
    public $quantity_msg;
    public $price_msg;

    // constructor set default value
    function __construct()
    {
        $id=$cId=$quantity=$price=0;
        $purchase_Date = date_default_timezone_get();
        $country=$device=$EAN="";
        $id_msg=$cId=$purchase_Date_msg=$country_msg=$device_msg=$EAN=$quantity_msg=$price_msg="";
    }
}