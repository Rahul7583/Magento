<?php 
class Rp_Process_Adminhtml_UploadController extends Mage_Adminhtml_Controller_Action
{
	
	public function uploadfileAction()
	{
		$processId = $this->getRequest()->getParam('id');
		Mage::getSingleton('cms/wysiwyg_config')->setStoreId($this->getRequest()->getParam('store'));

		$process = Mage::getModel('process/process')
		->setStoreId($this->getRequest()->getParam('store', 0))
		->load($processId);

		Mage::register('current_process_media', $process);

		if (!$processId) 
		{
			$this->_getSession()->addError(Mage::helper('process')->__('This process no longer exists'));
			$this->_redirect('*/*/');
			return;
		}
		$this->loadLayout();
		$this->renderLayout();
	}

	public function uploadAction()
	{
		$processId = $this->getRequest()->getParam('id');
		$model = Mage::getModel('process/process');
		if($model->load($processId)){
			$fileName = $model->uploadFile();
		}
		if($fileName){
			$model->setData('file_name',$fileName);
			$model->save();          
		}
		$this->_redirect('process/adminhtml_process/index');
	}

	public function exportAction()
    {
        try 
        {
            $id = $this->getRequest()->getParam('id');
            $model = Mage::getModel('process/process')->load($id);
            $csv = $model->downloadSample()['value'];

            $this->_prepareDownloadResponse($model->getFileName(), $csv);
            $this->_getSession()->addSuccess($this->__("File Downloaded."));
        }
        catch (Exception $e) 
        {
           $this->_getSession()->addError(Mage::helper('process')->__($e->getMessage()));  
        }
    }

    public function verifyAction()
    {
        try {
            $Id = $this->getRequest()->getParam('id');
            $process = Mage::getModel('process/process');
            if ($process->load($Id)) {
                $model = Mage::getModel($process->getRequestModel());
                $filename = $model->setProcess($process)->verify();
            }
            $this->_getSession()->addSuccess(Mage::helper('process')->__("File Verified successfully."));
        }
        catch (Exception $e) {
            $this->_getSession()->addError(Mage::helper('process')->__($e->getMessage()));
        }
        $this->_redirect('process/adminhtml_process/index');
    }

    public function executeAction()
    {
    	$this->loadLayout();
    	try 
    	{
    		$processId = $this->getRequest()->getParam('id');
    		$processModel = Mage::getModel('process/process')->load($processId);
    		if(!$processModel)
    		{
    			throw new Exception("Process Not Found.", 1);
    		}
    		$this->_prepareProcessEntryVariables($processModel);
    		 
    	} catch (Exception $e) {
    		Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
    		$this->_redirect('process/adminhtml_process/index');

    	}
    	$this->renderLayout();
    }

    protected function _prepareProcessEntryVariables($processModel)
    {
    	$processId = $this->getRequest()->getParam('id');
        $processModel = Mage::getModel('process/process')->load($processId);
    	$sessionVariables = [
    			'processId' =>$processModel,
    			'totalCount' => 0,
    			'perRequestCount' => 0, 
    			'totalRequest' => 0,
    			'currentRequest' =>0,
    	];

    	$processEntryModel = Mage::getModel('process/process_Entry');
    	$select = $processEntryModel->getCollection()
                    ->getSelect()
                    ->reset(Zend_Db_Select::COLUMNS)
                    ->columns(['count(entry_id)'])
                    ->where('process_id = ?', $processModel->getData('process_id'))
                    ->where('start_time IS NULL');
        
        $entryData = $processEntryModel->getResource()->getReadConnection()->fetchOne($select);
        $sessionVariables['totalCount'] = $entryData;
        $sessionVariables['perRequestCount'] = $processModel->getData('per_request_count');
        $sessionVariables['totalRequest'] = ceil($sessionVariables['totalCount'] / $sessionVariables['perRequestCount']);
        $sessionVariables['currentRequest'] = 1;
        Mage::getSingleton('core/session')->setProcessEntryVariables($sessionVariables);
    }

    public function processEntryAction()
    {
    	try 
    	{
    		$sessionVariables = Mage::getSingleton('core/session')->getProcessEntryVariables();
    		if($sessionVariables['currentRequest'] > $sessionVariables['totalRequest'])
    		{
    			throw new Exception("No Request Found.", 1);
    		}	
    		$processModel = $sessionVariables['processId'];
            if(!$processModel)
            {
             throw new Exception("No Process Found", 1);
            }
            $requestModel = Mage::getModel($processModel->getData('request_model'));
            if(!$requestModel)
            {
                throw new Exception("Request model not found", 1);
            }
            $requestModel->execute();

   			$reload = false;
    		if($sessionVariables['currentRequest']  == $sessionVariables['totalRequest'])
    		{
    			$reload = true;	
    		}
			$sessionVariables['currentRequest'] += 1;
			Mage::getSingleton('core/session')->setProcessEntryVariables($sessionVariables);
			sleep(1);
    		$response = [
            'status' => 'success',
            'reload' => $reload,
            'sessionVariables' => $sessionVariables,
            'message' => "Processing :".($sessionVariables['currentRequest'] - 1). "/" .($sessionVariables['totalRequest'])
	        ];
	        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
	    } 
	    catch (Exception $e) 
    	{
    		Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
    		$this->_redirect('process/adminhtml_process/index');	
    	}  	

    }
}	