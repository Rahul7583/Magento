<?php
class Rp_Category_Adminhtml_CategoryController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->loadLayout();
		$this->getLayout()->getBlock('content')
            ->append($this->getLayout()->createBlock('category/adminhtml_category_index', 'categoryIndex'));
        $this->renderLayout();
	}

	public function newAction()
	{
		$this->_forward('edit');
	}

	public function editAction()
    {
       $this->loadLayout();

        $id =  $this->getRequest()->getParam('id');   //echo $id; exit();
        $model = Mage::getModel('category/category');

        if ($id) 
        {
            $model->load($id);                   //print_r($model);    exit();
            if(!$model->getId()) 
            {
                $this->_redirect('*/*/index');
                return;
            }
        }

        $this->_title($model->getId() ? $this->__('Edit category') : $this->__('New category'));
        Mage::register('current_category', $model);

        $this->getLayout()->getBlock('content')->append($this->getLayout()->createBlock('category/adminhtml_category_edit', 'categoryEdit'));
        $this->renderLayout();
    }  

    public function saveAction()
	{
		$formData = $this->getRequest()->getPost();
		unset($formData['form_key']);
		$name = $this->getRequest()->getPost('name');
		$id = $this->getRequest()->getParam('id');
		$categoryModel = Mage::getModel('category/category');
		$setData = $categoryModel->setData($formData);
		

		if(!$id)
		{
				$setData->createdAt = date("Y-m-d H:m:s");
				$insert = $categoryModel->save();
				$insertId= $insert['category_id'];
				
				$categoryPath = $categoryModel->load($formData['parentId']);
				$newPath = NULL;
				if($categoryPath->parentId)
				{
					$newPath = $categoryPath->path.'/'.$insertId;
				}
				else
				{
					$newPath = $insertId;
				}
				
				$updatePath = $categoryModel->load($insertId);
			
				$updatePath->parentId = $insertId;

				$updatePath->path = $newPath;
				$updatePath->save();
		}
		else{
				if(!empty($id))
                {
                    $setData->category_id = $id;
                    $setData->updatedAt = date('y-m-d h:m:s');
                    if(!$formData['parentId'])
                    {
                        $setData->parentId = NULL;
                    }
                    else
                    {
                    	$setData->parentId = $formData['parentId'];	
                    }
                    unset($setData['parent_id']);
                   
                    $result = $categoryModel->save();
                    if(!$result)
                    {
                        throw new Exception("Sysetm is unable to save your data");   
                    }
                    $allPath = $categoryModel->getResource()->getReadConnection()->fetchAll("SELECT * FROM `category` WHERE `path` LIKE '%$id%' ");
                    
                    foreach ($allPath as $path) 
                    {
                        $finalPath = explode('/',$path['path']);
                        foreach ($finalPath as $subPath) 
                        {
                            if($subPath == $id)
                            {
                                if(count($finalPath) != 1)
                                {
                                    array_shift($finalPath);
                                }    
                                break;
                            }
                            array_shift($finalPath);
                        }
                        if($path['parentId'])
                        {
                            $parentPath = $categoryModel->load($path['parentId']);
                            $path['path'] = $parentPath->path ."/".implode('/',$finalPath);
                        }
                        else
                        {
                            $path['path'] = $path['category_id'];
                        }
                        $savePath = Mage::getModel('category/category');
                        $savePath->setData($path);
                        $result = $savePath->save();
                    }
                }
			}
            $this->_redirect('*/*/');

	}

public function massDeleteAction() 
    {
            $sampleIds = $this->getRequest()->getParam('category');
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
                        $sample = Mage::getModel('category/category')->load($sampleId);
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
                $this->_redirect('category/adminhtml_category/index');
    }

	
 	public function deleteAction()
    {
        $categoryModel = Mage::getModel('category/category');
        $id = (int)$this->getRequest()->getParam('id');
        $allPath = $categoryModel->getResource()->getReadConnection()->fetchAll("SELECT * FROM `category` WHERE `path` LIKE '%$id%' ");

        foreach($allPath as $categories)
        {
            $delete = $categoryModel->setId($categories['category_id'])->delete();
        }
        $this->_redirect('*/*/');
    }		
}