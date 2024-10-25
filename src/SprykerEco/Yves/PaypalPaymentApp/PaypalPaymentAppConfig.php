<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Yves\PaypalPaymentApp;

use Generated\Shared\Transfer\PaypalQueryParametersTransfer;
use Generated\Shared\Transfer\PaypalScriptParametersTransfer;
use Spryker\Yves\Kernel\AbstractBundleConfig;

class PaypalPaymentAppConfig extends AbstractBundleConfig
{
    /**
     * Specification:
     * - Defines the express checkout configuration strategy for the payment method.
     *
     * @api
     *
     * @var string
     */
    public const CHECKOUT_CONFIGURATION_STRATEGY_EXPRESS_CHECKOUT = 'express-checkout';

    /**
     * @var string
     */
    protected const PAYMENT_METHOD_KEY_PAYPAL_EXPRESS_CHECKOUT = 'paypal_express_checkout';

    /**
     * @var string
     *
     * @see https://developer.paypal.com/sdk/js/configuration/#link-intent
     */
    protected const QUERY_PARAMETER_INTENT_AUTHORIZE = 'authorize';

    /**
     * Specification:
     * - Returns a list of payment method keys that support express checkout.
     *
     * @api
     *
     * @return array<string>
     */
    public function getExpressCheckoutPaymentMethodKeys(): array
    {
        return [
            'dummyPaymentInvoice',
            static::PAYMENT_METHOD_KEY_PAYPAL_EXPRESS_CHECKOUT,
        ];
    }

    /**
     * Specification:
     * - Returns a map of query parameters for the PayPal Express Checkout widget.
     *
     * @api
     *
     * @see https://developer.paypal.com/sdk/js/configuration/#link-queryparameters
     *
     * @return \Generated\Shared\Transfer\PaypalQueryParametersTransfer
     */
    public function getPaypalExpressCheckoutWidgetQueryParameters(): PaypalQueryParametersTransfer
    {
        return (new PaypalQueryParametersTransfer())
            ->setIntent(static::QUERY_PARAMETER_INTENT_AUTHORIZE)
            ->setClientId('AUn5n-4qxBUkdzQBv6f8yd8F4AWdEvV6nLzbAifDILhKGCjOS62qQLiKbUbpIKH_O2Z3OL8CvX7ucZfh')
            ->setMerchantId('3QK84QGGJE5HW');
    }

    /**
     * Specification:
     * - Returns a map of script parameters for the PayPal Express Checkout widget.
     * - Script parameters are additional key value pairs you can add to the script tag to provide information you need.
     *
     * @api
     *
     * @see https://developer.paypal.com/sdk/js/configuration/#link-scriptparameters
     *
     * @return \Generated\Shared\Transfer\PaypalScriptParametersTransfer
     */
    public function getPaypalExpressCheckoutWidgetScriptParameters(): PaypalScriptParametersTransfer
    {
        return new PaypalScriptParametersTransfer();
    }
}
