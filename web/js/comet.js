(function waitForMsg(){
    $.ajax({
        type: "GET",
        dataType: 'json',
        url: config.sync.url + "?timestamp="+ config.sync.timestamp,
        async: true,
        cache: false,
        
        success: function(data){

            if(data.news){
                for(quote in data.news){
                    var template = $('<li style="display:none">' + data.news[quote] +'<li>');
                    $("#wall ul").prepend(template);
                    template.slideDown();
                }
            }
            
            if(data.updates){
                for(i in data.updates){
                    $(".item_wall_"+data.updates[i].id+" .num").html(data.updates[i].votes_count)
                }
            }
            config.sync.timestamp = data['timestamp'];
            waitForMsg();
        },
        
        error: function(XMLHttpRequest, textStatus, errorThrown){
            console.log('error' + errorThrown);
        },
        
        complete: function(xhr, status) {
        }
    });
})();