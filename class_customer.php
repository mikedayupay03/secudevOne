<?php

//This is the Customer class
class Customer
{
    private $cus_name;
    private $cus_email;

    function __construct($cus_name, $cus_email)
    {
        $this->cus_name = $cus_name;
        $this->cus_email = $cus_email;
    }

    public function setCus_name($cus_name)
    {
        $this->cus_name = $cus_name;
    }

    public function setCus_email($cus_email)
    {
        $this->cus_email = $cus_email;
    }

    public function getCus_name()
    {
        return $this->cus_name;
    }

    public function getCus_email()
    {
        return $this->cus_email;
    }

}

?>