<?php

$symbols = [
    'A', 'K', 'Q', 'J', '10', '9', '8', '7', '6'
];

$symbolsValue = [
    'A' => 10,
    'K' => 9,
    'Q' => 8,
    'J' => 7,
    '10' => 6,
    '9' => 5,
    '8' => 4,
    '7' => 3,
    '6' => 2,
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

$COST_PER_SPIN = 1;
$BOARD_ROWS = 3;
$BOARD_COLUMNS = 5;
//$board = [];

function playBoard ()
{
    global $BOARD_ROWS, $BOARD_COLUMNS , $symbols;
    $GLOBALS['board'] = [];
    for ($row = 0; $row < $BOARD_ROWS; $row++) {
        for ($columns = 0; $columns < $BOARD_COLUMNS; $columns++) {
            $GLOBALS['board'][$row][] = $symbols[array_rand($symbols)];
        }
    }
    foreach ($GLOBALS['board'] as $row) {
        echo implode(" | ", $row) . PHP_EOL;
    }
}

$selection = (int)readline("WELCOME! Do you want to play?" .
        "   1. YES!" .
        "   2. No." .
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
            playBoard();
        }
    }
echo PHP_EOL;

$playerCash = (int)readline("Please, make a deposit: ");

while ($playerCash > 0) {

    $spin = readline("Spin?\n" .
        "   1. YES!\n" .
        "   2. No.");
        if ($spin == 1) {
            playBoard();
            echo "Your cash: {$playerCash}$\n";
        } else {
            $quitGame = (int)readline("Do you want to quit?\n" .
                "1. Yes!\n" .
                "2. No.");
            if ($quitGame == 1) {
                echo "Your cash: {$playerCash}$" . PHP_EOL;
                echo "See you soon!" . PHP_EOL;
                break;
            } else {
                echo "Lets continue!" . PHP_EOL;
                playBoard();
            }
        }

    $playerCash -= $COST_PER_SPIN;
    playBoard();

    $win = 0;
    foreach ($lines as $line) {
        $lineValues = [];
        foreach ($line as $position) {
            [$x, $y] = $position;
            $lineValues []= $GLOBALS['board'][$x][$y];
        }

        if (count(array_unique($lineValues)) == 1) {
            $win++;
            $playerCash += $symbolsValue["{$lineValues[0]}"];
            echo "WE GOT A LINE!!!" . PHP_EOL;
        }
    }

    echo "Your cash: {$playerCash}$" . PHP_EOL;

    if ($playerCash == 0) {
        echo "You have no money left in your portfolio :( See you next time!\n";
        exit;
    }
}
