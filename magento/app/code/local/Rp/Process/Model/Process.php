<?php
class Rp_Process_Model_Process extends Rp_Process_Model_Process_Abstract
{
	const TYPE_ID_IMPORT = 1;
    const TYPE_ID_EXPORT = 2;
    const TYPE_ID_CRON = 3;

    protected $headers = [];
    //protected $processColumn = [];
    protected $requiredFiled = [];



	public function _construct()
	{
		$this->_init('process/process');
	}

	// public function getFilePath()
	// {
	// 	return Mage::getBaseDir('media'). DS .'process' . DS . 'import';
	// }

	// public function uploadFile()
	// {
	//     $fileName = $this->getFileName();
	//     $uploader = new Varien_File_Uploader('fileName');
	//     $uploader->setAllowCreateFolders(true)
	//     ->setAllowRenameFiles(true)
	//     ->setAllowedExtensions(['CSV'])
	//     ->save($this->getFilePath(), $fileName);

	//     return $fileName;
	// }

	// public function downloadSample()
	// {
 //    	//$header = array('column_id', 'name', 'sample_value');
	// 	$columnModel = Mage::getModel('process/process_column');
	// 	$name = $this->getFileName();
	// 	$id = $this->getId();
	// 	$select = $columnModel->getCollection()
	// 							->getSelect()
	// 							->where('process_id = '. $id)
	// 							->order('name ASC');
	// 	$columns = $columnModel->getResource()->getReadConnection()->fetchAll($select);
	// 	if (!$columns) 
	// 	{
	// 		throw new Exception("Columns not found.", 1);    
	// 	}
	// 	$io = new Varien_Io_File();
	// 	$path = Mage::getBaseDir('var') . DS . 'export';
	// 	$file = $path . DS . $name;
	// 	$io->setAllowCreateFolders(true);
	// 	$io->open(array('path' => $path));
	// 	$io->streamOpen($file, 'w+');
	// 	$io->streamLock(true);
	// 	$finalColumn[] = array_column($columns, 'name');
	// 	$finalColumn[] = array_column($columns, 'sample_value');

	// 	$response = "";
	// 	foreach ($finalColumn as $row) 
	// 	{
	// 		$io->streamWriteCsv($row);
	// 		$response = $response . implode(",", $row). "\n";
	// 	}
	// 	// exit;
	// 	$io->streamUnlock();
	// 	$io->streamClose();
	// 	$csv = [
	// 		'type' => 'file_name',
	// 		'value' => $response,
	// 		'rm' => '1'
	// 	];
	// 	return $csv;
	// }

	// public function verify()
 //    {
 //        $this->readFile();
 //        $this->validateData();
 //        $this->processEntry();
 //        $this->genrateInvalidDataReport();//->saveData()Varien_File_Csv
 //        $this->genrateEntries();//->saveData()Varien_File_Csv 
       
 //        return true;          
 //    }

	// protected function readFile()
	// {
	//     $filePathName = $this->getFilePath(). DS . $this->getFileName();
	//     $handler = fopen($filePathName, "r");
	//     $headerFlag = false;
	//     $data = [];
	//     while ($row = fgetcsv($handler)) 
	//     {        
	//         if($headerFlag == false){
	//             $this->setHeaders($row);
	//             $this->validateHeaders();
	//             $headerFlag = true;
	//         }
	//         else{
	//             $data[] = array_combine($this->getHeaders(), $row);
	//         }
	//     }
	//     $this->setFiledDatas($data);
	// }

	// public function setHeaders($headers)
	// {
	//     $this->headers = $headers;
	//     return $this;
	// }

	// public function getHeaders()
	// {
	//    return $this->headers;
	// }

	// public function validateHeaders()
	// {
	// 	$requiredColumns = $this->getRequiredFiled();
	// 	// echo "<pre>";
	// 	//print_r($requiredColumns); echo "<br>";
	// 	// print_r($this->getHeaders());
	// 	$invalidHeader = array_diff($requiredColumns, $this->getHeaders());
		
	// 	if ($invalidHeader) 
	// 	{
	// 		throw new Exception("Missing Header(s): ".implode(',', $invalidHeader), 1);
	// 	}
	// 	//exit();
	
	// 	return true;
	// }

