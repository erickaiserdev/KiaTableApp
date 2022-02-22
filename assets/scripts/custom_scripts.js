/*
Insert Custom JS Below
*/


//Constant Variables
const startWidth  = 3840;
// const startLeft   = 2587;
// const leftPercent = startLeft/startWidth;

const startHeight = 2160;
// const startTop    = 474;
// const topPercent  = startTop/startHeight;

// const imagePercent    = 0.05;
// const imageDimensions = startWidth*imagePercent;

var idleTime = 0;
(function($){
    $(document).ready(function () { 

        homeScreenOpen();
        
        // Increment the idle time counter every minute.
        var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

        // Zero the idle timer on mouse movement.
        $(this).mousemove(function (e) {
            idleTime = 0;
        });
        $(this).keypress(function (e) {
            idleTime = 0;
        });
        

        $(".marker-container").each(function(){            
            var x = $(this).children('.x-val').text();
            var y = $(this).children('.y-val').text();
            // console.log(x + ", " + y);            
            adjustMarkers(parseFloat(x), parseFloat(y), $(this));
        });                
        
        $(window).resize(function() {
            // This will execute whenever the window is resized
            $(".marker-container").each(function(){ 
                var x = $(this).children('.x-val').text();
                var y = $(this).children('.y-val').text();
                // console.log(x + ", " + y);                                 
                adjustMarkers(parseFloat(x), parseFloat(y), $(this));
            });
        });
    
    });
})(jQuery);


function homeScreenClose(){
    var homeVideo = document.getElementById('home-screen-video');
    var map = document.getElementById('main-map');
    homeVideo.style.opacity = '0';
    map.style.opacity = '1';
    window.setTimeout((function () {
        homeVideo.style.zIndex  = '0';
        homeVideo.pause();
        homeVideo.currentTime = 0;
    }), 500);   
}

function homeScreenOpen(){
    var homeVideo = document.getElementById('home-screen-video');
    homeVideo.play();
    homeVideo.style.zIndex  = '10';
    homeVideo.style.opacity = '1';
}


function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 2) { // 20 minutes
        window.location.reload();
    }
}



function adjustMarkers(startLeft, startTop, elem){
    var leftPercent = startLeft/startWidth;
    var topPercent  = startTop/startHeight;

    var newWidth = jQuery(window).width(); 
    var newHeight= jQuery(window).height();

    // console.log("--New--");
    // console.log("Width:" + newWidth);
    // console.log("Height:" + newHeight);

    var newWidthPercent = newWidth/startWidth;
    var newHeightPercent = newHeight/startHeight;

    var widthOffset = newWidthPercent*leftPercent;
    var heightOffset = newHeightPercent*topPercent;

    var newLeft = startWidth*widthOffset;
    var newTop = startHeight*heightOffset;

    // var newImageSize = newWidth*imagePercent;

    // var imageOffset = Math.abs(imageDimensions-newImageSize);

    // var imageOffsetLeft = imageOffset/2;
    // var imageOffsetTop = imageOffset;

    // console.log("New Left:" + newLeft);
    // console.log("New Top:" + newTop);

    // newLeft = newLeft+imageOffsetLeft;
    // newTop = newTop+imageOffsetTop;

    elem.css({
        'left' : newLeft+"px",
        'top' : newTop+"px"
    });
}
  



function openModal(idNum) {
    document.getElementById("myModal-"+idNum).style.display = "block";
}

function closeModal(idNum) {
    document.getElementById("myModal-"+idNum).style.display = "none";
}



// Lightbox settings
function lightbox_open(idNum) {
var lightBoxVideo = document.getElementById("light-video-"+idNum);
window.scrollTo(0, 0);
document.getElementById('fade-'+idNum).style.display = 'flex';
document.getElementById('light-close-'+idNum).style.display = 'block';
lightBoxVideo.play();
}

function lightbox_close(idNum) {
var lightBoxVideo = document.getElementById("light-video-"+idNum);
document.getElementById('fade-'+idNum).style.display = 'none';
document.getElementById('light-close-'+idNum).style.display = 'none';
lightBoxVideo.pause();
lightBoxVideo.currentTime = 0;
}


