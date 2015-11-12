<?php
namespace ApplicationCommand;

use Command\ConsoleHelperCommand;
use Command\GreetCommand;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 12/11/15
 * Time: 15:18
 */
class Application extends BaseApplication
{
    protected function getCommandName(InputInterface $input)
    {
        return "demo:helper";
    }

    protected function getDefaultCommands()
    {
        // Keep the core default commands to have the HelpCommand
        // which is used when using the --help option
        $defaultCommands = parent::getDefaultCommands();

        $defaultCommands[] = new ConsoleHelperCommand();

        return $defaultCommands;
    }

    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();

        $inputDefinition->setArguments();

        return $inputDefinition;
    }

}