	// // protected function validateHeaders()
	// // {
	// //     try {
	// //         $processColumn = $this->getProcessColumn();
	// //        /* echo "<pre>";
	// //         print_r($processColumn[]['name']);
	// //         exit();*/
	// //         $requiredFiled = array_column($this->getRequiredFiled(),'name');
	// //         //print_r($requiredFiled);
	// //         //exit();
	// //         foreach ($requiredFiled as $key => $header) {
	// //         	//print_r($key); echo "<br>";
	// //         	print_r($processColumn->name);
	// //         	exit();
	// //             if(!array_key_exists($header,$processColumn[][''])){
	// //                 throw new Exception($header." Not in header.", 1);
	// //             }
	// //         }
	// //     } catch (Exception $e) {
	// //         Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__($e->getMessage()));
	// //     }
	// // }

	// public function getProcessColumn()
	// {
	//     $columnModel = Mage::getModel('process/process_column');
	//     $select = $columnModel->getCollection()
	//             ->getSelect()
	//             ->where('process_id = ?', $this->getProcessId());
	//     $data = $columnModel->getResource()->getReadConnection()->fetchAll($select);
	//     /*print_r($data);
	//     exit();*/
	//     return $data;
	// }

	// protected function getRequiredFiled()
	// {
	// 	$processColumns = $this->getProcessColumn();
	// 	$requiredColumns = array_map(function ($row)
	// 	{
	// 		if ($row['required'] == 1) {
	// 			return $row['name'];
	// 		}
	// 		return null;
	// 	}, $processColumns);
	// 	return array_filter($requiredColumns);
	// }

	// // public function getRequiredFiled()
	// // {
	// //     if($this->requiredFiled){
	// //         return $this->requiredFiled;
	// //     }
	// //     $columnModel = Mage::getModel('process/process_column');
	// //     $select = $columnModel->getCollection()
	// //             ->getSelect()
	// //             ->reset(Zend_Db_Select::COLUMNS)
	// //             ->columns(['name','required','casting_type'])
	// //             ->where('process_id = ?', $this->getProcessId())
	// //             ->where('required = ?', 1);
	// //     $this->requiredFiled = $columnModel->getResource()->getReadConnection()->fetchAll($select);
	// //     /*print_r($this->requiredFiled);
	// //     exit();*/
	// //     return $this->requiredFiled;
	// // }

	// protected function validateData()
 //    {
 //    try {
 //        if(!$this->getFiledDatas()){
 //            throw new Exception("No Data available in file", 1);
 //        }
 //        foreach ($this->getFiledDatas() as $key => $row) {
 //            /*print_r($row);
 //            exit();*/
 //            $valid = $this->validateRow($row);
 //           /* print_r($valid);
 //            exit();*/
 //            if(in_array('Invalid',$valid)){
 //                $this->removeFiledData($key);
 //                $this->addInvalidData($valid);
 //            }
 //            else{
 //                $this->addFiledData($valid,$key);
 //            }
 //        }
 //    } catch (Exception $e) {
 //        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__($e->getMessage()));
 //    }
 //  }

	// public function setFiledDatas($filedData)
	// {
	//     $this->filedData = $filedData;
	//     return $this;
	// }

	// public function getFiledDatas()
	// {
	//     if($this->filedData){
	//         return $this->filedData;
	//     }
	//     return null;
	// }
	// public function removeFiledData($key)
	// {
	//     if($this->filedData[$key]){
	//        unset($this->filedData[$key]);
	//     }
	//     return $this;
	// }

 //    public function addFiledData($filedData,$key)
 //    {
 //        $this->filedData[$key] = $filedData;
 //        return $this;
 //    }

	// public function addInvalidData($invalidData)
	// {
	//     $this->invalidData[] = $invalidData;
	//     return $this;
	// }

	// protected function validateRow($row)
	// {
	//     foreach ($row as $key => $value) {
	//   // 	echo '<pre>';
	// 		// print_r($key);
	//     	foreach ($key as $key1 => $value1) 
	//     	{
	// 		// print_r($value1['casting_type']);
	// 		// print_r($value1['required']);
	    		
	// 	        try 
	// 	        {
	// 	            if($key == 'Index')
	// 	            {

	// 	                continue;
	// 	            }
	// 	            //print_r($value);
		           
