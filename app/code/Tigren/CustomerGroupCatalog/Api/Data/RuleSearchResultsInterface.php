<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Tigren\CustomerGroupCatalog\Api\Data;

interface RuleSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Rule list.
     * @return \Tigren\CustomerGroupCatalog\Api\Data\RuleInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Tigren\CustomerGroupCatalog\Api\Data\RuleInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

