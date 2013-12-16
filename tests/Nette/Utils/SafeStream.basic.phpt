<?php

/**
 * Test: Nette\Utils\SafeStream basic usage.
 *
 * @author     David Grudl
 */

require __DIR__ . '/../bootstrap.php';


if (defined('HHVM_VERSION')) {
	Tester\Assert::fail('HHVM and SafeStream are not friends yet.');
}


Nette\Utils\SafeStream::register();

// actually it creates temporary file
$handle = fopen('safe://myfile.txt', 'x');
fwrite($handle, 'atomic and safe');
// and now rename it
fclose($handle);

// removes file thread-safe way
unlink('safe://myfile.txt');

// this is not thread safe - don't relay on returned value
$ok = is_file('safe://SafeStream.php');
