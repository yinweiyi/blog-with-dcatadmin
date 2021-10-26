<?php

$from = $_GET['from'] ?? '';
if ($from != 'weiyi') {
    echo '';
    return;
}
phpinfo();
