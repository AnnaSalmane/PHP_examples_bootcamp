<?php

include "head.php";

if (
    array_key_exists('visitor', $_GET)
    && is_string($_GET['visitor'])
    && $_GET['visitor'] != ''
) {
    $who = $_GET['visitor'];
}

$page = 'main';
?>

<div class="container">
    <?php include "navigation.php"; ?>
    <div class="row align-items-center">
        <div class="col">

            <h1><?php echo $greeting . ' ' . $who; ?> !</h1>
            <p>Lang: <?php echo $lang; ?></p>

            <form action="">
                <input type="hidden" name="lang" value="<?php echo $lang; ?>">
                <div class="mb-3">
                    <label for="visitor" class="form-label">What is your name?</label>
                    <input type="text" name="visitor" id="visitor" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">submit</button>
            </form>
        </div>
    </div>
</div>