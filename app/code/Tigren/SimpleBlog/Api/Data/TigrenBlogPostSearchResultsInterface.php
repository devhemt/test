<?php
/**
 * Copyright © @author    Tigren Solutions <info@tigren.com> @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved. @license   Open Software License ("OSL") v. 3.0 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Tigren\SimpleBlog\Api\Data;

interface TigrenBlogPostSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get tigren_blog_post list.
     * @return \Tigren\SimpleBlog\Api\Data\TigrenBlogPostInterface[]
     */
    public function getItems();

    /**
     * Set title list.
     * @param \Tigren\SimpleBlog\Api\Data\TigrenBlogPostInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

