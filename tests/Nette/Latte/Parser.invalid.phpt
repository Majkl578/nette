<?php

/**
 * Test: Nette\Latte\Parser::parse() - invalid macro.
 *
 * @author     Michael Moravec
 * @package    Nette\Latte
 * @subpackage UnitTests
 */

use Nette\Latte;



require __DIR__ . '/../bootstrap.php';

require __DIR__ . '/Template.inc';



$parser = new Latte\Parser();

Assert::throws(function () use ($parser) {
	$parser->parse('{var foo = \'nette}');
}, 'Nette\Latte\CompileException', 'Malformed macro declaration {%a%}.');
Assert::throws(function () use ($parser) {
	$parser->parse('{var foo = nette\'}');
}, 'Nette\Latte\CompileException', 'Malformed macro declaration {%a%}.');
Assert::throws(function () use ($parser) {
	$parser->parse('{var foo = "nette}');
}, 'Nette\Latte\CompileException', 'Malformed macro declaration {%a%}.');
Assert::throws(function () use ($parser) {
	$parser->parse('{var foo = nette"}');
}, 'Nette\Latte\CompileException', 'Malformed macro declaration {%a%}.');
