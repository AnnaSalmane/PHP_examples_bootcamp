<!--
1) Lai izvadās 42 linki izmantojot ciklu for;
2) Lai katrs 6. links iekrāsojas sarkanā krāsā;
3) Pogu skaitu var nomainīt ierakstot input laukā citu skaitli. Piemēram, ierakstot laukā 30 un submitojot formu, linku skaists kurš izvadās ir 30 nevis 40.
4) Klikšķinot uz katru 3. elementu izvadās paziņojums uz ekrāna ar tā elementa kārtas skaitli;
5) Pie tā paša klikšķa uz katru 3. elementu tā elementa vērtība palienās par +1, turklāt iespējams atkārtoti klikšķināt, pimēram, palielināt trešā elementa vērtību uz skaitli 7.
6) Pielikt klåt aiz visiem linkiem vel vienu pogu ar vērtību "+", uz šī linka uzklikšķinot pievienojas vel viens elements link kārtas skaitli. Pimēram, ja bija 30 linki un uzspiedām uz "+" tad paliek 31 links.
    6.1.) PIevienot vel vienu linku ar tekstu "+"
    6.2.) Pārtvert klikšķa notikumu array_key_exists(...)
    6.3.) pievienot vel vienu linku kā nākošo elementu.
7)
    7.1.) PIevienot vel vienu linku ar tekstu "-"
    7.2.) Pārtvert klikšķa notikumu array_key_exists(...)
    7.3.) pie kliekšķa uz "-" linku samazināt amount par 1 (samazināt kopējo linku skaitu)
-->



<?php
include "head.php";
$page = '42_link';

include "DataManager.php";
$manager = new DataManager('42_data.json');

?>

<style>
    a.btn {
        margin: 5px;
    }
</style>

<div class="container">
    <?php include "navigation.php"; ?>

    <form action="">
        <div class="mb-3">
            <label for="link-amount" class="form-label">Amount of links</label>
            <input id="link-amount" name="amount" type="number" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-info">submit</button>
        </div>
    </form>

    <?php
    // $winner = new DataManager('amount.json');

    if (
        array_key_exists('amount', $_GET) &&
        is_string($_GET['amount'])
    ) {
        $amount = (int) $_GET['amount'];  // init izdara to, lai skaitlis būtu vesels
    } else {
        $amount = $manager->get('amount', 0);
    }

    if ($amount == '') {
        $amount = 42;
    }

    if (array_key_exists('next', $_GET)) {  // izpilda 6.2 nosacijumu
        $amount++;
    }
    if (array_key_exists('back', $_GET)) {  // izpilda 6.2 nosacijumu
        $amount--;
    }

    $manager->save('amount', 0, $amount);  // padod divas atslēgas un vērtību kas ierakstīsies

    $output = '';

    if (
        array_key_exists('id', $_GET) &&
        is_string($_GET['id'])
    ) {
        $id = (int) $_GET['id'];
        if ($id % 3 === 0) {
            $output .= "ID: " . $id;  // .= nozīmē, ka pie sākotnējās vērtības tiks pievienots šis teksts
            //START 5
            $link_value = $manager->get('links', $id);
            if ($link_value === '') {
                $link_value = $id;
            }
            $manager->save('links', $id, ++$link_value);
            // END 5 + vel cikla izmainas
        }
    }

    for ($i = 1; $i <= $amount; $i++) {
        $value = $manager->get('links', $i);
        if ($value === '') {
            $value = $i;
        }

        //vel viena iespeja ka uzrakstit isak zemak esoso if
        //$class_name = ($i % 6 === 0) ? 'btn-danger' : 'btn-dark';
        //echo "<a href='?id=$i' class='btn $class_name'>$value</a>

        if ($i % 6 === 0) {
            echo "<a href='?id=$i' class='btn btn-danger'>$value</a>";
        } else {
            echo "<a href='?id=$i' class='btn btn-dark'>$value</a>";
        }
    }
    ?>

    <a href="?next" class="btn btn-success">+</a>
    <a href="?back" class="btn btn-success">-</a>

    <?php

    echo $output;  //izvada id vērtību no katra 3.lauka 
    ?>
</div>