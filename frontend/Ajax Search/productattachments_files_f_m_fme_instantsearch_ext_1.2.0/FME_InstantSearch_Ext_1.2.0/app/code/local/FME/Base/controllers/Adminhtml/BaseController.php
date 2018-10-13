<?php

/**
* 
*/
class FME_Base_Adminhtml_BaseController extends Mage_Adminhtml_Controller_Action
{
	
	public function sendAction()
	{
		$data = $this->getRequest()->getPost();
		$to='support@fmeextensions.com';
		$toName='FME Support';
		$from = $data['email'];
		$fromName = $data['name'];
		$subject= "FME Base Module - ".$data['subject'];
		$telephone=$data['telephone'];
		$extension = $data['extension'];
		$message= $data['message'];
		$emailTemplate  = Mage::getModel('core/email_template')
                        ->loadDefault('fme_Support_email');
                                    
		$emailTemplateVariables = array();
		$emailTemplateVariables['toName'] = $toName;
		$emailTemplateVariables['senderemail'] = $data['email'];
		$emailTemplateVariables['name'] = $data['name'];
		$emailTemplateVariables['telephone'] = $telephone;
		$emailTemplateVariables['extension'] = $extension;
		$emailTemplateVariables['message'] = $message;
		$emailTemplateVariables['url'] = Mage::getUrl();
		
		
		$emailTemplate->setSenderName($fromName);
		$emailTemplate->setSenderEmail($from);
		$emailTemplate->setTemplateSubject($subject);

		$processedTemplate = $emailTemplate->getProcessedTemplate($emailTemplateVariables);
		try {
			$emailTemplate->send($to,$toName, $emailTemplateVariables);
			
		} catch (Exception $e) {
            $result['message'] = $e->getMessage();
            $this->_ajaxResponse($result);
            return;
        }
        $result['message'] = $this->__('Message sent');
        $this->_ajaxResponse($result);
    }

  

    protected function _ajaxResponse($result = array())
    {
        $this->getResponse()->setBody(Zend_Json::encode($result));
        return;
    }

	protected function _isAllowed()
    {
        return true;
    }
}