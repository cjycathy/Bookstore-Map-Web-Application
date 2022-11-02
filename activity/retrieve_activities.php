<?php
    header('content-type:application/json; charset=utf-8');
    require_once("../db.php");

    //select a maximum 15 records from the bookstore table and put the most recent time first
    $sql = "SELECT `activity_name` Activity, `activity_time` `Time`, `bookstore_name` Bookstore, `activity_link` Link FROM `activity` order by activity_time desc ";
    //execute the "select" sql statement and returns a mysqli_result object
    $result = mysqli_query($con,$sql);

    if(!$result){
        die("Invalid query: ".mysqli_error($con));
    }

    //store a set of the retrieved records
    $info = array();
    while($row = mysqli_fetch_assoc($result)){
        array_push($info,$row);
    }
    //Get and echo JSON representation of the given array
    echo json_encode($info);

?>