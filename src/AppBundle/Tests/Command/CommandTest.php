<?php
/**
 * Created by PhpStorm.
 * User: fhm
 * Date: 27/06/17
 * Time: 01:45
 */

namespace AppBundle\Tests\Command;

use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Command\CreateCommand;

class CommandTest extends KernelTestCase{


    public function testExecute()
    {
        $kernel = $this->createKernel();
        $kernel->boot();
        // mock the Kernel or create one depending on your needs
        $application = new Application($kernel);
        $application->add(new CreateCommand());

        $command = $application->find('import:csv');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $this->assertRegExp('/.../', $commandTester->getDisplay());
    }

} 