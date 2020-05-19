$('.nextgame').each(function() {
    updateTimeLeft($(this));
});

function updateTimeLeft(domElement) {
    const nextgame = Number(domElement.attr("data-at"));
    const currentTime = Math.floor(Date.now() / 1000);
    const difference = nextgame - currentTime;

    const percent = (1 - difference / 86400) * 100;
    const stunden = Math.floor(difference / (60 * 60));
    const minutes = Math.floor((difference - (stunden * 60 * 60)) / 60);
    const seconds = difference - minutes * 60 - stunden * 60 * 60;
    
    var timestring = "Noch ";
    if(stunden) {
        timestring += stunden.toString() + " Stunden";
        if(minutes) {
            timestring += ", " + minutes.toString() + " Minuten";
        }
        timestring += " und " + seconds.toString() + " Sekunden";
    } else {
        if(minutes) {
            timestring += minutes.toString() + " Minuten und ";
        }
        timestring += seconds.toString() + " Sekunden";
    }
    domElement.find('.timeleft').html(timestring);
    domElement.find('.bg-success').css("width", percent + "%");

    if(difference <= 0) {
        setTimeout(function() {
            location.reload();
        }, 3000);
    } else {
        setTimeout(function() {
            updateTimeLeft(domElement);
        }, 1000);
    }
}