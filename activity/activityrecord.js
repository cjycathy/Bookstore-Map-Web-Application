
document.getElementById("report").onsubmit=validateForm;


function validateForm(){
    var name = document.getElementById("name").value;
    var time = document.getElementById("time").value;
    var bookstore = document.getElementById("bookstore").value;
    var link = document.getElementById("link").value;
    var allGood = true;

    //event handler function registered for the submit event
    event.preventDefault();

    allGood = confirm("Please verify the data you entered:" + "\nActivity Name: "+ name+
    "\nActivity Time: "+time+"\nBookstore Name: "+bookstore+"\nActivity Link: "+link);

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
        xhttp.open("POST","https://geogws003.ad.umd.edu:8443/cjycathy/geog657/final/activity/activityrecord.php");
        xhttp.send(formData);

    }
        
}


