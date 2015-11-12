<?php
namespace Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 12/11/15
 * Time: 14:26
 */
class GreetCommand extends Command
{
    public function initialize()
    {
        echo "INITIALIZED...".PHP_EOL;
    }

    public function interact()
    {
        echo "INTERACT...".PHP_EOL;
    }

    protected function configure()
    {
        echo "CONFIGURE...".PHP_EOL;

        $this
            ->setName("demo:greet")
            ->setDescription("Greet someone")
            ->addArgument(
                "name",
                InputArgument::OPTIONAL,
                "Who do you want to greet ?"
            )
            ->addArgument(
                "names",
                InputArgument::IS_ARRAY,
                "Who do you want to greet ?"
            )
            ->addOption(
                "yell",
                null,
                InputOption::VALUE_NONE,
                "If set, the task will yell in uppercase letters"
            )
            ->addOption(
                "iterations",
                null,
                InputOption::VALUE_REQUIRED,
                "How many times should the message be printed?",
                1
            )
            ->addOption(
                "colors",
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Which colors do you like?',
                array('blue', 'red')
            )
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        echo "EXECUTE...".PHP_EOL;

        $this->testOne($input, $output);

        $this->testTwo($input, $output);

        $this->testThree($input, $output);

        $this->testFoor($input, $output);

        $this->testFive($input, $output);
    }

    protected function testOne(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument("name");

        if($name)
        {
            $text = "Hello $name";
        }
        else
        {
            $text = "Hello";
        }

        if ($names = $input->getArgument('names')) {
            $text .= ' '.implode(', ', $names);
        }

        if($input->getOption("yell"))
        {
            $text = strtoupper($text);
        }

        for ($i = 0; $i < $input->getOption('iterations'); $i++) {
            $output->writeln($text);
        }
    }

    protected function testTwo(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("<info>INFO</info>");

        $output->writeln("<comment>COMMENT</comment>");

        $output->writeln("<question>QUESTION</question>");

        $output->writeln("<error>ERROR</error>");
    }

    public function testThree(InputInterface $input, OutputInterface $output)
    {
        $style = new OutputFormatterStyle("red", "yellow", array("bold", "blink"));

        $output->getFormatter()->setStyle("fire", $style);

        $output->writeln("<fire>CUSTOM STYLE FIRE</fire>");
    }

    public function testFoor(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("<fg=green>GREEN TEXT</>");

        $output->writeln("<fg=black;bg=cyan>BLACK AND CYAN</>");

        $output->writeln("<bg=yellow;options=bold>YELLOW BOLD</>");
    }

    public function testFive(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("VERBOSITY_QUIET", OutputInterface::VERBOSITY_QUIET);
        $output->writeln("VERBOSITY_NORMAL", OutputInterface::VERBOSITY_NORMAL);
        $output->writeln("VERBOSITY_VERBOSE", OutputInterface::VERBOSITY_VERBOSE);
        //$output->writeln("VERBOSITY_VERY_VERBOSE", OutputInterface::VERBOSITY_VERY_VERBOSE);
        //$output->writeln("VERBOSITY_DEBUG", OutputInterface::VERBOSITY_DEBUG);
    }
}