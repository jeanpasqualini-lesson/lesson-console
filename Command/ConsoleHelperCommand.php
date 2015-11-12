<?php
/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 12/11/15
 * Time: 15:38
 */

namespace Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Process\ProcessBuilder;

class ConsoleHelperCommand extends Command
{
    public function configure()
    {
        $this
            ->setName("demo:helper")
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Demo helper");

        $this->testOne($input, $output);

        $this->testTwo($input, $output);

        $this->testThree($input, $output);

        $this->testFoor($input, $output);

        $this->testFive($input, $output);
    }

    public function testOne(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);

        $table
            ->setHeaders(array("Id", "Prenom"))
            ->setRows(array(
                array("1", "John"),
                array("2", "Paul")
            ));

        $table->render();
    }

    public function testTwo(InputInterface $input, OutputInterface $output)
    {
        $progress = new ProgressBar($output, 50);

        $progress->start();

        $i = 0;
        while ($i++ < 50) {
            $progress->advance();
        }

        $progress->finish();
    }

    public function testThree(InputInterface $input, OutputInterface $output)
    {
        $formatter = $this->getHelper('formatter');

        $formattedLine = $formatter->formatSection(
            "SomeSection",
            "Here is some message related to that section"
        );

        $output->writeln($formattedLine);

        $errorMessages = array('Error!', 'Something went wrong');
        $formattedBlock = $formatter->formatBlock($errorMessages, 'info');
        $output->writeln($formattedBlock);
    }

    public function testFoor(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper("question");

        $question = new ConfirmationQuestion("Veut tu continuer", false);

        if(!$helper->ask($input, $output, $question))
        {
            $output->writeln("OUIIIII");
        }
        else
        {
            $output->writeln("NOOOON");
        }
    }

    public function testFive(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper("process");

        $process = ProcessBuilder::create(array("ls"))->getProcess();

        $helper->run($output, $process);
    }
}