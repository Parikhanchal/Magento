<?php

namespace Kitchen\Payment\Model;

/**
 * Class AllCustomerPayOffline
 *
 * @method \Magento\Quote\Api\Data\PaymentMethodExtensionInterface getExtensionAttributes()
 *
 * @api
 * @since 100.0.2
 */
class AllCustomerPayOffline extends \Magento\Payment\Model\Method\AbstractMethod
{
    const PAYMENT_METHOD_ALLCUSTOMERPAYOFFLINE_CODE = 'AllCustomerPayOffline';
        
    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::PAYMENT_METHOD_ALLCUSTOMERPAYOFFLINE_CODE;

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;

}
