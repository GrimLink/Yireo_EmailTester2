<?php
/**
 * EmailTester2 plugin for Magento
 *
 * @package     Yireo_EmailTester2
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2017 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

declare(strict_types=1);

namespace Yireo\EmailTester2\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\View\Result\PageFactory;
use Yireo\EmailTester2\Config\Config;
use Yireo\EmailTester2\ViewModel\Form;

class Index extends Action
{
    /**
     * ACL resource
     */
    const ADMIN_RESOURCE = 'Yireo_EmailTester2::index';

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @var Config
     */
    private $config;
    /**
     * @var Form
     */
    private $formViewModel;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param ManagerInterface $messageManager
     * @param Config $config
     * @param Form $formViewModel
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ManagerInterface $messageManager,
        Config $config,
        Form $formViewModel
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->messageManager = $messageManager;
        $this->config = $config;
        $this->formViewModel = $formViewModel;
    }

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function dispatch(RequestInterface $request)
    {
        $email = $this->config->getDefaultEmail();
        if (empty($email)) {
            $msg = 'Tip: Add default values via Stores > Configuration > Yireo > Yireo EmailTester';
            $this->messageManager->addNoticeMessage($msg);
        }

        if ($this->formViewModel->hasCustomers() === false) {
            $this->messageManager->addWarningMessage(__('Please add some customers to your shop first'));
        }

        if ($this->formViewModel->hasProducts() === false) {
            $this->messageManager->addWarningMessage(__('Please add some products to your shop first'));
        }

        if ($this->formViewModel->hasOrders() === false) {
            $this->messageManager->addWarningMessage(__('Please add some orders to your shop first'));
        }

        return parent::dispatch($request);
    }

    /**
     * Index action
     *
     * @return Page
     * @throws LocalizedException
     */
    public function execute(): Page
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Yireo_EmailTester2::index');
        $resultPage->addBreadcrumb(__('Yireo EmailTester'), __('Yireo EmailTester'));
        $resultPage->getConfig()->getTitle()->prepend(__('Yireo EmailTester'));

        return $resultPage;
    }
}
