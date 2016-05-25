<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 16.05.16
 * Time: 10:36
 */

//sleep(4);
$number = $_GET['number'];
$erg['square_of'] = $number;
$erg['erg'] = $number * $number;
//echo "$number * $number = $erg";

echo json_encode($erg);