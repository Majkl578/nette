<?php

/**
 * Test: Nette\Utils\Strings and RegexpException compile error.
 *
 * @author     David Grudl
 */

use Nette\Utils\Strings,
	Tester\Assert;


require __DIR__ . '/../bootstrap.php';


Assert::exception(function() {
	Strings::split('0123456789', '#*#');
}, 'Nette\Utils\RegexpException', '%a?%Compilation failed: nothing to repeat at offset 0 in pattern: #*#');

Assert::exception(function() {
	Strings::match('0123456789', '#*#');
}, 'Nette\Utils\RegexpException', '%a?%Compilation failed: nothing to repeat at offset 0 in pattern: #*#');

Assert::exception(function() {
	Strings::matchAll('0123456789', '#*#');
}, 'Nette\Utils\RegexpException', '%a?%Compilation failed: nothing to repeat at offset 0 in pattern: #*#');

Assert::exception(function() {
	Strings::replace('0123456789', '#*#', 'x');
}, 'Nette\Utils\RegexpException', '%a?%Compilation failed: nothing to repeat at offset 0 in pattern: #*#');

Assert::exception(function() {
	Strings::replace('0123456789', array('##', '#*#'), 'x');
}, 'Nette\Utils\RegexpException', '%a?%Compilation failed: nothing to repeat at offset 0 in pattern: ## or #*#');

function cb() { return 'x'; }

Assert::exception(function() {
	Strings::replace('0123456789', '#*#', Nette\Utils\Callback::closure('cb'));
}, 'Nette\Utils\RegexpException', '%a?%Compilation failed: nothing to repeat at offset 0 in pattern: #*#');

Assert::exception(function() {
	Strings::replace('0123456789', array('##', '#*#'), Nette\Utils\Callback::closure('cb'));
}, 'Nette\Utils\RegexpException', '%a?%Compilation failed: nothing to repeat at offset 0 in pattern: #*#');
