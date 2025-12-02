<?php

declare(strict_types=1);

namespace Knappster\AdventOfCode\Solutions;

use Closure;
use Exception;
use ReflectionClass;
use SplFileObject;

/**
 * Basic solution helper class.
 */
abstract class AbstractSolution
{
    public string $solution_path;

    public SplFileObject $input;

    public string $input_file_name = 'input.txt';

    public string $test_input_file_name = 'test-input.txt';

    public function __construct(public bool $test = false)
    {
        $class_ref = new ReflectionClass(get_class($this));
        $class_file_path = $class_ref->getFileName();

        if ($class_file_path !== false) {
            $this->solution_path = dirname($class_file_path);
        } else {
            throw new Exception("Can't get class directory!");
        }
    }

    /**
     * Load input file.
     */
    protected function loadInput(): void
    {
        if ($this->test) {
            $file_name = $this->test_input_file_name;
        } else {
            $file_name = $this->input_file_name;
        }

        $file_path = $this->solution_path . '/input/' . $file_name;

        if (file_exists($file_path)) {
            $this->input = new SplFileObject($file_path);
        } else {
            throw new Exception("Can't find input file!");
        }
    }

    /**
     * Process each line on a callable function.
     *
     * @param  Closure(string, int): int  $callback
     */
    protected function processInputs(callable $callback): int
    {
        $total = 0;
        $last_result = 0;

        while (!$this->input->eof()) {
            $line = $this->input->current();

            if ($line !== false && !is_array($line)) {
                $last_result = $callback($line, $last_result);
                $total += $last_result;
            }

            $this->input->next();
        }

        return $total;
    }

    /**
     * Run puzzle solution.
     */
    abstract public function __invoke(): string;
}
