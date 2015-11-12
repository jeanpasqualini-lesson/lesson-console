<?php
/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 09/11/15
 * Time: 17:28
 */

namespace Test;

use ClassExample\ArrayTokenStorage;
use Command\AllComand;
use Command\AllCommand;
use Command\GreetCommand;
use \Interfaces\TestInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Security\Csrf\CsrfTokenManager;

class MainTest implements TestInterface
{
    public function runTest()
    {
        $application = new Application();

        $application->setAutoExit(false);

        $application->add(new GreetCommand());

        $application->add(new AllCommand());

        $this->testCommand();

        $application->run();
    }

    public function testCommand()
    {
        $application = new Application();
        $application->add(new GreetCommand());

        $command = $application->find("demo:greet");
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            "command" => $command->getName(),
            "name" => "Fabien",
            "--iterations" => 5,
        ));

        if(strstr($commandTester->getDisplay(), "Fabien"))
        {
            echo "[TEST] SUCCESS".PHP_EOL;
        }
        else
        {
            echo "[TEST] FAILLED".PHP_EOL;
        }
    }
}