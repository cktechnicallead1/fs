<?php

$dbhost='localhost';
$dbuser='root';
$dbpass='';
$dbname='sailor';

$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if($conn)
{

}
else
{
    die("database error exists");
    exit();
}