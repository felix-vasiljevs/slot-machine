<?php

$symbols = [
    ['A' => 10],
    ['K' => 8],
    ['Q' => 6],
    ['J' => 4],
    ['10' => 2],
];

$randomSymbols = $symbols[array_rand($symbols)];
$implodedSymbols = implode(' | ', $randomSymbols);

$playGround = [
    [$implodedSymbols, $implodedSymbols, $implodedSymbols, $implodedSymbols, $implodedSymbols],  // 0
    [$implodedSymbols, $implodedSymbols, $implodedSymbols, $implodedSymbols, $implodedSymbols],  // 1
    [$implodedSymbols, $implodedSymbols, $implodedSymbols, $implodedSymbols, $implodedSymbols]   // 2
//    0    1    2    3    4
];

$lines = [
//    horizontal
    [[0, 0], [0, 1], [0, 2], [0, 3], [0, 4]],
    [[1, 0], [1, 1], [1, 2], [1, 3], [1, 4]],
    [[2, 0], [2, 1], [2, 2], [2, 3], [2, 4]],
//    float
    [[0, 0], [0, 1], [1, 2], [0, 3], [0, 4]],
    [[2, 0], [2, 1], [1, 2], [2, 3], [2, 4]],
//    V type
    [[0, 0], [1, 1], [2, 2], [1, 3], [0, 4]],
    [[2, 0], [1, 1], [0, 2], [1, 3], [2, 4]],
//    U type
    [[1, 0], [0, 1], [0, 2], [0, 3], [1, 4]],
    [[1, 0], [2, 1], [2, 2], [2, 3], [1, 4]],
//    step
    [[2, 0], [2, 1], [1, 2], [1, 3], [1, 4]],
    [[0, 0], [0, 1], [1, 2], [1, 3], [1, 4]],
//    zig-zag
    [[2, 0], [1, 1], [1, 2], [1, 3], [0, 4]],
];

function displayPlayBoard (array $playGround)
{
    echo " {$playGround[0][0]} | {$playGround[0][1]} | {$playGround[0][2]} | {$playGround[0][3]} | {$playGround[0][4]} \n";
    echo "---+---+---+---+---\n";
    echo " {$playGround[1][0]} | {$playGround[1][1]} | {$playGround[1][2]} | {$playGround[1][3]} | {$playGround[1][4]} \n";
    echo "---+---+---+---+---\n";
    echo " {$playGround[2][0]} | {$playGround[2][1]} | {$playGround[2][2]} | {$playGround[2][3]} | {$playGround[2][4]} \n";
}

$COST_PER_SPIN = 1;
//$BOARD_ROWS = 3;
//$BOARD_COLUMNS = 5;
//$board = [];

$selection = (int)readline("\nWELCOME! Do you want to play?\n" .
        "\n1. YES!\n" .
        "\n2. No.\n" .
        "Enter your choice : ");
    echo PHP_EOL;
    if ($selection == 1) {
        echo "Let's get started.\n";

    } elseif ($selection == 2) {
        $quittingGame = (int)readline("Do you want to quit?\n" .
            "1. Yes\n" .
            "2. No\n");
        echo PHP_EOL;
        if ($quittingGame == 1) {
            echo "See you soon\n";
            exit;
        } else {
            echo "Alright! Let's have some fun\n";
            displayPlayBoard($playGround);
        }
    }
echo PHP_EOL;

$playerCash = (int)readline("Please, make a deposit: ");

while ($playerCash > 0) {

    $spin = readline("Spin?\n" .
        "1. YES!\n" .
        "2. No.");

        if ($spin == 1) {
            displayPlayBoard($playGround);
            $playerCash -= $COST_PER_SPIN;
            echo "Your cash: {$playerCash}$\n";
        } else {
            $quitGame = (int)readline("Do you want to quit?\n" .
                "1. Yes!\n" .
                "2. No.");
            if ($quitGame == 1) {
                echo "Your cash: {$playerCash}$\n";
                echo "See you soon!\n";
                break;
            } else {
                echo "Lets continue!\n";
                displayPlayBoard($playGround);
            }
        }

    foreach ($lines as $line) {
        $lineValues = [];

            foreach ($line as $position) {
                $x = $position[0];
                $y = $position[1];
                $value = $playGround[$x][$y];
                $test = array_push($lineValues, $value);
            }

        foreach ($symbols as $value){
            $symbolsValue = $value;
        }

        if (array_sum($lineValues) == count($line)) {
            $playerCash += $symbolsValue;
            echo "WE GOT A LINE!!!\n";
//            add some cash
        }
    }
}
echo "You have no money left in your portfolio :( See you next time!\n";
