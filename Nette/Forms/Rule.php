<?php

/**
 * Nette Framework
 *
 * @copyright  Copyright (c) 2004, 2010 David Grudl
 * @license    http://nette.org/license  Nette license
 * @link       http://nette.org
 * @category   Nette
 * @package    Nette\Forms
 */

namespace Nette\Forms;

use Nette;



/**
 * Single validation rule or condition represented as value object.
 *
 * @copyright  Copyright (c) 2004, 2010 David Grudl
 * @package    Nette\Forms
 */
final class Rule extends Nette\Object
{
	/** type */
	const CONDITION = 1;

	/** type */
	const VALIDATOR = 2;

	/** type */
	const FILTER = 3;

	/** type */
	const TERMINATOR = 4;

	/** @var IFormControl */
	public $control;

	/** @var mixed */
	public $operation;

	/** @var mixed */
	public $arg;

	/** @var int (CONDITION, VALIDATOR, FILTER) */
	public $type;

	/** @var bool */
	public $isNegative = FALSE;

	/** @var string (only for VALIDATOR type) */
	public $message;

	/** @var bool (only for VALIDATOR type) */
	public $breakOnFailure = TRUE;

	/** @var Rules (only for CONDITION type)  */
	public $subRules;
	
	/****** single rule validation *****/
	/** @var Rules */
	public $parent;

	/** @var int */
	private static $globalIndex = 0;

	/** @var array */
	private static $list = array();

	/** @var int */
	private $index;

	public function __construct()
	{
		$this->index = ++self::$globalIndex;
		self::$list[$this->index] = $this;
	}

	/**
	 * Get rule's index
	 * @return int
	 */
	public function getIndex()
	{
		return $this->index;
	}

	/**
	 * Get a rule by its id in Rule::$list
	 * @param int $id
	 * @return Rule
	 */
	public static function getRule($id)
	{
		return isset(self::$list[$id]) ? self::$list[$id] : NULL;
	}
}
