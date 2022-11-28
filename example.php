<?php

spl_autoload_register(function($class){
    include'library/'.$class.'.php';
});

spl_autoload_register(function($class){
    include'commands/'.$class.'.php';
});

$commandHandler = new CommandHandler();

$commandHandler->addToCommandList(
    new ViewerCommand(commandName: "command_name", help: "Command which check equals between two numbers"),
    new SimpleCommand(commandName: "simple_command", help: "This command for checking")
);

$incomingCommandName = $commandHandler->getIncomingCommand();

if (!$incomingCommandName){
    $commandHandler->printCommandList();

    return;
}

$incomingArguments = $commandHandler->parseArguments();
$incomingOptions = $commandHandler->parseOptions();

foreach ($commandHandler->getCommandList() as $command){
    if($incomingCommandName === $command->getCommandName()){
        if($commandHandler->isHelpMode($incomingArguments))
        {
            echo $command->getHelp() . "\n";
            continue;
        }

        foreach ($incomingArguments as $incomingArgument) {
            $command->addToArguments($incomingArgument);
        }

        $command->addToOptions($incomingOptions);

        $command->execute();

        return;
    }
}

echo "Undefined command";
