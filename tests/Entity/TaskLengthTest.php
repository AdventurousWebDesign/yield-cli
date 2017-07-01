<?php

namespace YieldCLI\tests\Command;

use YieldCLI\Entity\TaskLength;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaskLengthTest extends KernelTestCase
{
    public function testGeneralLengthMethods()
    {
        $tl = new TaskLength('1h22m');
        $this->assertEquals(1, $tl->getHours());
        $this->assertEquals(22, $tl->getMinutes());

        $tl = new TaskLength('1.5h');
        $this->assertEquals(1, $tl->getHours());
        $this->assertEquals(30, $tl->getMinutes());

        $tl = new TaskLength('1.5h80m');
        $this->assertEquals(2, $tl->getHours());
        $this->assertEquals(50, $tl->getMinutes());

        $tl = new TaskLength('10m');
        $this->assertEquals(0, $tl->getHours());
        $this->assertEquals(10, $tl->getMinutes());
    }//end testGeneralLengthMethods()

    /**
     * Just get/set hours + minutes the good ol' fashioned way.
     *
     * @return void
     */
    public function testGeneralGetterSetters()
    {
        $tl = new TaskLength();

        $tl->setHours(2)->setMinutes(3);

        $this->assertEquals(2, $tl->getHours());
        $this->assertEquals(3, $tl->getMinutes());
    }//end testGeneralGetterSetters()

    /**
     * See what happens when the length given is bogus.
     *
     * @expectedException        \Exception
     * @expectedExceptionMessage Could not parse task length of pi
     *
     * @return void
     */
    public function testInvalidLengthString()
    {
        $tl = new TaskLength('pi');
    }//end testInvalidLengthString()

    /**
     * If we abuse our powers and set strings to hours and minutes, will add*
     * recover?
     *
     * @return void
     */
    public function testRecoverFromNonsenseMinutes()
    {
        $tl = new TaskLength();
        $tl->setMinutes('boop')->setHours('doop');
        $tl->addMinutes(1)->addHours(1);

        $this->assertEquals(1, $tl->getHours());
        $this->assertEquals(1, $tl->getMinutes());
    }//eng testRecoverFromNonsenseMinutes()
}//end class

