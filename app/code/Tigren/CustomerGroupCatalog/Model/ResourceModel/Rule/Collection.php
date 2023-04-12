<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2023 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */
declare(strict_types=1);

namespace Tigren\CustomerGroupCatalog\Model\ResourceModel\Rule;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'rule_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Tigren\CustomerGroupCatalog\Model\Rule::class,
            \Tigren\CustomerGroupCatalog\Model\ResourceModel\Rule::class
        );
    }
}

