<?php

namespace igor1parkin\SmartCommand;

abstract class SmartCommand
{
    public function __construct(
        private string $commandName,
        private string $help,
        private array $options = [],
        private array $arguments = []
    ) {
    }

    /**
     * @return string
     */
    public function getCommandName(): string
    {
        return $this->commandName;
    }

    /**
     * @return string
     */
    public function getHelp(): string
    {
        return $this->help;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @return array
     */
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