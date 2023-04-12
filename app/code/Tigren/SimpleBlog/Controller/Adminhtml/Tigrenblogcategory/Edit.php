<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Tigren\SimpleBlog\Controller\Adminhtml\Tigrenblogcategory;

class Edit extends \Tigren\SimpleBlog\Controller\Adminhtml\Tigrenblogcategory
{

    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('tigren_blog_category_id');
        $model = $this->_objectManager->create(\Tigren\SimpleBlog\Model\TigrenBlogCategory::class);
        
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Tigren Blog Category no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('tigren_simpleblog_tigren_blog_category', $model);
        
        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Tigren Blog Category') : __('New Tigren Blog Category'),
            $id ? __('Edit Tigren Blog Category') : __('New Tigren Blog Category')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Tigren Blog Categorys'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Tigren Blog Category %1', $model->getId()) : __('New Tigren Blog Category'));
        return $resultPage;
    }
}

