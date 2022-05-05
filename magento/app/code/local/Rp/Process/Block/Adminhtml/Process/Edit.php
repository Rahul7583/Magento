<?php
class Rp_Process_Block_Adminhtml_Process_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'process';
        $this->_controller = 'adminhtml_process';
    }

    public function getHeaderText()
    {
        return "Add/Edit Form";
    }
}