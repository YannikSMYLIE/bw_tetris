// Tastatureingaben
$(document).keydown(function(event) {
    // Tastatureingaben nur verarbeiten während Spiel läuft
    if(mode == "down" && timeout) {
        switch(event.which) {
            case 37 : // Left
                left();
                break;
            case 39 : // Right
                right();
                break;
            case 40 : // Down
                if(typeof noDown !== "undefined") {
                    return false;
                }
                clearTimeout(timeout);
                if(!down()) {
                    mode = "newElement";
                }
                loop();
                break;
            case 32: // Leertaste
            case 38: // Up
                rotate();
                break;
            case 80: // P
                pause();
                break;
        }
    } else if(event.which == 80) { // Pausierung aufheben
        pause();
    }
});

// Spiel pausieren
$('#pause').click(function() {
    pause();
    return false;
});
function pause() {
    if(timeout != null) {
        clearTimeout(timeout);
        timeout = null;
        music.pause();
        $('#pause').addClass("btn-primary").removeClass("btn-secondary");
        $('body').css("overflow", "auto");
    } else {
        loop();
        music.play();
        $('#pause').removeClass("btn-primary").addClass("btn-secondary");
        $('body').css("overflow", "hidden");
    }
    return false;
}

// Bildschirmgroesse
$(window).ready(function() {
    resizePlayground();
});
$(window).resize(function() {
    resizePlayground();
});
function resizePlayground() {
    const windowHeight = $(window).height();
    // Header berechnen
    const header = $('#header');
    const headerHeight = Number(header.height());
    // Weitere Abstaende miteinbeziehen
    const main = $('#main');
    const mainMarginTop = Number(main.css("margin-top").replace("px", ""));
    const mainMarginBottom = Number(main.css("margin-bottom").replace("px", ""));
    // Maximale Höhe des Playgrounds (minus Puffer)
    const maxMainHeight = windowHeight - headerHeight - mainMarginBottom - mainMarginTop - 10;

    // Anzahl an Reihen berechnen
    const numOfRows = $('#playground').find('tr').length;

    // Maximale Höhe pro Reihe
    const maxRowHeight = Math.floor(maxMainHeight / numOfRows);

    // Anwenden
    $('#playground td').each(function() {
        $(this).css("height", maxRowHeight + "px");
        $(this).css("width", maxRowHeight + "px");
    });
}