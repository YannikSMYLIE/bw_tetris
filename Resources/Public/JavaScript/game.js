let timeout = null;
let mode = "newElement";
let movingElement = 0;
let nextElement = rand(0, elements.length - 1);

let level = 0;
let clearedRows = 0;
let points = 0;
let rowsToClear = 0;
let field = createField(10, 20);
let controls = {
    left : Number($('.tx-bw-tetris .controls span[data-action="left"]').attr("data-key")),
    right : Number($('.tx-bw-tetris .controls span[data-action="right"]').attr("data-key")),
    down : Number($('.tx-bw-tetris .controls span[data-action="down"]').attr("data-key")),
    drop : Number($('.tx-bw-tetris .controls span[data-action="drop"]').attr("data-key")),
    rotate : Number($('.tx-bw-tetris .controls span[data-action="rotate"]').attr("data-key")),
    pause : 80,
};
console.log(controls);
console.log(field);

let music = 0;

function speed() {
    if(typeof customSpeed !== "undefined") {
        return customSpeed();
    }
    const speed = Math.pow((0.8 - ((level - 1) * 0.007)), level - 1) * 1000;
    return speed;
}


$('#start').click(function() {
    // Musik festlegen
    music = getMusic($('#music'));
    music.play();

    // Level auslesen
    level = Number($('#startLevel').val());
    $('#level').html(level);

    // Zu clearende Reihen angeben
    rowsToClear = level * 10 + 10;
    $('#toClear').html(rowsToClear);

    // Scrollleiste sperren
    $('body').css("overflow", "hidden");

    $('#form input.name').prop("readonly", true);
    $('#start').hide();
    $('#pause').show();

    $('#startLevel').fadeOut().queue(function() {
        $('#levelContainer').removeClass("d-none").hide().fadeIn().queue(function() {
            loop();
            $(this).dequeue();
        });
        $(this).dequeue();
    });
    return false;
});


/**
 * Prüft welche Reihen fertig sind.
 * @returns {boolean}
 */
function checkRows() {
    // Fertige Reihen ermitteln
    const clearedRows = [];
    for(let y = 0; y < field.length; y++) {
        let toClear = true;
        for(let x = 0; x < field[y].length && toClear; x++) {
            if(field[y][x].state != "occupied") {
                toClear = false;
            }
        }
        if(toClear) {
            clearedRows.push({
                row: field[y],
                y : y
            });
        }
    }
    return clearedRows;
}

/**
 * Startet die Animation für die abgeschlossenen Reihen.
 * @param rows
 */
function finishRows(rows) {
    // Animation starten
    rows.forEach(function(rowData) {
        const row = $('#playground tr').eq(rowData.y);
        row.addClass("finished");
    });

    // Animation beenden
    $('#playground').delay(1000).queue(function() {
        rows.forEach(function(rowData) {
            const row = $('#playground tr').eq(rowData.y);
            row.removeClass("finished");
            bringDownTiles(rowData.y);
        });
        $(this).dequeue();
    });

    // Spiel fortsetzen
    redrawPlayground();
    timeout = setTimeout(loop, 1100);
}

/**
 * Verschiebt alle Felder über einer Reihe nach unten.
 * @param y
 */
function bringDownTiles(y) {
    // Reihe löschen
    for(let x = 0; x < field[y].length; x++) {
        field[y][x] = {
            state : 'free'
        };
    }
    // Nach unten bringen
    for(let newY = Number(y) - 1; newY >= 0; newY--) {
        const field2 = field;
        for(let x = 0; x < field[newY].length; x++) {
            if(field[newY][x].state == "occupied") {
                field[newY + 1][x].new = JSON.parse(JSON.stringify(field[newY][x]));
                field[newY][x].moved = true;
            }
        }
    }
    acceptChanges();
}

/**
 * Erhöht die Punkte und das Level anhand der erledigten Reihen.
 * @param rows
 */
