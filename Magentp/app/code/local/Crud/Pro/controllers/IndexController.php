<?php
class Crud_Pro_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {       
        $this->loadLayout();     
        $this->renderLayout(); 
    }
    public function saveAction()
    {
        $data = $this->getRequest()->getPost();
        //print_r($_FILES['filename']['name']);  // Here Name of Image if we want to change type of image so put name palace to type
        //exit;
        $filename = date("dmYhisa").".jpg";
        $contact = Mage::getModel('pro/pro');
        if(isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != '')
        {
            $path = Mage::getBaseDir('media') . DS. 'test' ;
            move_uploaded_file($_FILES["filename"]["tmp_name"],$path."/". $filename);
            $contact->setData('filename',$filename);
        }
        $name = $this->getRequest()->getPost('name');  // Data post from database using getPost() function
        $email = $this->getRequest()->getPost('email');
        $rollno = $this->getRequest()->getPost('rollno');
        $gender = $this->getRequest()->getPost('gender');
        $status = $this->getRequest()->getPost('status');
        $contact->setData('stdname',$name);
        $contact->setData('email',$email);
        $contact->setData('rollno',$rollno);
        $contact->setData('gender',$gender);
        $contact->setData('status',$status);
        $contact->save();       
        $this->_redirect('pro/index/index');
    }
    public function deletedataAction()
    {
            $id     = $this->getRequest()->getParam('id');
            $model2  = Mage::getModel('pro/pro')->load($id);
            $model2->delete();
                $this->_redirect('*/*/');
    }
    public function editDataAction()
    {
        $this->loadLayout();        
        $this->renderLayout();
    }   
    public function editAction()
    {
        $id     = $this->getRequest()->getParam('id');      
        $model  = Mage::getModel('pro/pro')->load($id);
        $data = $this->getRequest()->getPost();  // Get date and set data from from of registration
        $filename = date("dmYhisa").".jpg";
        $contact = Mage::getModel('pro/pro');
        if(isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != '')
        {
            $path = Mage::getBaseDir('media') . DS. 'test' ;
            move_uploaded_file($_FILES["filename"]["tmp_name"],$path."/". $filename);
            $model->setData('filename',$filename);
        }
        $model->setData('stdname',$data['name']);
        $model->setData('email',$data['Email']);
        $model->setData('rollno',$data['Roll']);
        $model->setData('gender',$data['gender']);
        $model->setData('status',$data['status']);
        $model->save();
        $this->_redirect('*/*/');   
    }   
}