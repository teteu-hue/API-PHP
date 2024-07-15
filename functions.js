/*$(document).ready(function(){

    let hideButton = $(".titleBox");
    let showButton = $(".titleeBox");
    let toggleButton = $(".title");
    let p = $("p");
    let input = $("input");

    hideButton.click(() => {
        p.hide(1000);
        setTimeout(() => {
            p.css('color', 'white')
        },1000);
    });
    
    showButton.click(() => {
        p.show(1000);
    });
    
    toggleButton.click(() => {
        p.toggle(1000, () => {
            p.css('color', 'white')
        });
    });

    p.hover(() => {
        p.css('color', 'green');
    },
    () => {
        p.css('color', 'red');
    });

    input.on({
        focus: () => {
            input.css("background-color", "#cccccc");
        },
        blur: () => {
            input.css("background-color", "#ffffff");
        }
    });


});
*/

$(document).ready(function(){
    let isVisible = $(".panel").is(":visible");
    let isHidden = $(".panel").is(":hidden");

    $("#flip").ready(function(){

        $("#flip").click(() => {
            $(".panel").slideToggle('slow');
            
        $(".panel").hover(function(){
            $(this).css('background-color', "#fff");
        },
        function(){
            $(this).css('background-color', "transparent");
            $(this).html('HOVER!');
        });     
    });
});

});