function addPoints(rows) {
    // Punkte vergeben
    let pointsToAdd = 0;
    switch(rows.length) {
        case 1:
            pointsToAdd = 40*(level+1);
            break;
        case 2:
            pointsToAdd = 100*(level+1);
            break;
        case 3:
            pointsToAdd = 300*(level+1);
            break;
        case 4:
            pointsToAdd = 1200*(level+1);
            break;
    }
    points += pointsToAdd;

    // Punkte eiblenden
    $('#showPoints .text').html(pointsToAdd);
    $('#showPoints').addClass("visible").delay(1000).queue(function() {
        $(this).removeClass("visible");
        $(this).dequeue();
    });

    // Levle up?
    clearedRows += rows.length;
    if(clearedRows >= rowsToClear) {
        level++;
        clearedRows = clearedRows % 10;
        rowsToClear = 10;
    }

    // GUI anpassen
    $('#score').html(points.toLocaleString('de-DE'));
    $('#form input.points').val(points);
    $('#level').html(level);
    $('#cleared').html(clearedRows);
    $('#toClear').html(rowsToClear);
    saveScore();
}

/**
 * Prüft, ob das Spiel zu Ende ist.
 * @returns {boolean}
 */
function isGameover() {
    for(let x = 0; x < field[0].length; x++) {
        if(field[0][x].state == "occupied") {
            return true;
        }
    }
    return false;
}

/**
 * Zeigt den Gameover Bildschirm an.
 */
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

/**
 * Fügt dem Spielfeld ein neues Element hinzu.
 * @param index
 */
function newElement(index) {
    if(typeof beforeNewElement !== "undefined") {
        beforeNewElement();
    }

    let nextElementId;
    if(typeof index !== "undefined") {
        nextElementId = index
    } else {
        nextElementId = rand(0, elements.length - 1);
    }

    const nextElement = elements[nextElementId];
    nextElement["chords"].forEach(function(coordinates) {
        field[coordinates.y][coordinates.x] = {
            state : "moving",
            rotate : {
                x : coordinates.rotateX,
                y: coordinates.rotateY
            },
            type : nextElement
        }
    });
}

/**
 * Zeichnet des Spielfeld.
 */
function redrawPlayground() {
    for(let y = 0; y < field.length; y++) {
        for(let x = 0; x < field[y].length; x++) {
            const cellData = field[y][x];
            const cell = $('#playground tr').eq(y).find('td').eq(x);
            if(cell.type == "free") {
                cell.attr("class", "");
                cell.attr("data-type", "");
            } else {
                cell.attr("class", cellData.state);
                if(cellData.state != "free") {
                    cell.attr("data-type", cellData.type.name);
                }
            }
        }
    }
}

/**
 * Bewegt alle beweglichen Steine um ein Feld nach unten.
 * @returns {boolean}
 */
function down() {
    const moved = move(0, 1);
    if(!moved) {
        setOccupied();
        mode = "newElement";
    }
    redrawPlayground();
    return moved;
}

/**
 * Bewegt alle beweglichen Steine so weit nach unten wie möglich.
 * @returns {boolean}
 */
function allDown() {
    clearTimeout(timeout);
    while(move(0, 1));
    mode = "newElement";
    setOccupied();
    redrawPlayground();
    loop();
    return false;
}

/**
 * Bewegt alle beweglichen Steine um ein Feld nach rechts.
 * @returns {boolean}
 */
function right() {
    const input = $('#form input.keyRight');
    const val = Number(input.val());
    input.val(val + 1);

    const moved = move(1, 0);
    redrawPlayground();
    return moved;
}

/**
 * Bewegt alle bewglichen Steine um ein Feld nach links.
 * @returns {boolean}
 */
function left() {
    const input = $('#form input.keyLeft');
    const val = Number(input.val());
    input.val(val + 1);

    const moved = move(-1, 0);
    redrawPlayground();
    return moved;
}

/**
 * Bewegt alle beweglichen Steine.
 * @param byX
 * @param byY
 * @returns {boolean}
 */
