$('iframe').hide();//hide iframe from start 

$(document).ready(function(){
    $('form').submit(function(e){
        //form submitted
        e.preventDefault();// stop page reload
        let getURL = $('.url').val();//get the value of the url class(input url value)

        let newURL = getURL.replace("watch?v=","embed/");
        $('iframe').attr("src",newURL).show();
    });
});