<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 * Copyright (c) 2004 David Grudl (http://davidgrudl.com)
 */

namespace Nette\Forms\Controls;

use Nette;


/**
 * Choice control that allows single item selection.
 *
 * @author     David Grudl
 *
 * @property   array $items
 * @property-read mixed $selectedItem
 * @property-read mixed $rawValue
 */
abstract class ChoiceControl extends BaseControl
{
	/** @var array */
	private $items = array();


	public function __construct($label = NULL, array $items = NULL)
	{
		parent::__construct($label);
		if ($items !== NULL) {
			$this->setItems($items);
		}
	}


	/**
	 * Loads HTTP data.
	 * @return void
	 */
	public function loadHttpData()
	{
		$this->value = $this->getHttpData(Nette\Forms\Form::DATA_TEXT);
		if ($this->value !== NULL) {
			if (is_array($this->disabled) && isset($this->disabled[$this->value])) {
				$this->value = NULL;
			} else {
				$tmp = array($this->value => NULL); // HHVM bug #1366
				$this->value = key($tmp);
			}
		}
	}


	/**
	 * Sets selected item (by key).
	 * @param  scalar
	 * @return self
	 */
	public function setValue($value)
	{
		if ($value !== NULL && !isset($this->items[(string) $value])) {
			throw new Nette\InvalidArgumentException("Value '$value' is out of allowed range in field '{$this->name}'.");
		}
		$tmp = array((string) $value => NULL); // HHVM bug #1366
		$this->value = $value === NULL ? NULL : key($tmp);
		return $this;
	}


	/**
	 * Returns selected key.
	 * @return scalar
	 */
	public function getValue()
	{
		return isset($this->items[$this->value]) ? $this->value : NULL;
	}


	/**
	 * Returns selected key (not checked).
	 * @return scalar
	 */
	public function getRawValue()
	{
		return $this->value;
	}


	/**
	 * Is any item selected?
	 * @return bool
	 */
	public function isFilled()
	{
		return $this->getValue() !== NULL;
	}


	/**
	 * Sets items from which to choose.
	 * @param  array
	 * @param  bool
	 * @return self
	 */
	public function setItems(array $items, $useKeys = TRUE)
	{
		$this->items = Nette\Forms\Helpers::prepareChoiceItems($items, $useKeys);
		return $this;
	}


	/**
	 * Returns items from which to choose.
	 * @return array
	 */
	public function getItems()
	{
		return $this->items;
	}


	/**
	 * Returns selected value.
	 * @return mixed
	 */
	public function getSelectedItem()
	{
		$value = $this->getValue();
		return $value === NULL ? NULL : $this->items[$value];
	}


	/**
	 * Disables or enables control or items.
	 * @param  bool|array
	 * @return self
	 */
	public function setDisabled($value = TRUE)
	{
		if (!is_array($value)) {
			return parent::setDisabled($value);
		}

		parent::setDisabled(FALSE);
		$this->disabled = array_fill_keys($value, TRUE);
		if (isset($this->disabled[$this->value])) {
			$this->value = NULL;
		}
		return $this;
	}

}
