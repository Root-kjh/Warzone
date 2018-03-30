var link=document.location.href;
link=link.toLowerCase();
var argv=link.split('/');

if(argv[3].length>1)
document.getElementById(argv[3]).className = "active";
else
document.getElementById("home").className = "active";