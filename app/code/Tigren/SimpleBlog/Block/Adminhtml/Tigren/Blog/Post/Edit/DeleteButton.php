<?php
/**
 * Copyright © @author    Tigren Solutions <info@tigren.com> @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved. @license   Open Software License ("OSL") v. 3.0 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Tigren\SimpleBlog\Block\Adminhtml\Tigren\Blog\Post\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getModelId()) {
            $data = [
                'label' => __('Delete Tigren Blog Post'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * Get URL for delete button
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['tigren_blog_post_id' => $this->getModelId()]);
    }
}

