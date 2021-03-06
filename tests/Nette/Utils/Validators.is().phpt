<?php

/**
 * Test: Nette\Utils\Validators::is()
 *
 * @author     David Grudl
 * @package    Nette\Utils
 * @subpackage UnitTests
 */

use Nette\Utils\Validators;



require __DIR__ . '/../bootstrap.php';



Assert::false( Validators::is(TRUE, 'int') );
Assert::false( Validators::is('1', 'int') );
Assert::true( Validators::is(1, 'integer') );
Assert::true( Validators::is(1, 'int') );
Assert::false( Validators::is(1, 'int:)') );
Assert::false( Validators::is(1, 'int:0') );
Assert::true( Validators::is(1, 'int:1') );
Assert::true( Validators::is(0, 'int:0') );
Assert::true( Validators::is(1, 'int:..') );
Assert::false( Validators::is(1, 'int:0..0') );
Assert::true( Validators::is(1, 'int:0..1') );
Assert::true( Validators::is(1, 'int:0..') );
Assert::false( Validators::is(1, 'int:..0') );
Assert::true( Validators::is(1, 'int:..1') );
Assert::true( Validators::is(0, 'int:..0') );
Assert::true( Validators::is(-1, 'int:..0') );


Assert::false( Validators::is(TRUE, 'float') );
Assert::false( Validators::is('1', 'float') );
Assert::false( Validators::is(1, 'float') );
Assert::true( Validators::is(1.0, 'float') );


Assert::false( Validators::is(TRUE, 'number') );
Assert::false( Validators::is('1', 'number') );
Assert::true( Validators::is(1, 'number') );
Assert::true( Validators::is(1.0, 'number') );


Assert::false( Validators::is(TRUE, 'numeric') );
Assert::true( Validators::is('1', 'numeric') );
Assert::true( Validators::is('-1', 'numeric') );
Assert::true( Validators::is('-1.5', 'numeric') );
Assert::true( Validators::is('-.5', 'numeric') );
Assert::false( Validators::is('1e6', 'numeric') );
Assert::true( Validators::is(1, 'numeric') );
Assert::true( Validators::is(1.0, 'numeric') );


Assert::false( Validators::is(TRUE, 'numericint') );
Assert::true( Validators::is('1', 'numericint') );
Assert::true( Validators::is('-1', 'numericint') );
Assert::false( Validators::is('-1.5', 'numericint') );
Assert::false( Validators::is('-.5', 'numericint') );
Assert::false( Validators::is('1e6', 'numericint') );
Assert::true( Validators::is(1, 'numericint') );
Assert::false( Validators::is(1.0, 'numericint') );


Assert::false( Validators::is(1, 'bool') );
Assert::true( Validators::is(TRUE, 'bool') );
Assert::true( Validators::is(FALSE, 'bool') );
Assert::true( Validators::is(TRUE, 'boolean') );
Assert::true( Validators::is(TRUE, 'bool:1') );
Assert::false( Validators::is(TRUE, 'bool:0') );
Assert::false( Validators::is(FALSE, 'bool:1') );
Assert::true( Validators::is(FALSE, 'bool:0') );
Assert::true( Validators::is(FALSE, 'bool:0..1') );


Assert::false( Validators::is(1, 'string') );
Assert::true( Validators::is('', 'string') );
Assert::true( Validators::is('hello', 'string') );
Assert::true( Validators::is('hello', 'string:5') );
Assert::false( Validators::is('hello', 'string:4') );
Assert::true( Validators::is('hello', 'string:4..') );
Assert::false( Validators::is('hello', 'string:1..4') );


Assert::false( Validators::is(1, 'unicode') );
Assert::true( Validators::is('', 'unicode') );
Assert::true( Validators::is('hello', 'unicode') );
Assert::false( Validators::is("hello\xFF", 'unicode') );
Assert::true( Validators::is('hello', 'unicode:5') );
Assert::false( Validators::is('hello', 'unicode:4') );
Assert::true( Validators::is('hello', 'unicode:4..') );
Assert::false( Validators::is('hello', 'unicode:1..4') );


Assert::false( Validators::is(null, 'array') );
Assert::true( Validators::is(array(), 'array') );
Assert::true( Validators::is(array(), 'array:0') );
Assert::true( Validators::is(array(1), 'array:1') );
Assert::true( Validators::is(array(1), 'array:0..') );
Assert::true( Validators::is(array(), 'array:..1') );


