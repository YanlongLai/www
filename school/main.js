function render(){
	load();
}

function load(){
	$.getJSON("list.json", function(json) {
		var className = "";
    	$.each(json, function(idx, obj) {
			className += "<option>"+ obj.class + "</option>";
			
		});
		$(".form-control").html(className);

	});

}