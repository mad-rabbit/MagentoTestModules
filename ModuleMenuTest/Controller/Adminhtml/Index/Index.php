<?php

namespace Prilutskaya\ModuleMenuTest\Controller\Adminhtml\Index;

class Index extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Prilutskaya_ModuleMenuTest::test_categories';

    protected $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    protected function _initAction()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Prilutskaya_ModuleMenuTest::test_categories');
        $resultPage->addBreadcrumb(__('Test'), __('Test'));
        $resultPage->addBreadcrumb(__('A-categories'), __('A-categories'));
        return $resultPage;
    }

    public function execute()
    {
        $resultPage = $this->_initAction();
        $resultPage->getConfig()->getTitle()->prepend(__('A-categories'));
        return $resultPage;
    }
}
