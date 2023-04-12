<?php
/**
 * Copyright © @author    Tigren Solutions <info@tigren.com> @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved. @license   Open Software License ("OSL") v. 3.0 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Tigren\SimpleBlog\Model;

use Magento\Framework\Model\AbstractModel;
use Tigren\SimpleBlog\Api\Data\TigrenBlogPostInterface;

class TigrenBlogPost extends AbstractModel implements TigrenBlogPostInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Tigren\SimpleBlog\Model\ResourceModel\TigrenBlogPost::class);
    }

    /**
     * @inheritDoc
     */
    public function getTigrenBlogPostId()
    {
        return $this->getData(self::TIGREN_BLOG_POST_ID);
    }

    /**
     * @inheritDoc
     */
    public function setTigrenBlogPostId($tigrenBlogPostId)
    {
        return $this->setData(self::TIGREN_BLOG_POST_ID, $tigrenBlogPostId);
    }

    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @inheritDoc
     */
    public function getPostImage()
    {
        return $this->getData(self::POST_IMAGE);
    }

    /**
     * @inheritDoc
     */
    public function setPostImage($postImage)
    {
        return $this->setData(self::POST_IMAGE, $postImage);
    }

    /**
     * @inheritDoc
     */
    public function getListImage()
    {
        return $this->getData(self::LIST_IMAGE);
    }

    /**
     * @inheritDoc
     */
    public function setListImage($listImage)
    {
        return $this->setData(self::LIST_IMAGE, $listImage);
    }

    /**
     * @inheritDoc
     */
    public function getFullContent()
    {
        return $this->getData(self::FULL_CONTENT);
    }

    /**
     * @inheritDoc
     */
    public function setFullContent($fullContent)
    {
        return $this->setData(self::FULL_CONTENT, $fullContent);
    }

    /**
     * @inheritDoc
     */
    public function getShortContent()
    {
        return $this->getData(self::SHORT_CONTENT);
    }

    /**
     * @inheritDoc
     */
    public function setShortContent($shortContent)
    {
        return $this->setData(self::SHORT_CONTENT, $shortContent);
    }

    /**
     * @inheritDoc
     */
    public function getAuthor()
    {
        return $this->getData(self::AUTHOR);
    }

    /**
     * @inheritDoc
     */
    public function setAuthor($author)
    {
        return $this->setData(self::AUTHOR, $author);
    }

    /**
     * @inheritDoc
     */
    public function getPublishedAt()
    {
        return $this->getData(self::PUBLISHED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setPublishedAt($publishedAt)
    {
        return $this->setData(self::PUBLISHED_AT, $publishedAt);
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}

