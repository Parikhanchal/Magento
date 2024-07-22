<?php

namespace Kitchen\Payment\Model;

/**
 * Class KitchenPayOffline
 *
 * @method \Magento\Quote\Api\Data\PaymentMethodExtensionInterface getExtensionAttributes()
 *
 * @api
 * @since 100.0.2
 */
class KitchenPayOffline extends \Magento\Payment\Model\Method\AbstractMethod
{
    const PAYMENT_METHOD_KITCHENPAYOFFLINE_CODE = 'KitchenPayOffline';
    
    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::PAYMENT_METHOD_KITCHENPAYOFFLINE_CODE;

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;

    // /**
    //  * @return string
    //  */
    // public function getPayableTo()
    // {
    //     return $this->getConfigData('payable_to');
    // }

    // /**
    //  * @return string
    //  */
    // public function getMailingAddress()
    // {
    //     return $this->getConfigData('mailing_address');
    // }

    // public function getInstructions()
    // {
    //     $instructions = $this->getConfigData('instructions');
    //     return $instructions !== null ? trim($instructions) : '';
    // }
}
