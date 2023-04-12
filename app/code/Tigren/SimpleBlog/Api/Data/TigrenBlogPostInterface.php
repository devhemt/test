<?php
/**
 * Copyright © @author    Tigren Solutions <info@tigren.com> @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved. @license   Open Software License ("OSL") v. 3.0 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Tigren\SimpleBlog\Api\Data;

interface TigrenBlogPostInterface
{

    const FULL_CONTENT = 'full_content';
    const AUTHOR = 'author';
    const LIST_IMAGE = 'list_image';
    const STATUS = 'status';
    const SHORT_CONTENT = 'short_content';
    const TITLE = 'title';
    const TIGREN_BLOG_POST_ID = 'tigren_blog_post_id';
    const POST_IMAGE = 'post_image';
    const PUBLISHED_AT = 'published_at';

    /**
     * Get tigren_blog_post_id
     * @return string|null
     */
    public function getTigrenBlogPostId();

    /**
     * Set tigren_blog_post_id
     * @param string $tigrenBlogPostId
     * @return \Tigren\SimpleBlog\TigrenBlogPost\Api\Data\TigrenBlogPostInterface
     */
    public function setTigrenBlogPostId($tigrenBlogPostId);

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \Tigren\SimpleBlog\TigrenBlogPost\Api\Data\TigrenBlogPostInterface
     */
    public function setTitle($title);

    /**
     * Get post_image
     * @return string|null
     */
    public function getPostImage();

    /**
     * Set post_image
     * @param string $postImage
     * @return \Tigren\SimpleBlog\TigrenBlogPost\Api\Data\TigrenBlogPostInterface
     */
    public function setPostImage($postImage);

    /**
     * Get list_image
     * @return string|null
     */
    public function getListImage();

    /**
     * Set list_image
     * @param string $listImage
     * @return \Tigren\SimpleBlog\TigrenBlogPost\Api\Data\TigrenBlogPostInterface
     */
    public function setListImage($listImage);

    /**
     * Get full_content
     * @return string|null
     */
    public function getFullContent();

    /**
     * Set full_content
     * @param string $fullContent
     * @return \Tigren\SimpleBlog\TigrenBlogPost\Api\Data\TigrenBlogPostInterface
     */
    public function setFullContent($fullContent);

    /**
     * Get short_content
     * @return string|null
     */
    public function getShortContent();

    /**
     * Set short_content
     * @param string $shortContent
     * @return \Tigren\SimpleBlog\TigrenBlogPost\Api\Data\TigrenBlogPostInterface
     */
    public function setShortContent($shortContent);

    /**
     * Get author
     * @return string|null
     */
    public function getAuthor();

    /**
     * Set author
     * @param string $author
     * @return \Tigren\SimpleBlog\TigrenBlogPost\Api\Data\TigrenBlogPostInterface
     */
    public function setAuthor($author);

    /**
     * Get published_at
     * @return string|null
     */
    public function getPublishedAt();

    /**
     * Set published_at
     * @param string $publishedAt
     * @return \Tigren\SimpleBlog\TigrenBlogPost\Api\Data\TigrenBlogPostInterface
     */
    public function setPublishedAt($publishedAt);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Tigren\SimpleBlog\TigrenBlogPost\Api\Data\TigrenBlogPostInterface
     */
    public function setStatus($status);
}

