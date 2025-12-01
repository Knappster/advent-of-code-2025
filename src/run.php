<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

try {
    new Knappster\AdventOfCode\App($argv)();
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}
