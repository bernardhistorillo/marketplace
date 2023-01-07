<?php

function shortenAddress($address, $prefixCount, $postfixCount) {
    $prefix = substr($address, 0, $prefixCount);
    $postfix = substr($address, strlen($address) - $postfixCount, strlen($address));

    return $prefix . "..." . $postfix;
}

function toEther($value) {
    $value = strval($value);
    $new_value = '';

    $j = 1;
    for($i = strlen($value) - 1; $i >= 0; $i--) {
        if($j == 18) {
            $new_value = '.' . $new_value;
        } else {
            $new_value = $value[$i] . $new_value;
        }

        $j++;
    }

    return $new_value;
}
