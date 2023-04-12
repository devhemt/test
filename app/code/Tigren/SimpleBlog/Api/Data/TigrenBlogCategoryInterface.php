<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */
declare(strict_types=1);

namespace Tigren\SimpleBlog\Api\Data;

interface TigrenBlogCategoryInterface
{

    const STATUS = 'status';
    const NAME = 'name';
    const UPDATED_AT = 'updated_at';
    const DESCRIPTION = 'description';
    const CREATED_AT = 'created_at';
    const TIGREN_BLOG_CATEGORY_ID = 'tigren_blog_category_id';

    /**
     * Get tigren_blog_category_id
     * @return string|null
     */
    public function getTigrenBlogCategoryId();

    /**
     * Set tigren_blog_category_id
     * @param string $tigrenBlogCategoryId
     * @return \Tigren\SimpleBlog\TigrenBlogCategory\Api\Data\TigrenBlogCategoryInterface
     */
    public function setTigrenBlogCategoryId($tigrenBlogCategoryId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Tigren\SimpleBlog\TigrenBlogCategory\Api\Data\TigrenBlogCategoryInterface
     */
    public function setName($name);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \Tigren\SimpleBlog\TigrenBlogCategory\Api\Data\TigrenBlogCategoryInterface
     */
    public function setDescription($description);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Tigren\SimpleBlog\TigrenBlogCategory\Api\Data\TigrenBlogCategoryInterface
     */
    public function setStatus($status);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Tigren\SimpleBlog\TigrenBlogCategory\Api\Data\TigrenBlogCategoryInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Tigren\SimpleBlog\TigrenBlogCategory\Api\Data\TigrenBlogCategoryInterface
     */
    public function setUpdatedAt($updatedAt);
}

