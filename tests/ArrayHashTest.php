<?php

class ArrayHashTest extends \PHPUnit_Framework_TestCase
{
    protected $record_set;

    protected function setUp()
    {
        $this->record_set = array(
            array(
                'id'         => 1,
                'first_name' => 'John',
                'last_name'  => 'Doe',
                'age'        => 30,
            ),
            array(
                'id'         => 2,
                'first_name' => 'Sally',
                'last_name'  => 'Smith',
                'age'        => 16,
            ),
            array(
                'id'         => 3,
                'first_name' => 'Jane',
                'last_name'  => 'Jones',
                'age'        => 30,
            ),
        );
    }

    public function test_firstNameColumnFromRecordSet()
    {
        $expected = array(
            'John' => array(
                'id'         => 1,
                'first_name' => 'John',
                'last_name'  => 'Doe',
                'age'        => 30,
            ),
            'Sally' => array(
                'id'         => 2,
                'first_name' => 'Sally',
                'last_name'  => 'Smith',
                'age'        => 16,
            ),
            'Jane' => array(
                'id'         => 3,
                'first_name' => 'Jane',
                'last_name'  => 'Jones',
                'age'        => 30,
            ),
        );
        $this->assertEquals($expected, array_hash($this->record_set, 'first_name'));
        $this->assertEquals(array_column($this->record_set, null, 'first_name'), array_hash($this->record_set, 'first_name'));
    }

    public function test_lastNameColumnFromRecordSet()
    {
        $expected = array(
            'Doe' => array(
                'id'         => 1,
                'first_name' => 'John',
                'last_name'  => 'Doe',
                'age'        => 30,
            ),
            'Smith' => array(
                'id'         => 2,
                'first_name' => 'Sally',
                'last_name'  => 'Smith',
                'age'        => 16,
            ),
            'Jones' => array(
                'id'         => 3,
                'first_name' => 'Jane',
                'last_name'  => 'Jones',
                'age'        => 30,
            ),
        );
        $this->assertEquals($expected, array_hash($this->record_set, 'last_name'));
        $this->assertEquals(array_column($this->record_set, null, 'last_name'), array_hash($this->record_set, 'last_name'));
    }

    public function test_ageColumnFromRecordSet()
    {
        $expected = array(
            16 => array(
                'id'         => 2,
                'first_name' => 'Sally',
                'last_name'  => 'Smith',
                'age'        => 16,
            ),
            30 => array(
                'id'         => 3,
                'first_name' => 'Jane',
                'last_name'  => 'Jones',
                'age'        => 30,
            ),
        );
        $this->assertEquals($expected, array_hash($this->record_set, 'age'));
        $this->assertEquals(array_column($this->record_set, null, 'age'), array_hash($this->record_set, 'age'));
    }

    public function test_firstNameColumnFromRecordSet2()
    {
        $expected = array(
            'John' => array(
                array(
                    'id'         => 1,
                    'first_name' => 'John',
                    'last_name'  => 'Doe',
                    'age'        => 30,
                ),
            ),
            'Sally' => array(
                array(
                    'id'         => 2,
                    'first_name' => 'Sally',
                    'last_name'  => 'Smith',
                    'age'        => 16,
                ),
            ),
            'Jane' => array(
                array(
                    'id'         => 3,
                    'first_name' => 'Jane',
                    'last_name'  => 'Jones',
                    'age'        => 30,
                ),
            ),
        );
        $this->assertEquals($expected, array_hash($this->record_set, 'first_name', true));
    }

    public function test_lastNameColumnFromRecordSet2()
    {
        $expected = array(
            'Doe' => array(
                array(
                    'id'         => 1,
                    'first_name' => 'John',
                    'last_name'  => 'Doe',
                    'age'        => 30,
                ),
            ),
            'Smith' => array(
                array(
                    'id'         => 2,
                    'first_name' => 'Sally',
                    'last_name'  => 'Smith',
                    'age'        => 16,
                ),
            ),
            'Jones' => array(
                array(
                    'id'         => 3,
                    'first_name' => 'Jane',
                    'last_name'  => 'Jones',
                    'age'        => 30,
                ),
            ),
        );
        $this->assertEquals($expected, array_hash($this->record_set, 'last_name', true));
    }

    public function test_ageColumnFromRecordSet2()
    {
        $expected = array(
            16 => array(
                array(
                    'id'         => 2,
                    'first_name' => 'Sally',
                    'last_name'  => 'Smith',
                    'age'        => 16,
                ),
            ),
            30 => array(
                array(
                    'id'         => 1,
                    'first_name' => 'John',
                    'last_name'  => 'Doe',
                    'age'        => 30,
                ),
                array(
                    'id'         => 3,
                    'first_name' => 'Jane',
                    'last_name'  => 'Jones',
                    'age'        => 30,
                ),
            ),
        );
        $this->assertEquals($expected, array_hash($this->record_set, 'age', true));
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessage array_hash() expects at least 2 parameters, 0 given
     */
    public function testFunctionWithZeroArgs()
    {
        $foo = array_hash();
    }

    public function testFunctionWithZeroArgsReturnValue()
    {
        $foo = @array_hash();
        $this->assertNull($foo);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessage array_hash() expects at least 2 parameters, 1 given
     */
    public function testFunctionWithOneArg()
    {
        $foo = array_hash(array());
    }

    public function testFunctionWithOneArgReturnValue()
    {
        $foo = @array_hash(array());
        $this->assertNull($foo);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessage array_hash() expects parameter 1 to be array, string given
     */
    public function testFunctionWithStringAsFirstArg()
    {
        $foo = array_hash('foo', 0);
    }

    public function testFunctionWithStringAsFirstArgReturnValue()
    {
        $foo = @array_hash('foo', 0);
        $this->assertNull($foo);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessage array_hash() expects parameter 1 to be array, integer given
     */
    public function testFunctionWithIntAsFirstArg()
    {
        $foo = array_hash(1, 'foo');
    }

    public function testFunctionWithIntAsFirstArgReturnValue()
    {
        $foo = @array_hash(1, 'foo');
        $this->assertNull($foo);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessage array_hash(): The index key should be either a string or an integer
     */
    public function testFunctionWithColumnKeyAsBool()
    {
        $foo = array_hash(array(), true);
    }

    public function testFunctionWithColumnKeyAsBoolReturnValue()
    {
        $foo = @array_hash(array(), true);
        $this->assertFalse($foo);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessage array_hash(): The index key should be either a string or an integer
     */
    public function testFunctionWithColumnKeyAsArray()
    {
        $foo = array_hash(array(), array());
    }

    public function testFunctionWithColumnKeyAsArrayReturnValue()
    {
        $foo = @array_hash(array(), array());
        $this->assertFalse($foo);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessage array_hash(): The recusive flag should be boolean
     */
    public function testFunctionWithIndexKeyAsBool()
    {
        $foo = array_hash(array(), 'foo', 'hoge');
    }

    public function testFunctionWithIndexKeyAsBoolReturnValue()
    {
        $foo = @array_hash(array(), 'foo', 'hoge');
        $this->assertFalse($foo);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessage array_hash(): The recusive flag should be boolean
     */
    public function testFunctionWithIndexKeyAsArray()
    {
        $foo = array_hash(array(), 'foo', 0);
    }

    public function testFunctionWithIndexKeyAsArrayReturnValue()
    {
        $foo = @array_hash(array(), 'foo', 0);
        $this->assertFalse($foo);
    }
}
