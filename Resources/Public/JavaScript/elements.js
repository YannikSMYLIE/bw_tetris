const elements = [
    {
        chords: [ // Das I
            {x : 2, y : 0, rotateX: 1, rotateY : -1},
            {x : 3, y : 0, rotateX: 0, rotateY : 0},
            {x : 4, y : 0, rotateX: -1, rotateY : 1},
            {x : 5, y : 0, rotateX: -2, rotateY : 2}
        ],
        name: "I"
    },
    {
        chords: [ // Das L
            {x : 3, y : 1, rotateX: 1, rotateY : -1},
            {x : 4, y : 1, rotateX: 0, rotateY : 0},
            {x : 5, y : 1, rotateX: -1, rotateY : 1},
            {x : 5, y : 0, rotateX: 0, rotateY : 2}
        ],
        name: "L"
    },
    {
        chords: [ // Das J
            {x : 3, y : 0, rotateX: 2, rotateY : 0},
            {x : 3, y : 1, rotateX: 1, rotateY : -1},
            {x : 4, y : 1, rotateX: 0, rotateY : 0},
            {x : 5, y : 1, rotateX: -1, rotateY : 1}
        ],
        name: "J"
    },
    {
        chords: [ // Das O
            {x : 3, y : 0, rotateX: 0, rotateY : 0},
            {x : 3, y : 1, rotateX: 0, rotateY : 0},
            {x : 4, y : 0, rotateX: 0, rotateY : 0},
            {x : 4, y : 1, rotateX: 0, rotateY : 0}
        ],
        name: "O"
    },
    {
        chords: [ // Das Z
            {x : 3, y : 0, rotateX: 2, rotateY : 0},
            {x : 4, y : 0, rotateX: 1, rotateY : 1},
            {x : 4, y : 1, rotateX: 0, rotateY : 0},
            {x : 5, y : 1, rotateX: -1, rotateY : 1}
        ],
        name: "Z"
    },
    {
        chords: [ // Das S
            {x : 3, y : 1, rotateX: 1, rotateY : -1},
            {x : 4, y : 1, rotateX: 0, rotateY : 0},
            {x : 4, y : 0, rotateX: 1, rotateY : 1},
            {x : 5, y : 0, rotateX: 0, rotateY : 2}
        ],
        name: "S"
    },
    {
        chords: [ // Das T
            {x: 3, y: 1, rotateX: 1, rotateY: -1},
            {x: 4, y: 0, rotateX: 1, rotateY: 1},
            {x: 4, y: 1, rotateX: 0, rotateY: 0},
            {x: 5, y: 1, rotateX: -1, rotateY: 1}
        ],
        name: "T"
    }
];

/**
 * Erstellt ein Spielfeld.
 * @param xSize
 * @param ySize
 * @returns {*}
 */
function createField(xSize, ySize) {
    let field = new Array(ySize);
    for(let y = 0; y < field.length; y++) {
        field[y] = new Array(xSize);
        for(let x = 0; x < field[y].length; x++) {
            field[y][x] = {
                state: "free"
            }
        }
    }
    return field;
}