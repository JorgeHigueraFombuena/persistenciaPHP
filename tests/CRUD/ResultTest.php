<?php   // tests/Entity/UserTest.php

namespace MiW16\Results\Tests\CRUD;

use MiW16\Results\Entity\Result;
use MiW16\Results\Entity\User;
use PHPUnit_Framework_Error_Notice;
use PHPUnit_Framework_Error_Warning;

require_once __DIR__ . '/../../src/scripts/web/model/result_functions.php';

class ResultTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Result */
    private $result;

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

        create_result($this->user->getId(),10,'2016-12-20');
        $results = get_all_results();
        /** @var Result $result */
        foreach ($results as $result) {
            if ($result->getUser()->getUsername() === 'test'){
                $this->result = $result;
                break;
            }
        }
    }

    protected function tearDown()
    {
        parent::tearDown();

        delete_result($this->result->getId());
        delete_user($this->user->getId());
    }


    public function testCreateResult()
    {
        self::assertEquals(true, create_result($this->user->getId(),5,'2016-05-10'));
        $results = get_all_results();
        /** @var Result $result */
        foreach ($results as $result) {
            if ($result->getUser()->getUsername() === 'test' && $result->getResult() === 5){
                delete_result($result->getId());
                break;
            }
        }
    }


    public function testGetResult()
    {
        static::assertEquals($this->result->getId(), get_result($this->result->getId())->getId());
    }

    public function testDeleteResult(){
        static::assertEquals(true, delete_result($this->result->getId()));
    }

    public function testListResult(){
        static::assertEquals(true, count(get_all_results()) > 0);
    }

    public function testUpdateResult(){
        static::assertEquals(true, update_result($this->result->getId(),$this->user->getId(),2,'2016-03-14'));
        static::assertEquals(true, get_result($this->result->getId())->getResult() === 2);
    }
}


