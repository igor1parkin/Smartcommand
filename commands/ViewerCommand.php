<?php

class ViewerCommand extends SmartCommand
{
    public function execute(): void
    {
        echo "Called command: " . $this->getCommandName() . "\nArguments: " . "\n";
        foreach ($this->getArguments() as $item) {
            echo "   -  " . $item . "\n";
        }

        echo "Options: " . "\n";
        foreach ($this->getOptions() as $item => $values) {
            echo "   -  " . $item . "\n";
            foreach ($values as $value) {
                echo "         -  " . $value . "\n";
            }
        }
    }
}
