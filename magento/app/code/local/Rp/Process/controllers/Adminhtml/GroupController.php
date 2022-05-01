<?php 
class Rp_Process_Adminhtml_GroupController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->loadLayout();
		$this->getLayout()->getBlock('content')->append(
			$this->getLayout()->createBlock('process/adminhtml_group_index', 'groupIndex')
		);
		$this->renderLayout();
	}
	
	public function editAction()
    {
       $this->loadLayout();

        $id =  $this->getRequest()->getParam('id');   
        $model = Mage::getModel('process/process_group');

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
        Mage::register('current_group', $model);
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
               $model = Mage::getModel('process/process_group');
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
               Mage::getModel('process/process_group')->load($id)->delete();
           } 
           catch (Exception $e) 
           {
               $this->_redirect('*/*/edit', array('id' => $id));
           }
       }
       $this->_redirect('*/*/index');
   }


}
