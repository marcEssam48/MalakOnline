<?php


class database
{


    public $query_count = 0;
    public $dbhost = 'localhost';
    public $dbuser = 'root';
    public $dbpass = '';
    public $dbname = 'church_oudas';
    // public $port = '3307';
    public $connects;


    public function __construct($dbhost = 'localhost', $dbuser = 'root', $dbpass = '', $dbname = 'church_oudas' ,$charset = 'utf8')
    {
        $this->connects =  mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        $this->connects->set_charset($charset);
    }

//public function connect(){
//
//
//        $connects = mysqli_connect('localhost', 'root', 'root', 'teradata','3307');
//}



}

?>