Assert::false( Validators::is(NULL, 'list') );
Assert::true( Validators::is(array(), 'list') );
Assert::true( Validators::is(array(1), 'list') );
Assert::true( Validators::is(array('a', 'b', 'c'), 'list') );
Assert::false( Validators::is(array(4 => 1, 2, 3), 'list') );
Assert::false( Validators::is(array(1 => 'a', 0 => 'b'), 'list') );
Assert::false( Validators::is(array('key' => 'value'), 'list') );
$arr = array();
$arr[] = & $arr;
Assert::true( Validators::is($arr, 'list') );
Assert::false( Validators::is(array(1,2,3), 'list:4') );


Assert::false( Validators::is(null, 'object') );
Assert::true( Validators::is(new stdClass, 'object') );


Assert::false( Validators::is(null, 'scalar') );
Assert::false( Validators::is(array(), 'scalar') );
Assert::true( Validators::is(1, 'scalar') );


Assert::false( Validators::is(null, 'callable') );
Assert::false( Validators::is(array(), 'callable') );
Assert::false( Validators::is(1, 'callable') );
Assert::false( Validators::is('', 'callable') );
Assert::true( Validators::is('hello', 'callable') );
Assert::false( Validators::is(array('hello'), 'callable') );
Assert::true( Validators::is(array('hello', 'world'), 'callable') );


Assert::false( Validators::is(0, 'null') );
Assert::true( Validators::is(null, 'null') );


Assert::false( Validators::is('', 'email') );
Assert::false( Validators::is('hello', 'email') );
Assert::true( Validators::is('hello@world.cz', 'email') );
Assert::false( Validators::is('hello@localhost', 'email') );
Assert::false( Validators::is('hello@127.0.0.1', 'email') );
Assert::true( Validators::is('hello@l.org', 'email') );
Assert::true( Validators::is('hello@1.org', 'email') );


Assert::false( Validators::is('', 'url') );
Assert::false( Validators::is('hello', 'url') );
Assert::false( Validators::is('nette.org', 'url') );
Assert::true( Validators::is('http://1.org', 'url') );
Assert::true( Validators::is('http://l.org', 'url') );
Assert::true( Validators::is('http://localhost', 'url') );
Assert::true( Validators::is('http://127.0.0.1', 'url') );
Assert::true( Validators::is('http://nette.org/path', 'url') );
Assert::true( Validators::is('http://nette.org:8080/path', 'url') );
Assert::true( Validators::is('https://www.nette.org/path', 'url') );


Assert::true( Validators::is(0, 'none') );
Assert::true( Validators::is('', 'none') );
Assert::true( Validators::is(NULL, 'none') );
Assert::true( Validators::is(FALSE, 'none') );
Assert::false( Validators::is('0', 'none') );
Assert::true( Validators::is(array(), 'none') );


Assert::true( Validators::is('', 'pattern') );
Assert::true( Validators::is('  123', 'pattern:\s+\d+') );
Assert::false( Validators::is('  123x', 'pattern:\s+\d+') );


Assert::false( Validators::is('', 'alnum') );
Assert::false( Validators::is('a-1', 'alnum') );
Assert::true( Validators::is('a1', 'alnum') );
Assert::true( Validators::is('a1', 'alnum:2') );


Assert::false( Validators::is('', 'alpha') );
Assert::false( Validators::is('a1', 'alpha') );
Assert::true( Validators::is('aA', 'alpha') );
Assert::true( Validators::is('aA', 'alpha:1..3') );


Assert::false( Validators::is('', 'digit') );
Assert::false( Validators::is('123x', 'digit') );
Assert::true( Validators::is('123', 'digit') );
Assert::false( Validators::is('123', 'digit:..2') );


Assert::false( Validators::is('', 'lower') );
Assert::false( Validators::is('Hello', 'lower') );
Assert::true( Validators::is('hello', 'lower') );
Assert::false( Validators::is('hello', 'lower:9') );


Assert::false( Validators::is('', 'upper') );
Assert::false( Validators::is('Hello', 'upper') );
Assert::true( Validators::is('HELLO', 'upper') );


Assert::false( Validators::is('', 'space') );
Assert::false( Validators::is(' 1', 'space') );
Assert::true( Validators::is(" \t\r\n", 'space') );


Assert::false( Validators::is('', 'xdigit') );
Assert::false( Validators::is('123x', 'xdigit') );
Assert::true( Validators::is('123aA', 'xdigit') );


Assert::true( Validators::is(1.0, 'int|float') );
Assert::true( Validators::is(1, 'int|float') );
Assert::false( Validators::is('1', 'int|float') );
