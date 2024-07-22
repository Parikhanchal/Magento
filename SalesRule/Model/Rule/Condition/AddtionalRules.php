<?php

namespace Task\SalesRule\Model\Rule\Condition;

class AddtionalRules extends \Magento\Rule\Model\Condition\AbstractCondition
{

    /**
     * @param \Magento\Rule\Model\Condition\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Rule\Model\Condition\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * 
     *
     * @return $this
     */
    public function loadAttributeOptions()
    {
        $attributes = [
            'custom_cart_price' => __('Custom Cart Price Field Model')
        ];

        $this->setAttributeOption($attributes);

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getInputType()
    {
        return 'numeric';
    }

    /**
     *
     * @return string
     */
    public function getValueElementType()
    {
        return 'text';
    }

    /**
     *
     * @param \Magento\Framework\Model\AbstractModel $model
     * @return bool
     */
    public function validate(\Magento\Framework\Model\AbstractModel $model)
    {
        // get column value in table
        $cartPrice= $this->getRule()->getCustomCartPrice();
        
        // get value in condition field
        $cartPriceCondition = $this->getValue();

        // get operator
        // $conditionOperator = $this->getOperator();

        switch ($this->getOperator()) {
            case '==':
                return $cartPrice == $cartPriceCondition;
            case '!=':
                return $cartPrice != $cartPriceCondition;
            case '>':
                return $cartPrice > $cartPriceCondition;
            case '<':
                return $cartPrice < $cartPriceCondition;
            case '>=':
                return $cartPrice >= $cartPriceCondition;
            case '<=':
                return $cartPrice <= $cartPriceCondition;
            default:
                return false;
        }
    }
}
