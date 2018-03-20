<?php
require_once 'lib' . DS . 'block_io.php';
$apiKey = '4fff-5ce6-e2b1-0131';
$pin = 'color curious master jewel doctor erode goat huge nice dwarf bunker link';
$version = 2; // the API version

$block_io = new BlockIo($apiKey, $pin, $version);
$getBalanceInfo = "";
try {
    $getBalanceInfo = $block_io->get_balance();
    
    echo "!!! Using Network: ".$getBalanceInfo->data->network."\n";
    echo "Available Amount: ".$getBalanceInfo->data->available_balance." ".$getBalanceInfo->data->network."\n";
} catch (Exception $e) {
   echo $e->getMessage() . "\n";
}
