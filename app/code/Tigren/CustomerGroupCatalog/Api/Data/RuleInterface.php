<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Tigren\CustomerGroupCatalog\Api\Data;

interface RuleInterface
{

    const RULE_ID = 'rule_id';
    const NAME = 'name';
    const STORE = 'store';
    const END_TIME = 'end_time';
    const DISCOUNT_AMOUNT = 'discount_amount';
    const ACTIVE = 'active';
    const START_TIME = 'start_time';
    const PRIORITY = 'priority';

    /**
     * Get rule_id
     * @return string|null
     */
    public function getRuleId();

    /**
     * Set rule_id
     * @param string $ruleId
     * @return \Tigren\CustomerGroupCatalog\Rule\Api\Data\RuleInterface
     */
    public function setRuleId($ruleId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Tigren\CustomerGroupCatalog\Rule\Api\Data\RuleInterface
     */
    public function setName($name);

    /**
     * Get discount_amount
     * @return string|null
     */
    public function getDiscountAmount();

    /**
     * Set discount_amount
     * @param string $discountAmount
     * @return \Tigren\CustomerGroupCatalog\Rule\Api\Data\RuleInterface
     */
    public function setDiscountAmount($discountAmount);

    /**
     * Get start_time
     * @return string|null
     */
    public function getStartTime();

    /**
     * Set start_time
     * @param string $startTime
     * @return \Tigren\CustomerGroupCatalog\Rule\Api\Data\RuleInterface
     */
    public function setStartTime($startTime);

    /**
     * Get end_time
     * @return string|null
     */
    public function getEndTime();

    /**
     * Set end_time
     * @param string $endTime
     * @return \Tigren\CustomerGroupCatalog\Rule\Api\Data\RuleInterface
     */
    public function setEndTime($endTime);

    /**
     * Get priority
     * @return string|null
     */
    public function getPriority();

    /**
     * Set priority
     * @param string $priority
     * @return \Tigren\CustomerGroupCatalog\Rule\Api\Data\RuleInterface
     */
    public function setPriority($priority);

    /**
     * Get active
     * @return string|null
     */
    public function getActive();

    /**
     * Set active
     * @param string $active
     * @return \Tigren\CustomerGroupCatalog\Rule\Api\Data\RuleInterface
     */
    public function setActive($active);

    /**
     * Get store
     * @return string|null
     */
    public function getStore();

    /**
     * Set store
     * @param string $store
     * @return \Tigren\CustomerGroupCatalog\Rule\Api\Data\RuleInterface
     */
    public function setStore($store);
}

