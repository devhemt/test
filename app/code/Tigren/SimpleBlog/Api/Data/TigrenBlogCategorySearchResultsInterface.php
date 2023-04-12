<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */
declare(strict_types=1);

namespace Tigren\SimpleBlog\Api\Data;

interface TigrenBlogCategorySearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get tigren_blog_category list.
     * @return \Tigren\SimpleBlog\Api\Data\TigrenBlogCategoryInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Tigren\SimpleBlog\Api\Data\TigrenBlogCategoryInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

