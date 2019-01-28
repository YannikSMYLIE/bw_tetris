let timeout = null;
let mode = "newElement";
let movingElement = 0;

let level = 1;
let clearedRows = 0;
let points = 0;

let music = 0;

function speed() {
    if(typeof customSpeed !== "undefined") {
        return customSpeed();
    }
    const speed = Math.pow((0.8 - ((level - 1) * 0.007)), level - 1) * 1000;
    return speed;
}


$('#start').click(function() {
    if($('#form input.name').val()) {
        // Musik festlegen
        const musicId = index = rand(0, 40);
        if(musicId >= 0 && musicId < 20) {
            music = $('#musicA')[0];
        } else if(musicId >= 25 && musicId < 40) {
            music = $('#musicB')[0];
        } else {
            music = $('#musicC')[0];
        }
        music.play();

        // Level auslesen
        level = $('#startLevel').val();
        $('#level').html(level);
        $('#level').parent().removeClass("d-none");
        $('#startLevel').hide();

        // Scrollleiste sperren
        $('body').css("overflow", "hidden");

        $('#form input.name').prop("readonly", true);
        $('#start').hide();
        $('#pause').show();
        loop();
    }
    return false;
});
function loop() {
    // Prüfen ob eine Reihe fertig ist
    const finishedRows = checkRow();
    if(finishedRows) {
        // Spiel fortsetzen
        timeout = setTimeout(loop, 1100);
        return false;
    }

    // Prüfen ob das Spiel vorbei ist
    for(let i = 0; i < 10; i++) {
        const tile = $('#playground td[data-x="' + i + '"][data-y="0"]');
        if(tile.hasClass("occupied")) {
            mode = "gameover";
        }
    }

    switch(mode) {
        case "newElement":
            newElement();
            mode = "down";
            loop();
            break;
        case "down":
            timeout = setTimeout(function() {
                if(!down()) {
                    mode = "newElement";
                }
                loop();
            }, speed());
            break;
        case "gameover":
            gameover();
            break;
    }
}

let nextElement = rand(0, (Object.keys(elements).length) - 1);
function newElement(index) {
    if(typeof beforeNewElement !== "undefined") {
        beforeNewElement();
    }

    if(typeof index !== "undefined") {
        nextElement = index
    }

    elements[nextElement]["chords"].forEach(function(coordinates) {
        const tile = $('#playground td[data-x="' + coordinates.x + '"][data-y="' + coordinates.y + '"]');
        tile.addClass("moving").attr("data-rx", coordinates.rotateX).attr("data-ry", coordinates.rotateY).attr("data-type", elements[nextElement].name);
    });

    // Debug
    let input = null;
    switch(nextElement) {
        case 0: input = $('#form input.stoneI'); break;
        case 1: input = $('#form input.stoneL'); break;
        case 2: input = $('#form input.stoneJ'); break;
        case 3: input = $('#form input.stoneO'); break;
        case 4: input = $('#form input.stoneZ'); break;
        case 5: input = $('#form input.stoneS'); break;
        case 6: input = $('#form input.stoneT'); break;
    }
    const val = Number(input.val());
    input.val(val + 1);

    nextElement = rand(0, (Object.keys(elements).length) - 1);
    $('#next').attr("class", elements[nextElement]["name"]);
}






// Bewegen
function down() {
    return move(0, 1, true);
}
function right() {
    const input = $('#form input.keyRight');
    const val = Number(input.val());
    input.val(val + 1);

    return move(1, 0, false);
}
function left() {
    const input = $('#form input.keyLeft');
    const val = Number(input.val());
    input.val(val + 1);

    return move(-1, 0, false);
}
function move(byX, byY, occupy) {
    const movingTiles = $('#playground').find('.moving');

    // Prüfen ob man schon am rechten Rand ist
    let move = true;
    movingTiles.each(function() {
        const x = Number($(this).data("x"));
        const y = Number($(this).data("y"));
        const targetTile = $('#playground td[data-x="' + (x + byX) + '"][data-y="' + (y + byY) + '"]');
        if(!targetTile.length || targetTile.hasClass("occupied")) {
            move = false;
            return false;
        }
    });
    if(!move) {
        if(occupy) {
            movingTiles.each(function() {
                $(this).removeClass("moving").addClass("occupied");
            });
        }
        return false;
    }

    // Verschieben
    movingTiles.each(function() {
        const x = Number($(this).data("x"));
        const y = Number($(this).data("y"));
        const targetTile = $('#playground td[data-x="' + (x + byX) + '"][data-y="' + (y + byY) + '"]');

        // Daten uebertragen
        targetTile.addClass("movingNext");
        targetTile.attr("data-rx-next", $(this).attr("data-rx"));
        targetTile.attr("data-ry-next", $(this).attr("data-ry"));
        targetTile.attr("data-type", $(this).attr("data-type"));

        $(this).removeClass("moving");
    });

    // Dann am Ende alle auf fertig setzen
    $('#playground').find('.movingNext').each(function() {
        $(this).addClass("moving").attr("data-rx", $(this).attr("data-rx-next")).attr("data-ry", $(this).attr("data-ry-next"));
        $(this).removeClass("movingNext").removeAttr("data-rx-next").removeAttr("data-ry-next");
    });
    return true;
}

