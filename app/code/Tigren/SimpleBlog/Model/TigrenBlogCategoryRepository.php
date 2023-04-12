<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */
declare(strict_types=1);

namespace Tigren\SimpleBlog\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Tigren\SimpleBlog\Api\Data\TigrenBlogCategoryInterface;
use Tigren\SimpleBlog\Api\Data\TigrenBlogCategoryInterfaceFactory;
use Tigren\SimpleBlog\Api\Data\TigrenBlogCategorySearchResultsInterfaceFactory;
use Tigren\SimpleBlog\Api\TigrenBlogCategoryRepositoryInterface;
use Tigren\SimpleBlog\Model\ResourceModel\TigrenBlogCategory as ResourceTigrenBlogCategory;
use Tigren\SimpleBlog\Model\ResourceModel\TigrenBlogCategory\CollectionFactory as TigrenBlogCategoryCollectionFactory;

class TigrenBlogCategoryRepository implements TigrenBlogCategoryRepositoryInterface
{

    /**
     * @var TigrenBlogCategoryCollectionFactory
     */
    protected $tigrenBlogCategoryCollectionFactory;

    /**
     * @var ResourceTigrenBlogCategory
     */
    protected $resource;

    /**
     * @var TigrenBlogCategory
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var TigrenBlogCategoryInterfaceFactory
     */
    protected $tigrenBlogCategoryFactory;


    /**
     * @param ResourceTigrenBlogCategory $resource
     * @param TigrenBlogCategoryInterfaceFactory $tigrenBlogCategoryFactory
     * @param TigrenBlogCategoryCollectionFactory $tigrenBlogCategoryCollectionFactory
     * @param TigrenBlogCategorySearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceTigrenBlogCategory $resource,
        TigrenBlogCategoryInterfaceFactory $tigrenBlogCategoryFactory,
        TigrenBlogCategoryCollectionFactory $tigrenBlogCategoryCollectionFactory,
        TigrenBlogCategorySearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->tigrenBlogCategoryFactory = $tigrenBlogCategoryFactory;
        $this->tigrenBlogCategoryCollectionFactory = $tigrenBlogCategoryCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(
        TigrenBlogCategoryInterface $tigrenBlogCategory
    ) {
        try {
            $this->resource->save($tigrenBlogCategory);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the tigrenBlogCategory: %1',
                $exception->getMessage()
            ));
        }
        return $tigrenBlogCategory;
    }

    /**
     * @inheritDoc
     */
    public function get($tigrenBlogCategoryId)
    {
        $tigrenBlogCategory = $this->tigrenBlogCategoryFactory->create();
        $this->resource->load($tigrenBlogCategory, $tigrenBlogCategoryId);
        if (!$tigrenBlogCategory->getId()) {
            throw new NoSuchEntityException(__('tigren_blog_category with id "%1" does not exist.',
                $tigrenBlogCategoryId));
        }
        return $tigrenBlogCategory;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->tigrenBlogCategoryCollectionFactory->create();

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
    public function delete(
        TigrenBlogCategoryInterface $tigrenBlogCategory
    ) {
        try {
            $tigrenBlogCategoryModel = $this->tigrenBlogCategoryFactory->create();
            $this->resource->load($tigrenBlogCategoryModel, $tigrenBlogCategory->getTigrenBlogCategoryId());
            $this->resource->delete($tigrenBlogCategoryModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the tigren_blog_category: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($tigrenBlogCategoryId)
    {
        return $this->delete($this->get($tigrenBlogCategoryId));
    }
}

