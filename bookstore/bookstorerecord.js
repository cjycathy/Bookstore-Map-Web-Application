window.onload=function(){
    initMap();
};

    document.getElementById("report").onsubmit=validateForm;

function validateForm(){
    var storename = document.getElementById("storename").value;
    var address = document.getElementById("address").value;
    var openhour = document.getElementById("openhour").value;
    var phone = document.getElementById("phone").value;
    var lat = document.getElementById("lat").value;
    var lng = document.getElementById("lng").value;
    var link = document.getElementById("link").value;
    console.log(storename);
    var allGood = true;

    if (lat==""){
        allGood = window.confirm("You haven't enter latitude! Is it OK? \nClick Cancel if you want to enter latitude");
        if (allGood==false){
            document.getElementById("lat").focus();
            return false;
        }
    }

    if (lng==""){
        allGood =window.confirm("You haven't enter longitude! Is it OK? \n Click Cancel if you want to enter longitude");
        if (allGood==false){
            document.getElementById("lng").focus();
            return false;
        }
    }

    //event handler function registered for the submit event
    event.preventDefault();

    allGood = confirm("Please verify the data you entered:" + "\nBookstore Name: "+ storename+
    "\nBookstore Address:"+address+"\nLatitude: "+lat+"\nLongitude:"+lng+"\nOpening Hour: "+openhour+"\nPhone Number: "+phone+
    "\nOfficial Link: "+link);

    if (allGood){
        var xhttp = new XMLHttpRequest();
        //Bind the FormData object and the form element
        var formData = new FormData(document.getElementById("report"));
        console.log(formData);
        //Get and update the respond text
        xhttp.addEventListener("load",function(event){
            console.log(event);
            document.getElementById("result").innerHTML=event.target.responseText;
    
        });
        //Get and update the error respond
        xhttp.addEventListener("error",function(event){
            document.getElementById("result").innerHTML=event.target.responseText;
        });
        //Set and send the request
        xhttp.open("POST","https://geogws003.ad.umd.edu:8443/cjycathy/geog657/final/bookstore/bookstorerecord.php");
        xhttp.send(formData);

    }
        
}

var map;

     function initMap(){
         var defaultLocation = L.latLng(23.129046,113.327877);
         var baseLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
             attribution:'&copy;<a href="https://www.openstreetmap.org/copyright">OpenstreetMap</a> contributors'
         })
         var mapOption ={
             zoom:16,
             center:defaultLocation,
             layers:[baseLayer],
         };

         // create a map object by L.map()
         map = L.map("mapCanvas",mapOption);

         if (navigator.geolocation){
             //Use the Geolocation API to get current location and track it as the user move
             navigator.geolocation.getCurrentPosition(showPosition, locationError);
         }
         else{
             alert("Geolocation not supported on this device");
             return;
         }
     }
     
     function showPosition(pos){
         var lat = pos.coords.latitude;
         var lng = pos.coords.longitude;
         var currentLocation = L.latLng(lat, lng);
         
         //Set the values of the latitude and longitude input fields
         sLat = lat.toFixed(4);
         sLng = lng.toFixed(4);
         document.getElementById("lat").value=sLat;
         document.getElementById("lng").value=sLng;

         //Pans the map to a given center
         map.panTo(currentLocation);
     
         // Create a marker at the user's location
         var marker = L.marker(currentLocation);
         marker.addTo(map);
         marker.bindPopup('Current Location');
     }

     //pop up an alert dialog with a message for each error code
     function locationError(error){
         switch (error.code){
             case error.PERMISSION_DENIED:
                 alert("Geolocation access denied");
                 break;

             case error.POSITION_UNAVAILABLE:
                 alert("Geolocation is not available");
                 break;

             case error.TIMEOUT:
                 alert("Timeout to get Geolocation");
                 break;

             default:
                 alert("Unknown error in Geolocation");
                 break;
         }

     }

