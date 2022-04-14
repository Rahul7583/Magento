<?php 
class Rp_Salesman_Adminhtml_SalesmanController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->loadLayout();
		$this->getLayout()->getBlock('content')->append(
			$this->getLayout()->createBlock('salesman/adminhtml_salesman_index', 'salesmanIndex')
		);
		$this->renderLayout();
	}

	public function editAction()
    {
       $this->loadLayout();

        $id =  $this->getRequest()->getParam('id');   
        $model = Mage::getModel('salesman/salesman');

        if ($id) 
        {
            $model->load($id);                  
            if(!$model->getId()) 
            {
                $this->_redirect('*/*/index');
                return;
            }
        }

        $this->_title($model->getId() ? $this->__('Edit salesman') : $this->__('New salesman'));
        Mage::register('current_salesman', $model);

        $this->getLayout()->getBlock('content')->append($this->getLayout()->createBlock('salesman/adminhtml_salesman_edit', 'salesmanEdit'));
        $this->renderLayout();
    }  

    public function newAction()
   	{
        $this->_forward('edit');
   	}


     public function saveAction()
    {
  
    	if ($data = $this->getRequest()->getPost()) 
    	{
           try 
           {
               $model = Mage::getModel('salesman/salesman');
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

 
 public function massDeleteAction() 
    {
            $sampleIds = $this->getRequest()->getParam('salesman');
         /*   print_r($sampleIds);
            exit();*/
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
                        $sample = Mage::getModel('salesman/salesman')->load($sampleId);
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
                $this->_redirect('salesman/adminhtml_salesman/index');
    }
}