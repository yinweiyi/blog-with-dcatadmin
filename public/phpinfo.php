<?php

$from = $_GET['from'] ?? '';
if ($from != 'weiyi') {
    echo '';
    die;
}
phpinfo();
