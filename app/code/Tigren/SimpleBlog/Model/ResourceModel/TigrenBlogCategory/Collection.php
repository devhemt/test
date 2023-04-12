<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Tigren\SimpleBlog\Model\ResourceModel\TigrenBlogCategory;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'tigren_blog_category_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Tigren\SimpleBlog\Model\TigrenBlogCategory::class,
            \Tigren\SimpleBlog\Model\ResourceModel\TigrenBlogCategory::class
        );
    }
}

