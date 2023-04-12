<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2023 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Block\Adminhtml\Rule\Edit\Tab;

use Tigren\CustomerGroupCatalog\Controller\RegistryConstants;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;

class ProductConditions extends Generic implements TabInterface
{
    /**
     * @var \Magento\Backend\Block\Widget\Form\Renderer\Fieldset
     */
    protected $rendererFieldset;

    /**
     * @var \Magento\Rule\Block\Conditions
     */
    protected $conditions;

    /**
     * @var string
     */
    protected $_nameInLayout = 'actions_apply_to';

    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        \Magento\Backend\Block\Widget\Form\Renderer\Fieldset $rendererFieldset,
        \Magento\Rule\Block\Conditions $conditions,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->rendererFieldset = $rendererFieldset;
        $this->conditions = $conditions;
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Product Conditions');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Product Conditions');
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $formName = 'tigren_customergroupcatalog_rule_form';
        /** @var \Magento\CatalogRule\Model\Rule $model */
        $model = $this->_coreRegistry->registry(RegistryConstants::CURRENT_GROUPCAT_RULE_ID);
        //        dd($model);
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('rule_');

        /* start condition block*/
        $fieldset = $form->addFieldset(
            'conditions_fieldset',
            ['legend' => __('Conditions')]
        );
        $renderer = $this->rendererFieldset
            ->setTemplate('Tigren_CustomerGroupCatalog::rule/condition/fieldset.phtml')
            ->setFieldSetId($model->getConditionsFieldSetId($formName))
            ->setNewChildUrl(
                $this->getUrl(
                    'amasty_groupcat/rule/newConditionHtml/form/' . $model->getConditionsFieldSetId($formName),
                    ['form_namespace' => $formName]
                )
            );

        $fieldset->setRenderer($renderer);

        $fieldset->addField(
            'conditions',
            'text',
            [
                'name' => 'conditions',
                'label' => __('Product Conditions'),
                'title' => __('Product Conditions'),
                'required' => true,
                'data-form-part' => $formName
            ]
        )
            ->setRule($model)
            ->setRenderer($this->conditions);

        $form->setValues($model->getData());
        $this->setConditionFormName($model->getConditions(), $formName, $model->getConditionsFieldSetId($formName));
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @param \Magento\Rule\Model\Condition\AbstractCondition $conditions
     * @param string $formName
     * @return void
     */
    private function setConditionFormName(
        \Magento\Rule\Model\Condition\AbstractCondition $conditions,
        $formName,
        $fieldsetName
    ) {
        $conditions->setFormName($formName);
        $conditions->setJsFormObject($fieldsetName);
        if ($conditions->getConditions() && is_array($conditions->getConditions())) {
            foreach ($conditions->getConditions() as $condition) {
                $this->setConditionFormName($condition, $formName, $fieldsetName);
            }
        }
    }
}
