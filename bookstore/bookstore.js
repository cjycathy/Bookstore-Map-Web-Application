var server = "https://geogws003.ad.umd.edu:8443/cjycathy/geog657/final/bookstore/";
//When the page is loaded, make an AJAX request
window.onload = function(){
    var xhttp = new XMLHttpRequest();

    console.log(xhttp);
    xhttp.addEventListener("load",function(event){
        console.log(event);
        var response =event.target.responseText;
        var collision = JSON.parse(response);
        processCollisionList(collision);
    });
    
    xhttp.addEventListener("error",function(event){
        document.getElementById("listContainer").innerHTML = "Error! Something went wrong!";

    });
    xhttp.open("GET",server+"retrieve_bookstore.php");
    xhttp.send();   
    
//A function to retrieve the collision records from the server with a JSON object
function processCollisionList(data){
    console.log(data);
    
    var text_html = "";
    //If the length of the array is equal to 0, display a message "No"
    if(data.length==0){
        text_html="<h4>No Activities Records</h4>"
    }

    else{
        text_html="<table>";

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
                if(column ==="img_url"){
                    text_html = text_html+"<td><img alt = 'img' width='50px' height='50px' src='"+server+row[column]+"'></td>";
                }
                else{
                    text_html = text_html+"<td>"+ row[column]+"</td>";
                }
            };
            text_html+="</tr>";

        });
        text_html+="</table>";
    }
    document.getElementById("listContainer").innerHTML=text_html;
}
}

