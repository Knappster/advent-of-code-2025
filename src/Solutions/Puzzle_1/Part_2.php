<?php

declare(strict_types=1);

namespace Knappster\AdventOfCode\Solutions\Puzzle_1;

use Knappster\AdventOfCode\Solutions\AbstractSolution;

/**
 * AoC Puzzle 1 Part 2 solution.
 */
class Part_2 extends AbstractSolution
{
    public string $test_input_file_name = 'test-input.txt';

    public function __invoke(): string
    {
        $this->init();

        $pointer = 50;
        $mod = 100;

        return (string) $this->processInputs(function (
            string $line,
            int $last_result
        ) use (&$pointer, $mod): int {
            $passes_zero = 0;
            $orig_pointer = $pointer;

            if (str_starts_with($line, 'L')) {
                $operation = ($pointer - (int) ltrim($line, 'L'));
                $pointer = $operation % $mod;

                if ($orig_pointer !== 0 && $pointer <= 0) {
                    $passes_zero++;
                }

                if ($pointer < 0) {
                    $pointer += $mod;
                }
            } else {
                $operation = ($pointer + (int) ltrim($line, 'R'));
                $pointer = $operation % $mod;
            }

            $passes_zero += (int) abs($operation / $mod);

            return $passes_zero;
        });
    }
}
