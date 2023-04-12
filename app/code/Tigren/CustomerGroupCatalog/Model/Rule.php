<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2023 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */
declare(strict_types=1);

namespace Tigren\CustomerGroupCatalog\Model;

use Magento\Framework\Model\AbstractModel;
use Tigren\CustomerGroupCatalog\Api\Data\RuleInterface;

class Rule extends AbstractModel implements RuleInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Tigren\CustomerGroupCatalog\Model\ResourceModel\Rule::class);
    }

    /**
     * @inheritDoc
     */
    public function getRuleId()
    {
        return $this->getData(self::RULE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setRuleId($ruleId)
    {
        return $this->setData(self::RULE_ID, $ruleId);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getDiscountAmount()
    {
        return $this->getData(self::DISCOUNT_AMOUNT);
    }

    /**
     * @inheritDoc
     */
    public function setDiscountAmount($discountAmount)
    {
        return $this->setData(self::DISCOUNT_AMOUNT, $discountAmount);
    }

    /**
     * @inheritDoc
     */
    public function getStartTime()
    {
        return $this->getData(self::START_TIME);
    }

    /**
     * @inheritDoc
     */
    public function setStartTime($startTime)
    {
        return $this->setData(self::START_TIME, $startTime);
    }

    /**
     * @inheritDoc
     */
    public function getEndTime()
    {
        return $this->getData(self::END_TIME);
    }

    /**
     * @inheritDoc
     */
    public function setEndTime($endTime)
    {
        return $this->setData(self::END_TIME, $endTime);
    }

    /**
     * @inheritDoc
     */
    public function getPriority()
    {
        return $this->getData(self::PRIORITY);
    }

    /**
     * @inheritDoc
     */
    public function setPriority($priority)
    {
        return $this->setData(self::PRIORITY, $priority);
    }

    /**
     * @inheritDoc
     */
    public function getActive()
    {
        return $this->getData(self::ACTIVE);
    }

    /**
     * @inheritDoc
     */
    public function setActive($active)
    {
        return $this->setData(self::ACTIVE, $active);
    }

    /**
     * @inheritDoc
     */
    public function getStore()
    {
        return $this->getData(self::STORE);
    }

    /**
     * @inheritDoc
     */
    public function setStore($store)
    {
        return $this->setData(self::STORE, $store);
    }
}

