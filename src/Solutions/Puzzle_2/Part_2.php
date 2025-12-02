<?php

declare(strict_types=1);

namespace Knappster\AdventOfCode\Solutions\Puzzle_2;

use Knappster\AdventOfCode\Solutions\AbstractSolution;

/**
 * AoC Puzzle 2 Part 1 solution.
 */
class Part_2 extends AbstractSolution
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

                    for ($x = (int) ($length / 2); $x > 0; $x--) {
                        if ($length % $x !== 0) {
                            continue;
                        }

                        $sub_strings = str_split((string) $i, $x);

                        if (
                            array_all($sub_strings, function (string $value) use ($sub_strings) {
                                return $value === $sub_strings[0];
                            })
                        ) {
                            $ranges_total += (int) $i;
                            break;
                        }
                    }
                }
            }

            return $ranges_total;
        });
    }
}