	// 	            $row[$key] = $this->validateRowData($value,[$value1]['casting_type'],[$value1]['required']);
	// 	        } catch (Exception $e) {
	// 	            $row[$key] = $e->getMessage();
	// 	        }
	//     	}
	//     }

 //  // print_r($row);
 //  // exit();
	//     return $row;
	// }

	// protected function validateRowData($value,$castingType,$required)
 //        {

 //            if($required == 1){
 //                if($value == ""){
 //                    throw new Exception("Invalid", 1);
 //                }
 //                if($castingType == 2){
 //                    if(!$value = (int)$value){
 //                        throw new Exception("Invalid", 1);
 //                    }
 //                    return $value;
 //                }
 //                elseif($castingType == 1){
 //                    if(!$value = (string)$value){
 //                        throw new Exception("Invalid", 1);
 //                    }
 //                    return $value;
 //                }   
 //                elseif($castingType == 3){
 //                    if(!$value = (float)$value){
 //                        throw new Exception("Invalid", 1);
 //                    }
 //                    return $value;
 //                }          
 //            }
 //            else{
 //                if($value == ""){
 //                    return $value;
 //                }
 //                if($castingType == 2){
 //                    if(!$value = (int)$value){
 //                        return '';
 //                    }
 //                    return $value;
 //                }
 //                elseif($castingType == 1){
 //                    if(!$value = (string)$value){
 //                        return '';
 //                    }
 //                    return $value;
 //                }     
 //                elseif($castingType == 3){
 //                    if(!$value = (float)$value){
 //                        return '';
 //                    }
 //                    return $value;
 //                }        
 //            }
 //        }

 //        protected function processEntry()
 //        {
 //            foreach ($this->getFiledDatas() as $key => $row) {
 //                $identifier = $this->getIdentifier($row);
 //                $row = $this->addFiledData($this->getJsonData($row),$key);
 //                $entryModel = Mage::getModel('process/process_entry');
 //                $select = $entryModel->getCollection()
 //                    ->getSelect()
 //                    ->reset(Zend_Db_Select::COLUMNS)
 //                    ->columns(['process_id'])
 //                    ->where('process_id = ?', $this->getProcessId())
 //                    ->where('identifier = ?', $identifier);
 //                $data = $entryModel->getResource()->getReadConnection()->fetchAll($select);
 //                if(!$data){
 //                    $entryModel->setData('process_id',$this->getProcessId());
 //                    $entryModel->setData('identifier',$identifier);
 //                    $entryModel->setData('start_time',date('h:s:i'));
 //                    $entryModel->setData('data',$this->getFiledData($key));
 //                    $entryModel->setData('created_date',date('Y-m-d h:s:i'));
 //                    $entryModel->save();
 //                }
 //            }
 //            return true;
 //            //data loop
 //            //call method prepareJsonData
 //            //getIdentifier method call
 //        }

 //        protected function getIdentifier($row)
 //        {
 //            return $row['type'];
 //        }

 //        protected function getJsonData($row)
 //        {
 //            return json_encode($row);
 //        }

 //         protected function genrateInvalidDataReport()
 //        {
 //            $invalid = [];
 //            $invalid[] = $this->getHeaders();
 //            $data = $this->getInvalidDatas();
 //            foreach ($data as $key => $row) {
 //                $invalid[] = $row;
 //            }
 //            $csv = new Varien_File_Csv();
 //            $csv->saveData($this->getFilePath(). DS . 'invalid.csv',$invalid);

 //        }

 //        protected function genrateEntries()
 //        {
 //            $entries = [];
 //            $entries[] = $this->getHeaders();
 //            $entryModel = Mage::getModel('process/process_entry');
 //            $select = $entryModel->getCollection()
 //            ->getSelect()
 //            ->reset(Zend_Db_Select::COLUMNS)
 //            ->columns(['data'])
 //            ->where('process_id = ?', $this->getProcessId());
 //            $data = $entryModel->getResource()->getReadConnection()->fetchAll($select);
 //            foreach ($data as $key => $row) {
 //                $entries[] = json_decode($row['data']);
 //            }
 //            $csv = new Varien_File_Csv();
 //            $csv->saveData($this->getFilePath(). DS . 'entries.csv',$entries);
 //            return $entries;
 //        }
        


}