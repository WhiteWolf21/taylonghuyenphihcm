$(window).on("load", function() {
    // page is fully loaded, including all frames, objects and images
    $('.popup-close').click(function(){
        $('#style_popup').remove();
        $('.popup-close').parent().removeAttr("style");
    });
});

function outsideForm(ele){
    if ($('#outside-p-0').val() === $('#outside-p-1').val()){
        ele.css("background-color", "gray");
        ele.css("pointer-events", "none");
        setTimeout(function(){
            ele.css("background-color", "initial");
            ele.css("pointer-events", "initial");
        }, 3000);
        $('#submit-outside').click();
    }
    else
        alert("Vui lòng nhập lại số điện thoại giống nhau !!!");
}

function insideForm(ele){
    if ($('#inside-p-0').val() === $('#inside-p-1').val()){
        ele.css("background-color", "gray");
        ele.css("pointer-events", "none");
        setTimeout(function(){
            ele.css("background-color", "initial");
            ele.css("pointer-events", "initial");
        }, 3000);
        $('#submit-inside').click();
    }
    else
        alert("Vui lòng nhập lại số điện thoại giống nhau !!!");
}