<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2023 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Pricing\Render;

use Magento\Catalog\Pricing\Price;
use Magento\Framework\Pricing\Render;
use Magento\Framework\Pricing\Render\PriceBox as BasePriceBox;
use Magento\Msrp\Pricing\Price\MsrpPrice;
use Magento\Framework\App\ResourceConnection;

class FinalPriceBox extends \Magento\Catalog\Pricing\Render\FinalPriceBox
{
    protected $_resource;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Pricing\SaleableInterface $saleableItem,
        \Magento\Framework\Pricing\Price\PriceInterface $price,
        ResourceConnection $resource,
        \Magento\Framework\Pricing\Render\RendererPool $rendererPool,
        array $data = [],
        \Magento\Catalog\Model\Product\Pricing\Renderer\SalableResolverInterface $salableResolver = null,
        \Magento\Catalog\Pricing\Price\MinimalPriceCalculatorInterface $minimalPriceCalculator = null
    ) {
        parent::__construct($context,
            $saleableItem,
            $price,
            $rendererPool,
            $data,
            $salableResolver,
            $minimalPriceCalculator);
        $this->_resource = $resource;
    }

    protected function wrapResult($html)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $discount = 0;
        $product = $objectManager->get('Magento\Framework\Registry')->registry('current_product');
        if (isset($product)) {
            $conn = $this->_resource->getConnection();
            $session = $objectManager->create(\Magento\Customer\Model\Session::class);
            $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
            $select = $conn->select()
                ->from(['so' => $this->_resource->getTableName('tigren_customergroupcatalog_rule')])
                ->join(['soi' => $this->_resource->getTableName('tigren_rule_store')],
                    'so.rule_id = soi.rule_id')
                ->join(['soii' => $this->_resource->getTableName('tigren_rule_customer_group')],
                    'so.rule_id = soii.rule_id')
                ->join(['soiii' => $this->_resource->getTableName('tigren_rule_products')],
                    'so.rule_id = soiii.rule_id',)
                ->where('product_id =' . $product->getId())
                ->where('store_id = ' . $storeManager->getStore()->getStoreId())
                ->where('customer_group_id = ' . $session->getCustomer()->getGroupId());
            $result = $conn->fetchAll($select);
            //            dd($result);
            $max = 0;
            $discount = 1;
            foreach ($result as $r) {
                if ($r['priority'] > $max) {
                    $max = $r['priority'];
                    $discount = $r['discount_amount'];
                }
            }
            //            dd($discount);
        }


        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $httpContext = $objectManager->get('Magento\Framework\App\Http\Context');
        $isLoggedIn = $httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        if ($isLoggedIn) {
            if ($discount != 0) {
                return '<div class="price-box ' . $this->getData('css_classes') . '" ' .
                    'data-role="priceBox" ' .
                    'data-product-id="' . $this->getSaleableItem()->getId() . '"' .
                    ' xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">' . $html . '</div><div class="" ' .
                    'data-role="priceBox" ' .
                    'data-product-id="' . $this->getSaleableItem()->getId() . '"' .
                    '>' . '<h2 style="color: red; font-weight: 600">Sale off ' . $discount . '%</h2>' . '</div>';
            } else {
                return '<div class="price-box ' . $this->getData('css_classes') . '" ' .
                    'data-role="priceBox" ' .
                    'data-product-id="' . $this->getSaleableItem()->getId() . '"' .
                    ' xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">' . $html . '</div>';
            }
        } else {
            $wording = 'Please Login To See Price';
            return '<div class="" ' .
                'data-role="priceBox" ' .
                'data-product-id="' . $this->getSaleableItem()->getId() . '"' .
                '>' . $wording . '</div>';
        }
    }
}
