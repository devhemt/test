<?php
/**
 * Copyright © @author    Tigren Solutions <info@tigren.com> @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved. @license   Open Software License ("OSL") v. 3.0 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Tigren\SimpleBlog\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Tigren\SimpleBlog\Api\Data\TigrenBlogPostInterface;
use Tigren\SimpleBlog\Api\Data\TigrenBlogPostInterfaceFactory;
use Tigren\SimpleBlog\Api\Data\TigrenBlogPostSearchResultsInterfaceFactory;
use Tigren\SimpleBlog\Api\TigrenBlogPostRepositoryInterface;
use Tigren\SimpleBlog\Model\ResourceModel\TigrenBlogPost as ResourceTigrenBlogPost;
use Tigren\SimpleBlog\Model\ResourceModel\TigrenBlogPost\CollectionFactory as TigrenBlogPostCollectionFactory;

class TigrenBlogPostRepository implements TigrenBlogPostRepositoryInterface
{

    /**
     * @var TigrenBlogPostInterfaceFactory
     */
    protected $tigrenBlogPostFactory;

    /**
     * @var TigrenBlogPostCollectionFactory
     */
    protected $tigrenBlogPostCollectionFactory;

    /**
     * @var ResourceTigrenBlogPost
     */
    protected $resource;

    /**
     * @var TigrenBlogPost
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceTigrenBlogPost $resource
     * @param TigrenBlogPostInterfaceFactory $tigrenBlogPostFactory
     * @param TigrenBlogPostCollectionFactory $tigrenBlogPostCollectionFactory
     * @param TigrenBlogPostSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceTigrenBlogPost $resource,
        TigrenBlogPostInterfaceFactory $tigrenBlogPostFactory,
        TigrenBlogPostCollectionFactory $tigrenBlogPostCollectionFactory,
        TigrenBlogPostSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->tigrenBlogPostFactory = $tigrenBlogPostFactory;
        $this->tigrenBlogPostCollectionFactory = $tigrenBlogPostCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(TigrenBlogPostInterface $tigrenBlogPost)
    {
        try {
            $this->resource->save($tigrenBlogPost);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the tigrenBlogPost: %1',
                $exception->getMessage()
            ));
        }
        return $tigrenBlogPost;
    }

    /**
     * @inheritDoc
     */
    public function get($tigrenBlogPostId)
    {
        $tigrenBlogPost = $this->tigrenBlogPostFactory->create();
        $this->resource->load($tigrenBlogPost, $tigrenBlogPostId);
        if (!$tigrenBlogPost->getId()) {
            throw new NoSuchEntityException(__('tigren_blog_post with id "%1" does not exist.', $tigrenBlogPostId));
        }
        return $tigrenBlogPost;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->tigrenBlogPostCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(TigrenBlogPostInterface $tigrenBlogPost)
    {
        try {
            $tigrenBlogPostModel = $this->tigrenBlogPostFactory->create();
            $this->resource->load($tigrenBlogPostModel, $tigrenBlogPost->getTigrenBlogPostId());
            $this->resource->delete($tigrenBlogPostModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the tigren_blog_post: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($tigrenBlogPostId)
    {
        return $this->delete($this->get($tigrenBlogPostId));
    }
}

