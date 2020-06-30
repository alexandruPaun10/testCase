<?php

class order
{
    // table fields
    public $id;
    public $cId;
    public $purchase_Date;
    public $country;
    public $device;

    // message string
    public $id_msg;
    public $cId_msg;
    public $purchase_Date_msg;
    public $country_msg;
    public $device_msg;

    // constructor set default value
    function __construct()
    {
        $id=$cId=0;
        $purchase_Date = date_default_timezone_get();
        $country=$device="";
        $id_msg=$cId=$purchase_Date_msg=$country_msg=$device_msg="";
    }
}

?>