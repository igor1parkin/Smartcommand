<?php

abstract class SmartCommand
{
    public function __construct(
        private string $commandName,
        private string $help,
        private array $options = [],
        private array $arguments = []
    ) {
    }

    public function getCommandName(): string
    {
        return $this->commandName;
    }

    public function getHelp(): string
    {
        return $this->help;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function addToArguments(string $newArgument): void
    {
        $this->arguments[] = $newArgument;
    }

    public function addToOptions(array $newOptions): void
    {
        foreach ($newOptions as $key => $value) {
            $this->options[$key] = $value;
        }
    }

    abstract public function execute(): void;
}
