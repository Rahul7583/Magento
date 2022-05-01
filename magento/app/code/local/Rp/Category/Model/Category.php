<?php 
class Rp_Category_Model_Category extends Mage_Core_Model_Abstract
{
	public function _construct()
	{
		$this->_init('category/category');
	}

	public function getPath()
	{
		$path = $this->path;
		$value = explode('/',$path);

		foreach ($value as $path1) {
			$query = $this->getCollection()->getSelect()->where('category_id = ?', $path1);
			$parentName = $this->getResource()->getReadConnection()->fetchAll($query);

			if($path1 != $this->category_id)
			{
				$finalPath .= $parentName[0]['name']. "=>";		
			}
			else
			{
				$finalPath .= $parentName[0]['name'];
			}	
		}
		return $finalPath;
	}
}