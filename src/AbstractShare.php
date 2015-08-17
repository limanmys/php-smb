<?php
/**
 * Copyright (c) 2015 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Licensed under the MIT license:
 * http://opensource.org/licenses/MIT
 */

namespace Icewind\SMB;

use Icewind\SMB\Exception\InvalidPathException;

abstract class AbstractShare implements IShare {
	private $forbiddenCharacters;

	public function __construct() {
		$this->forbiddenCharacters = array('?', '<', '>', ':', '*', '|', '"', chr(0), "\n");
	}

	protected function verifyPath($path) {
		foreach ($this->forbiddenCharacters as $char) {
			if (strpos($path, $char) !== false) {
				throw new InvalidPathException('Invalid path, "' . $char . '" is not allowed');
			}
		}
	}
}