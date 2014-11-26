//Because I press enter by habit
$("#astcmd").keyup(function(event){
    if(event.keyCode == 13){
        $("#send").click();
    }
});

$('#send').click(function(){
	var dat = $('#astcmd').val(); 
	$.get("/admin/ajax.php?module=asteriskdashcli&command=clicmd&data=" + dat,function(data,status){
		if(data.status == true){
			var reply = JSON.parse(data.message);
			$('div.output').html("<pre>"+ reply +"</pre>");
		}else{
			$('div.output').html("<b>Error</b>");
		}
	});
});