function move(byX, byY) {
    // Prüfen ob das Feld frei ist, auf das verschoben werden soll.
    for(let y = 0; y < field.length; y++) {
        for(let x = 0; x < field[y].length; x++) {
            if(field[y][x].state == "moving") {
                const newX = x + byX;
                const newY = y + byY;
                if(newX < 0 || newX >= field[0].length || newY < 0 || newY >= field.length || field[newY][newX].state == "occupied") {
                    return false;
                }
            }
        }
    }

    // Verschieben
    for(let y = 0; y < field.length; y++) {
        for(let x = 0; x < field[y].length; x++) {
            if(field[y][x].state == "moving") {
                const newX = x + byX;
                const newY = y + byY;
                field[newY][newX].new = JSON.parse(JSON.stringify(field[y][x]))
                field[y][x].moved = true
            }
        }
    }

    acceptChanges();
    return true;
}

/**
 * Setzt alle sich bewegenden Objekt auf stehend.
 */
function setOccupied() {
    for(let y = 0; y < field.length; y++) {
        for(let x = 0; x < field[y].length; x++) {
            if(field[y][x].state == "moving") {
                field[y][x].state = "occupied";
            }
        }
    }
}

/**
 * Rotiert einen Block um sich selbst.
 * @returns {boolean}
 */
function rotate() {
    const input = $('#form input.rotate');
    const val = Number(input.val());
    input.val(val + 1);

    // Prüfen ob das Feld frei ist auf das rotiert werden soll
    for(let y = 0; y < field.length; y++) {
        for(let x = 0; x < field[y].length; x++) {
            if(field[y][x].state == "moving") {
                const newX = x + field[y][x].rotate.x;
                const newY = y + field[y][x].rotate.y;
                if(newX < 0 || newX >= field[0].length || newY < 0 || newY >= field.length || field[newY][newX].state == "occupied") {
                    return false;
                }
            }
        }
    }

    // Rotieren
    for(let y = 0; y < field.length; y++) {
        for(let x = 0; x < field[y].length; x++) {
            if(field[y][x].state == "moving") {
                const newX = x + field[y][x].rotate.x;
                const newY = y + field[y][x].rotate.y;
                field[newY][newX].new = JSON.parse(JSON.stringify(field[y][x]));
                field[newY][newX].new.rotate = {
                    x : -Number(field[y][x].rotate.y),
                    y : Number(field[y][x].rotate.x)
                };
                field[y][x].moved = true
            }
        }
    }

    acceptChanges();
    redrawPlayground();
    return true;
}

/**
 * Übernimmt die Änderungen auf das Spielfeld.
 */
function acceptChanges() {
    for(let y = 0; y < field.length; y++) {
        for(let x = 0; x < field[y].length; x++) {
            if(field[y][x].hasOwnProperty("new")) {
                field[y][x] = JSON.parse(JSON.stringify(field[y][x].new));
                delete field[y][x].new;
                delete field[y][x].moved;
            } else if(field[y][x].hasOwnProperty("moved")) {
                field[y][x] = {
                    state: "free"
                }
            }
        }
    }
}

/**
 * Zeichnet die Vorschau neu.
 * @param elementId
 */
function redrawPreview(elementId) {
    $('#next').attr("class", elements[elementId].name);
}

/**
 * Steuer das Spiel.
 */
function loop() {
    const finishedRows = checkRows();

    if(finishedRows.length) {
        // Wenn Reihen gelöst wurden.
        music.volume = 0.5
        $('#sounds .clear')[0].play();
        addPoints(finishedRows);
        finishRows(finishedRows);
        setTimeout(() => {
            music.volume = 1;
        }, 1000);
    } else if(isGameover()) {
        // Prüfen ob das Spiel vorbei ist
        gameover();
    } else {
        // Ansonsten Spiel fortsetzen
        switch(mode) {
            case "newElement":
                newElement(nextElement);
                redrawPlayground();
                mode = "down";
                nextElement = rand(0, elements.length - 1);
                redrawPreview(nextElement);
                loop();
                break;
            case "down":
                timeout = setTimeout(function() {
                    down();
                    loop();
                }, speed());
                break;
        }
    }
}

/**
 * Speichert per AJAX den Score
 */
function saveScore() {
    const form = $('form');
    const data = form.serialize();
    const url = form.attr("action") + "&type=171994";
    const uidField = form.find('input.uid');

    $.ajax({
        method: "POST",
        url: url,
        data: data
    }).always(function( msg ) {
        console.log("Data Saved: ");
        console.log(msg);
        uidField.val(msg.uid).prop("disabled", false);
    });
}