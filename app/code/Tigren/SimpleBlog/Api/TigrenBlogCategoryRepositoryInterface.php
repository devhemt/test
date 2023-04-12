<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */
declare(strict_types=1);

namespace Tigren\SimpleBlog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface TigrenBlogCategoryRepositoryInterface
{

    /**
     * Save tigren_blog_category
     * @param \Tigren\SimpleBlog\Api\Data\TigrenBlogCategoryInterface $tigrenBlogCategory
     * @return \Tigren\SimpleBlog\Api\Data\TigrenBlogCategoryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Tigren\SimpleBlog\Api\Data\TigrenBlogCategoryInterface $tigrenBlogCategory
    );

    /**
     * Retrieve tigren_blog_category
     * @param string $tigrenBlogCategoryId
     * @return \Tigren\SimpleBlog\Api\Data\TigrenBlogCategoryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($tigrenBlogCategoryId);

    /**
     * Retrieve tigren_blog_category matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Tigren\SimpleBlog\Api\Data\TigrenBlogCategorySearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete tigren_blog_category
     * @param \Tigren\SimpleBlog\Api\Data\TigrenBlogCategoryInterface $tigrenBlogCategory
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Tigren\SimpleBlog\Api\Data\TigrenBlogCategoryInterface $tigrenBlogCategory
    );

    /**
     * Delete tigren_blog_category by ID
     * @param string $tigrenBlogCategoryId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($tigrenBlogCategoryId);
}

