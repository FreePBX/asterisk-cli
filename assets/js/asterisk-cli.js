//Because I press enter by habit
$("#astcmd").keyup(function(event)
{
    if(event.keyCode == 13)
    {
        $("#send").click();
    }
});

$('#send').click(function()
{
    var box_output = $('div.output');
    var post_data  = {
        module	: 'asterisk-cli',
        command	: 'clicmd',
        data	: $('#astcmd').val(),
    };

    box_output.html("<pre>"+ _("Loading...") +"</pre>");
    $.post(window.FreePBX.ajaxurl, post_data, function(data)
    {
        var msg = "";
		if(data.status)
        {
            msg = "<pre>"+ JSON.parse(data.message) +"</pre>";
		}
        else
        {
            msg = "<b>Error</b>";
		}
        box_output.html(msg);
	});
});

$(document).ready(function()
{
    var obj_astcmd = $('#astcmd');
    var obj_send   = $("#send");
    var box_output = $('div.output');
    var post_data  = {
        module	: 'asterisk-cli',
        command	: 'getCliCommands',
    };

    box_output.html("<pre>"+ _("Loading...") +"</pre>");
    $.post(window.FreePBX.ajaxurl, post_data, function(data)
    {
        var msg = "";
		if (data.status)
        {
            obj_astcmd.typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            },
            {
                name: 'cliCommands',
                display: 'cmd',
                source: substringMatcherCmd(data.cliCommands),
                templates: {
                    suggestion: function(data) {
                        return '<p><strong>' + data.cmd + '</strong><br>' +
                        '<i class="fa fa-arrow-right" aria-hidden="true"></i> ' + data.info + '</p>';
                    }
                }
            });

            msg = "<pre>"+ _("All Ready") + "</pre>";
		}
        else
        {
            msg = "<pre>"+ _("Error getting list of commands!!") + "</pre>";
            obj_astcmd.prop( "disabled", true );
            obj_send.prop( "disabled", true );
		}
        box_output.html(msg);
	});
});

//https://twitter.github.io/typeahead.js/examples/
var substringMatcher = function(strs) 
{
    return function findMatches(q, cb) {
        var matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
                matches.push({ value:str });
            }
        });
        cb(matches);
    };
};

var substringMatcherCmd = function(strs)
{
    return function findMatches(q, cb) {
        var matches, substringRegex;
  
        // an array that will be populated with substring matches
        matches = [];
  
        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');
  
        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
            if (substrRegex.test(str.cmd)) {
                matches.push(str);
            }
        });
  
        cb(matches);
    };
};