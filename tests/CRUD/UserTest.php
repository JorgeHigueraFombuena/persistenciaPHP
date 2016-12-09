<?php   // tests/Entity/UserTest.php

namespace MiW16\Results\Tests\CRUD;

use MiW16\Results\Entity\User;
use PHPUnit_Framework_Error_Notice;
use PHPUnit_Framework_Error_Warning;

require_once __DIR__ . '/../../src/scripts/web/model/user_functions.php';

class UserTest extends \PHPUnit_Framework_TestCase
{
    /** @var  User */
    private $user;

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
        create_user('test', 'test@test.es', 'test');
        $users = list_users();
        /** @var User $user */
        foreach ($users as $user) {
            if ($user->getUsername() === 'test'){
                $this->user = $user;
                break;
            }
        }
    }

    protected function tearDown()
    {
        parent::tearDown();

        delete_user($this->user->getId());
    }


    public function testCreateUser()
    {
        self::assertEquals(true, create_user('prueba', 'prueba@prueba.es', 'prueba'));
        $users = list_users();
        /** @var User $user */
        foreach ($users as $user) {
            if ($user->getUsername() === 'prueba'){
                delete_user($user->getId());
                break;
            }
        }
    }


    public function testGetUser()
    {
        static::assertEquals($this->user->getUsername(), get_user($this->user->getId())->getUsername());
    }

    public function testDeleteUser(){
        static::assertEquals(true, delete_user($this->user->getId()));
    }

    public function testListUser(){
        static::assertEquals(true, count(list_users()) > 0);
    }

    public function testUpdateUser(){
        static::assertEquals(true, update_user($this->user->getId(),'test2','test2@test2.es','test2'));
        static::assertEquals(true, get_user($this->user->getId())->getUsername() === 'test2');
    }
}


