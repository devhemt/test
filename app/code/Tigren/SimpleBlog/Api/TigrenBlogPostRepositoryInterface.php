<?php
/**
 * Copyright © @author    Tigren Solutions <info@tigren.com> @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved. @license   Open Software License ("OSL") v. 3.0 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Tigren\SimpleBlog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface TigrenBlogPostRepositoryInterface
{

    /**
     * Save tigren_blog_post
     * @param \Tigren\SimpleBlog\Api\Data\TigrenBlogPostInterface $tigrenBlogPost
     * @return \Tigren\SimpleBlog\Api\Data\TigrenBlogPostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Tigren\SimpleBlog\Api\Data\TigrenBlogPostInterface $tigrenBlogPost
    );

    /**
     * Retrieve tigren_blog_post
     * @param string $tigrenBlogPostId
     * @return \Tigren\SimpleBlog\Api\Data\TigrenBlogPostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($tigrenBlogPostId);

    /**
     * Retrieve tigren_blog_post matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Tigren\SimpleBlog\Api\Data\TigrenBlogPostSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete tigren_blog_post
     * @param \Tigren\SimpleBlog\Api\Data\TigrenBlogPostInterface $tigrenBlogPost
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Tigren\SimpleBlog\Api\Data\TigrenBlogPostInterface $tigrenBlogPost
    );

    /**
     * Delete tigren_blog_post by ID
     * @param string $tigrenBlogPostId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($tigrenBlogPostId);
}

