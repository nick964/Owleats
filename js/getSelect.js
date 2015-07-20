function getSelect(txtServicePath, tagName){

	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            	var response = xmlhttp.responseText;
            	var aryresponse = JSON.parse(response);
            	for (var i=0; i < aryresponse.length; i++)
            		{
            		var opt = document.createElement("option");
            		opt.text = aryresponse[i];
            		document.getElementById(tagName).add(opt); 
            		}
            }
        }
        xmlhttp.open("GET", txtServicePath, true);
        xmlhttp.send();
	}
