<?php
/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 12/11/15
 * Time: 15:17
 */

namespace Test;


use ApplicationCommand\Application;
use Interfaces\TestInterface;

class SingleCommandTest implements TestInterface
{
    public function runTest()
    {
        $application = new Application();

        $application->setAutoExit(false);

        $application->run();
    }
}