<?php
/**
 * Created by PhpStorm.
 * User: vlazarevych
 * Date: 2/26/18
 * Time: 6:35 PM
 */

namespace QuickStart\SimpleController\Controller\Page;


use Magento\Framework\App\ResponseInterface;

/**
 * Class Action
 * @package QuickStart\FrontCrontroller
 */
class Action extends \Magento\Framework\App\Action\Action
{
    /**
     * @var ResultFactory
     */
    public $resultFactory;

    /**
     * Action constructor.
     * @param \Magento\Framework\Controller\ResultFactory $resultFactory
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(\Magento\Framework\Controller\ResultFactory $resultFactory,
                                \Magento\Framework\App\Action\Context $context)
    {
        $this->resultFactory = $resultFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        return $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_RAW)
            ->setContents('Welcome message!');
    }

}