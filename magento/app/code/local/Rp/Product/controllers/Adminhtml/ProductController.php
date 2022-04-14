<?php 
class Rp_Product_Adminhtml_ProductController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->loadLayout();
		$this->getLayout()->getBlock('content')->append(
			$this->getLayout()->createBlock('product/adminhtml_product_index', 'productIndex')
		);
		$this->renderLayout();
	}

	public function editAction()
    {
       $this->loadLayout();

        $id =  $this->getRequest()->getParam('id');   //echo $id; exit();
        $model = Mage::getModel('product/product');

        if ($id) 
        {
            $model->load($id);                   //print_r($model);    exit();
            if(!$model->getId()) 
            {
                $this->_redirect('*/*/index');
                return;
            }
        }

        $this->_title($model->getId() ? $this->__('Edit product') : $this->__('New product'));
        Mage::register('current_product', $model);

        $this->getLayout()->getBlock('content')->append($this->getLayout()->createBlock('product/adminhtml_product_edit', 'productEdit'));
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
               $model = Mage::getModel('product/product');
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
            $sampleIds = $this->getRequest()->getParam('product');
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
                        $sample = Mage::getModel('product/product')->load($sampleId);
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
                $this->_redirect('product/adminhtml_product/index');
    }
}