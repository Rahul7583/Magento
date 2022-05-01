<?php

class Rp_Process_Block_Adminhtml_Group_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{

    protected function _construct()
    {
        // code...
        $this->_blockGroup = 'process';
        $this->_controller = 'adminhtml_group';
    }

   public function getHeaderText()
    {
        $model = Mage::registry('current_group');
        if ($model->getId()) 
        {
            return Mage::helper('process')->__("Edit Group");
        } 
        else 
        {
            return Mage::helper('process')->__("Add new Group");
        }
    }
}    

