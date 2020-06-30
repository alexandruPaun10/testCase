<?php

class customer
{
    // table fields
    public $id;
    public $firstName;
    public $lastName;
    public $email;

    // message string
    public $id_msg;
    public $firstName_msg;
    public $lastName_msg;
    public $email_msg;

    // constructor set default value
    function __construct()
    {
        $id=0;$firstName=$lastName=$email="";
        $id_msg=$firstName_msg=$lastName_msg=$email_msg="";
    }
}

?>