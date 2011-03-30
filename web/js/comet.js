function waitForMsg(){
    $.ajax({
        type: "GET",
        url: config.sync.url + "?timestamp="+ config.sync.timestamp,
        async: true,
        cache: false,
        
        success: function(data){
            var data = eval('(' + data +')');
            
            config.sync.timestamp = data['timestamp'];
            setTimeout('waitForMsg()', 1000);
        },
        
        error: function(XMLHttpRequest, textStatus, errorThrown){
            alert('Error: ' + textStatus + " (" + errorThrown + ")");
            setTimeout("waitForMsg()", 10000);
        }
    });
}

$(function(){
   waitForMsg(); 
});