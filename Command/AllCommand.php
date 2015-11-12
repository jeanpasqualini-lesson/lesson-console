<?php
/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 12/11/15
 * Time: 15:06
 */

namespace Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AllCommand extends  Command
{
    public function configure()
    {
        $this
            ->setName("demo:all")
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $this->getApplication()->find("demo:greet");

        $arguments = array(
            "command" => "demo:greet",
            "name" => "Fabien",
            "--yell" => true,
        );

        $greetInput = new ArrayInput($arguments);

        $returnCode = $command->run($greetInput, $output);
    }
}