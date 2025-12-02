<?php

declare(strict_types=1);

namespace Knappster\AdventOfCode;

use Knappster\AdventOfCode\Solutions\AbstractSolution;
use League\CLImate\CLImate;

/**
 * Entry point to AoC app.
 */
class App
{
    public string $day;

    public string $part;

    public bool $test = false;

    public float $start_time;

    public float $end_time;

    /**
     * @param  array<string>  $args
     */
    public function __construct(array $args)
    {
        if (count($args) < 3) {
            throw new \Exception('Not enough arguments! Need puzzle and part number.');
        }

        $this->day = $args[1];
        $this->part = $args[2];
        $this->test = isset($args[3]) && $args[3] === 'test';
    }

    /**
     * Run selected solution solution.
     */
    public function __invoke(): void
    {
        $fqcn = 'Knappster\\AdventOfCode\\Solutions'
            . '\\Puzzle_' . $this->day
            . '\\Part_' . $this->part;

        try {
            if (class_exists($fqcn) && method_exists($fqcn, '__invoke')) {
                $this->start_time = microtime(true);
                $answer = new $fqcn($this->test)();
                $this->end_time = microtime(true);
                $this->output($answer);
            } else {
                throw new \Exception('Puzzle class missing!: ' . $fqcn);
            }
        } catch (\Exception $e) {
            $climate = new CLImate;
            $climate->bold()->red()->out($e->getMessage());
            $climate->border();
            debug_print_backtrace();
        }
    }

    /**
     * Print output.
     */
    private function output(string $answer = ''): void
    {
        $title = '<green>Advent of Code:</green> Day ' . $this->day . ' - Part ' . $this->part;
        $climate = new CLImate;
        $climate->bold()->out($title);
        $climate->border();
        $climate->out('<green>Answer:</green> ' . $answer);
        $climate->out('<green>Time taken:</green> ' . (($this->end_time - $this->start_time) * 1000) . 'ms');
    }
}
