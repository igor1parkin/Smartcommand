<?php

class CommandHandler
{
    private array $commandList = [];

    public function __construct()
    {
    }

    public function getIncomingCommand(): ?string
    {
        return $_SERVER['argv'][1] ?? null;
    }

    public function getCommandList(): array
    {
        return $this->commandList;
    }

    public function addToCommandList(SmartCommand ...$commands): void
    {
        foreach ($commands as $command) {
            $this->commandList[] = $command;
        }
    }

    public function printCommandList(): void
    {
        echo "Commands: \n";

        foreach ($this->commandList as $command) {
            echo "   -   " . $command->getCommandName() . "\n";
        }
    }

    /**
     * Костыль т.к. возникла проблема с парсингом агрумента {arg1,arg2} - массив $argv возвращает как ['arg1', 'arg2']
     * а {arg1, arg2} как ['{arg1', 'arg2}']
     */
    public function parseArguments(): array
    {
        $args = $_SERVER['argv'];
        $arguments = [];
        for ($i = 2; $i <= count($args) - 1; $i++) {
            if ($this->isNotOption($args[$i])) {
                $arguments[] = preg_replace('#[{}]+#', '', $args[$i]);
            }
        }

        return $arguments;
    }

    private function isArg(string $inputString): bool
    {
        return str_contains($inputString, "{") || str_contains($inputString, "}");
    }


    /**
     * Решил использовать эту функцию т.к важно отфильтровать [name={value1,value2,value3}] isArg() для этого не подошёл
     */
    private function isNotOption(string $inputString): bool
    {
        return mb_substr($inputString, 0, 1) !== "[" && mb_substr($inputString, -1, 1) !== "]";
    }

    public function parseOptions(): array
    {
        $args = $_SERVER['argv'];
        $options = [];
        foreach ($args as $arg) {
            preg_match('/(?<=\[)(.+?)(?=\])/', $arg, $matches);
            if ($matches) {
                $optionValue = explode("=", $matches[0]);
                $options[$optionValue[0]][] = $optionValue[1];
            }
        }
        return $options;
    }

    public function isHelpMode(array $arguments): bool
    {
        return in_array('help', $arguments);
    }
}
