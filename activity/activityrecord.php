<h3>Bookstore Record</h3>
    
<?php
    error_reporting(error_reporting() & ~E_NOTICE );

    require_once("../db.php");
    //To get the values of the parameters     
        $name = $_POST['name'];             
        //$address = $_POST['address'];              
        $time = $_POST['time'];              
        $bookstore = $_POST['bookstore'];                      
        $link = $_POST['link'];             


    $imgURL = null;
    //verify that a user did not leave any required fields blank when submitting
    if(!empty($name) && is_string($name))
    {
?>
    
<?php
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
            $destpath = "./images/";
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
            $sql = "INSERT INTO `activity` (`activity_name`, `activity_time`, 
            `bookstore_name`, `activity_link`, `img_url`) VALUES ('$name','$time','$bookstore', '$link','$imgURL')";

            $result = mysqli_query($con, $sql);
        
            if($result){
                echo "<p>Thanks for your contribution. Succeeded to insert an activity record!</p>";
            }
            else{
                echo"<p>Failed to insert a bookstore record.</p>";
            }
        
    }
    else{
        print "<h4> Sorry </h4>";
        print "<p> You didn't fill out the form completely. <a href = 'record.html'>Try again?</a></p>";
    }
?>
