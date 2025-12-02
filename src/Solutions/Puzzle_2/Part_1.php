<?php

declare(strict_types=1);

namespace Knappster\AdventOfCode\Solutions\Puzzle_2;

use Knappster\AdventOfCode\Solutions\AbstractSolution;

/**
 * AoC Puzzle 2 Part 1 solution.
 */
class Part_1 extends AbstractSolution
{
    public string $test_input_file_name = 'test-input.txt';

    public function __invoke(): string
    {
        return (string) $this->processInputs(function (
            string $line,
            int $last_result
        ): int {
            $ranges = array_map(function (string $range) {
                return explode('-', $range);
            }, explode(',', trim($line)));

            $ranges_total = 0;
            foreach ($ranges as $range) {
                for ($i = (int) $range[0]; $i <= (int) $range[1]; $i++) {
                    $length = strlen((string) $i);

                    if ($length % 2 !== 0) {
                        continue;
                    }

                    $size = (int) ($length / 2);
                    $str_1 = substr((string) $i, 0, $size);
                    $str_2 = substr((string) $i, $size);

                    if ($str_1 === $str_2) {
                        $ranges_total += $i;
                    }
                }
            }

            return $ranges_total;
        });
    }
}
