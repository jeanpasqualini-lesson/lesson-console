<?php
/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 12/11/15
 * Time: 15:20
 */

namespace Test;


use Event\ConsoleEvent;
use Interfaces\TestInterface;
use Psr\Log\LogLevel;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Event\ConsoleExceptionEvent;
use Symfony\Component\Console\Event\ConsoleTerminateEvent;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class EventCommandTest implements TestInterface
{
    /** @var  EventDispatcher $dispatcher */
    protected $dispatcher;

    public function runTest()
    {
        $dispatcher = $this->dispatcher = new EventDispatcher();

        $application = new Application();

        $application->setAutoExit(false);

        $application->setDispatcher($dispatcher);

        $this->testOne();

        $this->testTwo();

        $application->run();
    }

    public function testOne()
    {
        $this->dispatcher->addListener(ConsoleEvents::COMMAND, function(ConsoleCommandEvent $event)
        {
            $output = $event->getOutput();

            $output->writeln("<error>EVENT CONSOLE::COMAND</error>");
        });

        $this->dispatcher->addListener(ConsoleEvents::TERMINATE, function(ConsoleTerminateEvent $event)
        {
            $output = $event->getOutput();

            $output->writeln("<error>EVENT CONSOLE::TERMINATE</error>");
        });

        $this->dispatcher->addListener(ConsoleEvents::EXCEPTION, function(ConsoleExceptionEvent $event)
        {
            $output = $event->getOutput();

            $output->writeln("<error>EVENT CONSOLE::EXCEPTION</error>");

            $event->setException(new \LogicException("Exception attraper"));
        });
    }

    public function testTwo()
    {
        $verbosityLevelMap = array(
            LogLevel::NOTICE => OutputInterface::VERBOSITY_NORMAL,
            LogLevel::INFO   => OutputInterface::VERBOSITY_NORMAL,
        );

        $formatLevelMap = array(
            LogLevel::CRITICAL => ConsoleLogger::INFO,
            LogLevel::DEBUG    => ConsoleLogger::ERROR,
        );

        $logger = new ConsoleLogger(new ConsoleOutput(), $verbosityLevelMap, $formatLevelMap);

        $logger->alert("On Envoie du looooooooooooog");
    }

}