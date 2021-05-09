<?php
include "head.php";
$page = 'four_in_line';

include "DataManager.php";
$manager = new DataManager('four_in_line_db.json');
$winner = new DataManager('four_in_line_winner.json');
include "Validator.php";
$validator = new Validator('four_in_line_db.json', 3);

$alert = '';

if ($winner->get(0, 'winner') !== '') {
    $manager->deleteAll();
    $winner->deleteAll();
}

if (
    array_key_exists('r', $_GET) &&
    array_key_exists('c', $_GET) &&
    is_string($_GET['r']) &&
    is_string($_GET['c'])
) {
    $r = $_GET['r'];
    $c = $_GET['c'];

    if (
        $manager->get($r, $c) === '' &&
        ($r == 10 || $manager->get($r + 1, $c) !== '')
    ) {
        if ($manager->count() % 2 === 0) {
            $current_value = 'x';
        } else {
            $current_value = 'o';
        }
        $manager->save($r, $c, $current_value);

        $alert = $validator->validate($r, $c, $current_value);
        if ($alert) {
            $winner->save(0, 'winner', $current_value);
        }
    }
} elseif (
    array_key_exists('restart', $_GET) &&
    $_GET['restart'] === '1'
) {
    $manager->deleteAll();
}


?>
<style>
    .four_in_line {
        display: grid;
        grid-template: repeat(10, 1fr) / repeat(10, 1fr);
        grid-gap: 10px;
        height: 360px;
        width: 360px;
        margin: 50px auto;
    }

    .four_in_line a {
        border: 1px solid black;
        text-align: center;
        line-height: 100%;
        font-size: 20px;
        text-decoration: none;
    }

    .four_in_line a:hover {
        background: lightgreen;
    }
</style>

<div class="container">
    <?php include "navigation.php";

    if ($alert) {
        echo "<div class='alert alert-success'>$alert</div>";
    }
    ?>
    <div class="four_in_line">
        <?php
        for ($r = 1; $r <= 10; $r++) {
            for ($c = 1; $c <= 10; $c++) {
                echo "<a href='?r=$r&c=$c'>" . $manager->get($r, $c) . "</a>";
            }
        }
        ?>
    </div>
    <div style="display:flex; justify-content: center;">
        <a href="?restart=1" class="btn btn-warning">Sākt no jauna</a>
    </div>
</div>