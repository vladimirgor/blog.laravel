<?php
function articles_intro($str, $len)
{
    if (strlen($str) > $len) {
        $del = ['.',  '!', '?'];
        for ($i = $len; $i < strlen($str); $i++) {
            if (in_array($str[$i], $del) && $i >= $len) {
                $index = $i;
                break;
            }
        }
        return substr($str, 0, $index + 1);
    } else return $str;
}