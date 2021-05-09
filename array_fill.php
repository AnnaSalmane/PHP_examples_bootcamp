<?php
include "head.php";
$page = 'array_fill';
?>

<style>
    td {
        border: 1px solid black;
    }
</style>

<div class="container">
    <?php include "navigation.php";

    $template = [
        [0, 0, 0],
        [0, 0, 0],
        [0, 0, 0]
    ];

    /*
    Piemērs #1
        [x, x, x],
        [x, x, x],
        [x, x, x]
    */
    $table = $template;
    for ($r = 0; $r <= 2; $r++) {
        for ($c = 0; $c <= 2; $c++) {
            $table[$r][$c] = 'x';
        }
    }
    printTable($table);

    /*
    Piemērs #2
        [x, 0, x],
        [x, 0, x],
        [x, 0, x]
    */
    $table = $template;

    for ($r = 0; $r <= 2; $r++) {
        for ($c = 0; $c <= 2; $c += 2) {
            $table[$r][$c] = 'x';
        }
    }
    printTable($table);

    /*
    Piemērs #3
        [x, x, x],
        [x, x, x],
        [0, 0, 0]
    */
    $table = $template;

    for ($r = 0; $r <= 1; $r++) {
        for ($c = 0; $c <= 2; $c++) {
            $table[$r][$c] = 'x';
        }
    }
    printTable($table);

    /*
    Piemērs #4
        [x, 0, 0],
        [0, x, 0],
        [0, 0, x]
    */

    /*
    Piemērs #5
        [0, 0, x],
        [0, 0, x],
        [x, x, x]
    */

    /*
    Piemērs #6
        [6, 0, 5],
        [4, 0, 3],
        [2, 0, 1]
    */

    /*
    Piemērs #7
        [8, 0, 5],
        [3, 0, 2],
        [1, 0, 1]
    */

    /*
    Piemērs #8
        [5, -1, 1],
        [-8, 2, 0],
        [13, -3, 1]
    */

    ?>


</div>

<?php

function printTable($table)
{
    static $count = 0;
    $count++;
    echo "<h2>$count</h2>";
    echo "<table>";
    for ($i = 0; $i <= 2; $i++) {
        echo "<tr>";
        for ($k = 0; $k <= 2; $k++) {
            echo "<td>";
            echo $table[$i][$k];
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table><br>";
}
?>