<?php
    header('content-type:application/json; charset=utf-8');
    require_once("db.php");

    //select records from the bookstore table
    $sql = "select * from `bookstore`";
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