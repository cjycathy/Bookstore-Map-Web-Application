<h3>Bookstore Record</h3>
    
<?php
    error_reporting(error_reporting() & ~E_NOTICE );

    require_once("../db.php");
    //To get the values of the parameters     
        $storename = $_POST['storename'];             
        $address = $_POST['address'];              
        $openhour = $_POST['openhour'];              
        $phone = $_POST['phone'];                        
        $link = $_POST['link'];             
        $lat = $_POST['lat'];              
        $lng = $_POST['lng'];

    $imgURL = null;
    //verify that a user did not leave any required fields blank when submitting
    if(!empty($storename) && is_string($storename)
    && !empty($address) && is_string($address)
    && isset($lat) && is_numeric($lat)
    && isset($lng) && is_numeric($lng)){

    //moves an uploaded file to a user-specified upload directory
        if ($_FILES["imgFile"]["error"]>0){
        print("<p>File Upload Error:".$_FILES["imgFile"]["error"]."</p>");
        }
        elseif(($_FILES["imgFile"]["type"] == "image/gif")||
        ($_FILES["imgFile"]["type"] == "image/jpeg")||
        ($_FILES["imgFile"]["type"] == "image/jpg")||
        ($_FILES["imgFile"]["type"] == "image/png")&&
        ($_FILES["imgFile"]["size"] <1000000)){
            
            $fileName = $_FILES["imgFile"]["name"];
            $tmpName = $_FILES["imgFile"]["tmp_name"];
            $destpath = "../images/";
            $imgURL = $destpath.$fileName;
            
            //Check if a file with the same name already exist
            if (file_exists($imgURL)){
                print("<p>".$fileName." already exists.</p>");
            }
            else{
                if(move_uploaded_file($tmpName,$imgURL)){
                    print("<p>Stored in:"."images/".$fileName."</p>");
                }
                else{
                    print("<p>File Upload Error:".$fileName."can not be moved</p>");
                }
            }
        }
        else{
            print("<p>File Upload Error:".$_FILES["imgFile"]["error"]."</p>");
        }
        //Insert the record to the database table          
        $sql = "insert bookstore(bookstore_name, address, opening_hour, phone_number, latitude,
        longitude, img_url, official_link) values ('$storename','$address','$openhour',
            '$phone','$lat', '$lng',  '$link','$imgURL')";

        //mysql_query("set names 'utf8'")
        $result = mysqli_query($con, $sql);
    
        if($result){
            echo "<p>Thanks for your contribution. Succeeded to insert a bookstore record!</p>";
        }
        else{
            echo"<p>Failed to insert a bookstore record.</p>";
        }
        
    }
    else{
        print "<h4> Sorry </h4>";
        print "<p> You didn't fill out the form completely. <a href = 'bookstorerecord.html'>Try again?</a></p>";
    }
?>
