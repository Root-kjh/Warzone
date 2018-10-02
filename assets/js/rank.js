function post_to_url(params) {
    method = "post";
    path="https://warzone.kro.kr/profile";
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
 
    for(var key in params) {
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", key);
        hiddenField.setAttribute("value", params[key]);
 
        form.appendChild(hiddenField);
    }
 
    document.body.appendChild(form);
    form.submit();
}

$(document).ready(function(){
	$(".table").on('click','tr',function(e){
		e.preventDefault();
		var id=$(this).attr('value');
		post_to_url({'id':id});
	});
});
