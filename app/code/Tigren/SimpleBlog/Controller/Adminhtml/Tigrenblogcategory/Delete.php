<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Tigren\SimpleBlog\Controller\Adminhtml\Tigrenblogcategory;

class Delete extends \Tigren\SimpleBlog\Controller\Adminhtml\Tigrenblogcategory
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('tigren_blog_category_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Tigren\SimpleBlog\Model\TigrenBlogCategory::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Tigren Blog Category.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['tigren_blog_category_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Tigren Blog Category to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

