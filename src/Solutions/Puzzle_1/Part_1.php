<?php

declare(strict_types=1);

namespace Knappster\AdventOfCode\Solutions\Puzzle_1;

use Knappster\AdventOfCode\Solutions\AbstractSolution;

/**
 * AoC Puzzle 1 Part 1 solution.
 */
class Part_1 extends AbstractSolution
{
    public string $test_input_file_name = 'test-input.txt';

    public function __invoke(): string
    {
        $pointer = 50;
        $mod = 100;

        $this->loadInput();

        return (string) $this->processInputs(function (
            string $line,
            int $last_result
        ) use (&$pointer, $mod): int {
            if (str_starts_with($line, 'L')) {
                $pointer = ($pointer - (int) ltrim($line, 'L')) % $mod;

                if ($pointer < 0) {
                    $pointer += $mod;
                }
            } else {
                $pointer = ($pointer + (int) ltrim($line, 'R')) % $mod;
            }

            return $pointer === 0 ? 1 : 0;
        });
    }
}
