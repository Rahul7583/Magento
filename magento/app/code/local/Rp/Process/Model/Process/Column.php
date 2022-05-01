<?php
class Rp_Process_Model_Process_Column extends Mage_Core_Model_Abstract
{
	const REQUIRED_YES = 1;
    const REQUIRED_NO = 2;

    const CASTING_TYPE_VARCHAR = 1;
    const CASTING_TYPE_INT = 2;
    const CASTING_TYPE_DECIMAL = 3;

    const EXCEPTION_YES = 1;
    const EXCEPTION_NO = 2;

	public function _construct()
	{
		$this->_init('process/process_column');
	}
}