<?php

require_once "engine/BMDie.php";

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-12-01 at 14:50:59.
 */
class BMDieTest extends PHPUnit_Framework_TestCase {

    /**
     * @var BMDie
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new BMDie;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    public function test__get() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    public function test__set() {
        // test valid sets
        $this->object->mSides = 1;
        $this->assertEquals(1, $this->object->mSides);

        $this->object->mSides = 100;
        $this->assertEquals(100, $this->object->mSides);

        // test invalid sets
        try {
            $this->object->mSides = 0;
            $this->fail('Number of sides must be positive.');
        }
        catch (InvalidArgumentException $expected) {
        }

        try {
            $this->object->mSides = -1;
            $this->fail('Number of sides must be positive.');
        }
        catch (InvalidArgumentException $expected) {
        }
    }

    public function test__toString() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

}
