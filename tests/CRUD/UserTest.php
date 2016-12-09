<?php   // tests/Entity/UserTest.php

namespace MiW16\Results\Tests\CRUD;

use MiW16\Results\Entity\User;
use PHPUnit_Framework_Error_Notice;
use PHPUnit_Framework_Error_Warning;

require_once __DIR__ . '/../../src/scripts/model/user/create_user.php';

/**
 * Class UserTest
 * @package MiW16\Results\Tests\Entity
 * @group users
 */
class UserTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        # Warning:
        PHPUnit_Framework_Error_Warning::$enabled = false;

        # notice, strict:
        PHPUnit_Framework_Error_Notice::$enabled = false;
    }

    public function testCreateUser()
    {
        self::assertEquals(true, create_user('prueba', 'prueba@prueba.es', 'prueba'));
    }

    /**
     * @covers \MiW16\Results\Entity\User::setUsername()
     * @covers \MiW16\Results\Entity\User::getUsername()
     */
    public function testGetSetUsername()
    {
        static::assertEmpty($this->user->getUsername());
        $username = 'UsEr TESt NaMe #' . rand(0, 10000);
        $this->user->setUsername($username);
        static::assertEquals($username, $this->user->getUsername());
    }
}


