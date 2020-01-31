# Bookstore-Map-Web-Application
### Introduction
1)	Background
With the development of Internet and quickening pace of modern society, bookstores have become less popular than ever, since people prefer shopping online to buy books or even online reading. In this case, in some metropolises of China, a number of independent bookstores are springing out as a newborn, providing not only areas for selling books but also spaces for knowledge sharing and culture gathering. However, these bookstores are dispersed and lacking of well-connected network to generate as a systemic cultural marker.
There are some web applications help reader to find the location of a bookstore like baidu map https://map.baidu.com/, to post reading activities information like douban https://www.douban.com/location/world/, to give marks for bookstores like dianping https://www.dianping.com/. Nevertheless, none of them integrates these resources together so it is rather inconvenient for users. 
On these accounts, I want to develop a reading map not only showing the locations of varies independent bookstores but also providing well-organized cultural activities information.      

2)	Target Users and Publishers
There are mainly three types of users. The first are the readers who will acquire the information of a variety of reading areas and activities. The second are the storekeepers. With the reading map web, they will be able to advertise their stores and activities. The third are the travelers. Their main purpose may not read but visit a cultural landmark of a city such as the renowned Shakespeare and Company in Paris and the Pioneer Bookstore in Nanjing. Moreover, these three types of users are also publishers. They can be the participants to add and update the locations and activities, which will together help to enlarge the database. 

### System Description
1)	Software Architecture
The software architecture layout is shown as follows.
 

2)	Main Algorithms 
	Bookstore map
In the map.js, I use GET method to request and get the JSON object data from retrieve_location.php. 
    
```
    var server = "https://geogws003.ad.umd.edu:8443/cjycathy/geog657/final/"; 
    //When the page is loaded, make an AJAX request
     window.onload = function() { 
     
         var xhttp = new XMLHttpRequest(); 
     
         xhttp.addEventListener("load", function(event) { 
             var result = event.target.responseText; 
             var locations = JSON.parse(result); 
             initMap();
             Listbookstore(locations);
         });
     
         xhttp.addEventListener("error", function(event) { 
             document.getElementById("listContainer").innerHTML = "Error! Something Went Wrong!";
         });
     
         xhttp.open("GET", server+"retrieve_location.php"); 
         xhttp.send(); 
     }
```
 
Then I created a function using for loop to list the bookstore record on the leaflet map. 
   

     //A function to retrieve the bookstore records from the server with a JSON object
     function Listbookstore(data) { 
         console.log(data);
         for (var i = 0; i < data.length; i++) { 
     
             var lat = data[i].latitude;
             var lng = data[i].longitude;
             
             var name = data[i].bookstore_name;
             var address = data[i].address;
             var link = data[i].official_link;
             var list = 
                "<ul><li><a href = '" + link + "'> "+name+"</a></li>"
                + "<li>" + address + "</li>"
             var latlng = {
                 lat: parseFloat(lat), 
                 lng: parseFloat(lng)
             };
     
             var marker = new L.Marker(latlng).addTo(map);
             marker.bindPopup(list)
     	}
     }


	Activity Retrieve
In the listcollision.js, I used the same function to get the activity data from retrieve_activity.php then use the forEach() method for the JSON object to list the data on the activities.html.

```
data.forEach(function(row,index) {
            //If it is the first row, add column in a table header
            if(index==0){
                text_html+="<tr>";
                for(column in row){
                    text_html = text_html+"<th>"+ column+"</th>";
                }
                text_html+="</tr>";
            }
            text_html+="<tr>";
            for(column in row){
                //Iterate properties of JSON object row

                if(column ==="Link"){
                    text_html = text_html+"<td><a href='"+row[column]+"'> Introduction</a></td>";
                }
                else{
                    text_html = text_html+"<td>"+ row[column]+"</td>";
                }
            };
            text_html+="</tr>";

        });
        text_html+="</table>";
```

I used the same algorithms for the Bookstore Retrieve. 


	Bookstore Record
In the db.php I use the mysqli_connect() function to make a connection with the MySQL server.

`$con= mysqli_connect($hostname, $username, $pwd, $dbname);`

Then I used the mysqli_query() function in the bookstorerecord.php to insert the data input by the users into the bookstore table. 

```
//Insert the record to the database table          
        $sql = "insert bookstore(bookstore_name, address, opening_hour, phone_number, latitude, longitude, img_url, official_link) values ('$storename','$address','$openhour','$phone','$lat', '$lng',  '$link','$imgURL')";

        //mysql_query("set names 'utf8'")
        $result = mysqli_query($con, $sql);
```

I used the same algorithms for the Activity Record. 


###	Data Description

The data that I need to use are listed in the ahead bookstore_records and activity_record tables and they are collected in two ways. On one hand, before publishing my web application, I acquired the bookstore and activities information from the official website and imported the csv file in my database to create a new table. On the other hand, after I release the website, the users can use the contact page to add and update the bookstores and activities information. 

###	Implementation Results 
1 The main functionalities of different web page are shown as follows:
The Index page gives a brief introduction to the web application and shows navigators of links to different pages decorated with attractive bookstore pictures.
 
 

2 The map page shows the locations of independent bookstores. The users can find the nearby bookstores that retrieved from the bookstore table by bookstore_retrieve php file. By clicking on the location marker, the user can know about the bookstore name with a link to its official website and its address. 
 
 
 

3 The activity page shows various reading activities of bookstores such as lectures, sharing sessions and exhibitions with information of locations, time, bookstore and links to the official introduction website. The information is retrieved from the activity_records table by activity_retrieve php file.
 

4 The Record Pages are used to enlarge the database by the public. The users can add or update the bookstore locations or activities in these pages. Then the bookstore_record and activity_record php files store the information into the bookstore and the activity table. Besides, in the bookstore recording page the users can conveniently record their current location when they are at the bookstore

 

 
 
 
 


###	Conclusion
1 Summary and contribution
This web application is my first try of developing a reading map for bookstore lovers like me who will find desirable bookstores and acquire activities information with it. Its functionalities are those that I want as a user. All in all, I am excited to develop my first web application and improve my skill through this practical project.

2 Limitations and further improvement
For time limited, there still some functions that I thought to be useful but cannot be achieved in this project.
It would be more interactive for the users to add a discussion forum. In the forum, users can communicate with each other concerning thoughts of the bookstores, activities and books. 
It would be more useful to add the activity sign up function for the readers who want to take part in the activity and for the storekeepers to better organize their activities. 
