<?php
/**
 * Object used for caching the results of select queries.  See [Results](/database/results#select-cached) for usage and examples.
 *
 * @package    KO7/Database
 * @category   Query/Result
 *
 * @copyright  (c) 2007-2016  Kohana Team
 * @copyright  (c) since 2016 Koseven Team
 * @license    https://koseven.dev/LICENSE
 */
class KO7_Database_Result_Cached extends Database_Result {

	public function __construct(array $result, $sql, $as_object = NULL)
	{
		parent::__construct($result, $sql, $as_object);

		// Find the number of rows in the result
		$this->_total_rows = count($result);
	}

	public function __destruct()
	{
		// Cached results do not use resources
	}

	public function cached()
	{
		return $this;
	}

	public function seek(int $offset): void
	{
		if ($this->offsetExists($offset))
			$this->_current_row = $offset;
	}

	public function current(): mixed
	{
		// Return an array of the row
		return $this->valid() ? $this->_result[$this->_current_row] : NULL;
	}

} // End Database_Result_Cached
