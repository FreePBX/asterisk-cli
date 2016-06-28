//Because I press enter by habit
$("#astcmd").keyup(function(event){
    if(event.keyCode == 13){
        $("#send").click();
    }
});

$('#send').click(function(){
	var dat = $('#astcmd').val();
  $('div.output').html("<pre>"+ _("Loading...") +"</pre>");
	$.get("ajax.php?module=asterisk-cli&command=clicmd&data=" + dat,function(data,status){
		if(data.status) {
			var reply = JSON.parse(data.message);
			$('div.output').html("<pre>"+ reply +"</pre>");
		}else{
			$('div.output').html("<b>Error</b>");
		}
	});
});