// Rotieren
function rotate() {
    const input = $('#form input.rotate');
    const val = Number(input.val());
    input.val(val + 1);

    const movingTiles = $('#playground').find('.moving');

    // Prüfen ob man rotieren kann
    let move = true;
    movingTiles.each(function() {
        const x = Number($(this).data("x"));
        const y = Number($(this).data("y"));
        const rX = Number($(this).attr("data-rx"));
        const rY = Number($(this).attr("data-ry"));
        const targetTile = $('#playground td[data-x="' + (x + rX) + '"][data-y="' + (y + rY) + '"]');
        if(!targetTile.length || targetTile.hasClass("occupied")) {
            move = false;
            return false;
        }
    });
    if(!move) {
        return false;
    }

    // Verschieben
    movingTiles.each(function() {
        const x = Number($(this).data("x"));
        const y = Number($(this).data("y"));
        const rX = Number($(this).attr("data-rx"));
        const rY = Number($(this).attr("data-ry"));
        const targetTile = $('#playground td[data-x="' + (x + rX) + '"][data-y="' + (y + rY) + '"]'); // hier je nach Rotatemode etwas anderes
        const newRotate = {rx : -rY, ry : rX}

        // Daten uebertragen
        targetTile.addClass("movingNext");
        targetTile.attr("data-rx-next", newRotate.rx);
        targetTile.attr("data-ry-next", newRotate.ry);
        targetTile.attr("data-type", $(this).attr("data-type"));

        $(this).removeClass("moving");
    });

    // Dann am Ende alle auf fertig setzen
    $('#playground').find('.movingNext').each(function() {
        $(this).addClass("moving").attr("data-rx", $(this).attr("data-rx-next")).attr("data-ry", $(this).attr("data-ry-next"));
        $(this).removeClass("movingNext").removeAttr("data-rx-next").removeAttr("data-ry-next");
    });
    return true;
}

// Reihe fertig
function checkRow() {
    let finishedRows = 0;
    $('#playground').find('.field').each(function() {
        let rowFinished = true;
        $(this).find('td:not(.border)').each(function() {
            if(!$(this).hasClass("occupied")) {
                rowFinished = false;
                return false;
            }
        });
        if(rowFinished) {
            finishedRows++;
            finishRow();
            $(this).addClass("finished");
        }
    });

    if(finishedRows) {
        music.volume = 0.5
        $('#soundClear')[0].play();
        $('#playground').delay(1000).queue(function() {
            $(this).find('.finished').each(function() {
                $(this).removeClass("finished");
                $(this).find('td:not(.border)').each(function() {
                    $(this).removeClass("occupied");
                });
            });
            music.volume = 1
            bringDownTiles();
            $(this).dequeue();
        });
    }

    return finishedRows;
}
function finishRow() {
    clearedRows++;

    // Punkte vergeben
    points += level*10;

    // Levle up?
    if(clearedRows == 10) {
        level++;
        clearedRows = 0;
    }

    // GUI anpassen
    $('#score').html(points);
    $('#level').html(level);
    $('#cleared').html(clearedRows);
}

// Gameover
function gameover() {
    $('#playground').addClass("gameover");
    $('#gameover').addClass("d-flex");
    $('#pause').fadeOut();
    $('#form input.points').val(points);
    // ToDo: Entfernen
    $('#form').fadeIn();
    if(typeof afterGameOver !== "undefined") {
        afterGameOver();
    }

    setTimeout(function() {
        $('#form form').trigger("submit");
    }, 3000);
}

// Wenn Reihe voll alle anderen nach unten verschieben
function bringDownTiles() {
    let found = false;
    for(let y = $('#playground').find('.field').length - 1; y > 0; y--) {
        const curLine = $('#playground').find('.field[data-y=' + y + ']');
        const prevLine = $('#playground').find('.field[data-y=' + (y-1) + ']');

        // Es ist nicht möglich dass es eine leere Zeile gibt welche drüber eine volle hat.
        if(prevLine.length == 0 || curLine.find('.occupied').length > 0 || prevLine.find('.occupied').length == 0) {
            continue;
        }

        // Alle darüber als moving markieren und nach unten verschieben
        prevLine.find('td:not(.border).occupied').each(function () {
            $(this).addClass("moving").removeClass("occupied");
        });
        while(down());
    }
}