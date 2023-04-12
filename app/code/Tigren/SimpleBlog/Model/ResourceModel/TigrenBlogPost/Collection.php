<?php
/**
 * Copyright © @author    Tigren Solutions <info@tigren.com> @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved. @license   Open Software License ("OSL") v. 3.0 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Tigren\SimpleBlog\Model\ResourceModel\TigrenBlogPost;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'tigren_blog_post_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Tigren\SimpleBlog\Model\TigrenBlogPost::class,
            \Tigren\SimpleBlog\Model\ResourceModel\TigrenBlogPost::class
        );
    }
}

