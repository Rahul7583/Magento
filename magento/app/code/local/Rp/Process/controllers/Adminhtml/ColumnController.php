<?php 
class Rp_Process_Adminhtml_ColumnController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->loadLayout();
		$this->renderLayout();
	}
	
	public function editAction()
    {
       $this->loadLayout();

        $id =  $this->getRequest()->getParam('id');   
        $model = Mage::getModel('process/process_column');

        if ($id) 
        {
            $model->load($id);                   
            if(!$model->getId()) 
            {
                $this->_redirect('*/*/index');
                return;
            }
        }

        $this->_title($model->getId() ? $this->__('Edit process') : $this->__('New process'));
        Mage::register('current_column', $model);
        $this->renderLayout();
    }  

    public function newAction()
   	{
        $this->_forward('edit');
   	}

   	 public function saveAction()
    {
    	// code...
    	if ($data = $this->getRequest()->getPost()) 
    	{
           try 
           {
               $model = Mage::getModel('process/process_column');
               $model->setData($data)->setId($this->getRequest()->getParam('id'));
               
               $model->save();
               $id = $model->getId();
              
              $this->_redirect('*/*/index');
           } 
           catch (Exception $e) 
           {
               $this->_redirect('*/*/edit', array(
                   'id' => $this->getRequest()->getParam('id')
               ));
           }
           return;
        }
    }

     public function deleteAction()
   {
       if($id = $this->getRequest()->getParam('id')) 
       {
           try 
           {
               Mage::getModel('process/process_column')->load($id)->delete();
           } 
           catch (Exception $e) 
           {
               $this->_redirect('*/*/edit', array('id' => $id));
           }
       }
       $this->_redirect('*/*/index');
   }

  /* public function massDeleteAction() 
    {
            $sampleIds = $this->getRequest()->getParam('column');
             if(!is_array($sampleIds))
            {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
            } 
            else 
            {
                try
                {
                    foreach ($sampleIds as $sampleId)
                    {
                        $sample = Mage::getModel('column/process_column')->load($sampleId);
                        $sample->delete();

                    }
                    Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were successfully deleted', count($sampleIds)));
                } 
                catch (Exception $e)
                {
                        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                }
            }
                $this->_redirect('column/adminhtml_column/index');
    }*/
}
