/**
 * Ermittelt eine Zufallszahl
 * @param min
 * @param max
 * @returns {*}
 */
function rand (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

/**
 * Gibt die Hintergrundmusik zurück.
 * @param container
 * @returns {*}
 */
function getMusic(container) {
    let probalitiySum = 0;

    // Zufallszahl ermitteln
    container.find('audio').each(function() {
        probalitiySum += Number($(this).attr("data-probability"));
    });
    const number = rand(1, probalitiySum);

    // Audio zurückgeben
    probalitiySum = 0;
    let audio = container.find('audio').last();
    container.find('audio').each(function() {
        probalitiySum += Number($(this).attr("data-probability"));
        if(number <= probalitiySum) {
            audio = $(this);
            return false;
        }
    });
    return audio[0];
}