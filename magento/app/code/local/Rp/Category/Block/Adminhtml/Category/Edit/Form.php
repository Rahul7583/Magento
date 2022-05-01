<?php
class Rp_Category_Block_Adminhtml_Category_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('current_category');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array(
                'id' => $this->getRequest()->getParam('id')
            )),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $this->setForm($form);

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('category')->__('General Information'), 'class' => 'fieldset-wide'));

         $fieldset->addField('parentId', 'select', array(
            'name'      => 'parentId',
            'label'     => Mage::helper('category')->__('Select Parent'),
            'values' => $this->selectDropDown(),
        ));

       $fieldset->addField('name', 'text', array(
            'name' => 'name',
            'label' => Mage::helper('category')->__('Name'),
            'required' => true,
        ));

        $fieldset->addField('status', 'select', array(
         'label' => Mage::helper('category')->__('Status'),
         'name' => 'status',
         'values' => array(
                         array(
                         'value' => 1,
                         'label' => Mage::helper('category')->__('Enable'),
                         ),

                        array(
                         'value' => 0,
                         'label' => Mage::helper('category')->__('Disabled'),
                         ),
                    ),
        ));

       
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        return parent::_prepareForm();
    }

     public function selectDropDown()
    {
        $id = $this->getRequest()->getParam('id');
        $categoryModel = Mage::getModel('category/category');
        $categoryValues = $categoryModel->getCollection()->getItems();
        $finalarray = [];
        $finalarray['root'] = array('value'=>0 ,'label'=>'Root Category');
        if($id)
        {

            $allPath = $categoryModel->getResource()->getReadConnection()->fetchAll("SELECT * FROM `category` WHERE `path` NOT LIKE '%$id%' ");
        }
        else
        {

            $allPath = $categoryModel->getResource()->getReadConnection()->fetchAll("SELECT * FROM `category` ORDER BY `path`");
        }
        foreach ($categoryValues as $category) 
        {
            foreach ($allPath as $data)
            {
                if($category['category_id'] == $data['category_id'])
                {
                    $category_id = $category['category_id'];
                    $path = $category->getPath();
                    $dropDownValues = array('value'=>$category_id ,'label'=>$path);
                    $finalarray[$category_id] = $dropDownValues;
                }
            }     
        }
         return $finalarray;
    }


}
