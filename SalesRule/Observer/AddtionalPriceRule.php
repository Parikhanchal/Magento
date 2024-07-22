<?php
namespace Task\SalesRule\Observer;

class AddtionalPriceRule implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * Execute observer.
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // Magento\SalesRule\Model\Rule\Condition getNewChildSelectOptions() 81
        $additional = $observer->getAdditional();


        $additionalConditions = (array) $additional->getConditions();

        $conditions = array_merge_recursive($additionalConditions, [
            [
                'value'=> [
                    [
                        'value' => \Task\SalesRule\Model\Rule\Condition\AddtionalRules::class,
                        'label' => __('Custom Cart Price Field')
                    ]
                ],
                'label'=> __('Addtional Condition')
            ]
        ]);

        if ($additionalConditions) {
            $conditions = array_merge_recursive($conditions, $additionalConditions);
        }

        $additional->setConditions($conditions);
        return $this;
    }
}
