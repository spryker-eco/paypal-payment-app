<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Yves\PaypalPaymentApp\Plugin\PaymentAppWidget;

use Generated\Shared\Transfer\ExpressCheckoutConfigurationTransfer;
use Generated\Shared\Transfer\ExpressCheckoutPaymentMethodTemplateTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Spryker\Yves\Kernel\AbstractPlugin;
use SprykerEco\Yves\PaypalPaymentApp\PaypalPaymentAppConfig;
use SprykerShop\Yves\PaymentAppWidgetExtension\Dependency\Plugin\ExpressCheckoutPaymentWidgetRenderStrategyPluginInterface;

/**
 * @method \SprykerEco\Yves\PaypalPaymentApp\PaypalPaymentAppFactory getFactory()
 * @method \SprykerEco\Yves\PaypalPaymentApp\PaypalPaymentAppConfig getConfig()
 */
class PayPalExpressCheckoutPaymentWidgetRenderStrategyPlugin extends AbstractPlugin implements ExpressCheckoutPaymentWidgetRenderStrategyPluginInterface
{
    /**
     * {@inheritDoc}
     * - Checks if the payment method is PayPal Express Checkout.
     * - Verifies if the express checkout configuration is enabled.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PaymentMethodTransfer $paymentMethodTransfer
     * @param \Generated\Shared\Transfer\ExpressCheckoutConfigurationTransfer $expressCheckoutConfigurationTransfer
     *
     * @return bool
     */
    public function isApplicable(
        PaymentMethodTransfer $paymentMethodTransfer,
        ExpressCheckoutConfigurationTransfer $expressCheckoutConfigurationTransfer,
    ): bool {
        return in_array(
                $paymentMethodTransfer->getPaymentMethodKey(),
                $this->getConfig()->getExpressCheckoutPaymentMethodKeys(),
                true,
            ) && $paymentMethodTransfer->getPaymentMethodAppConfiguration()?->getCheckoutConfiguration()?->getStrategy() === PaypalPaymentAppConfig::CHECKOUT_CONFIGURATION_STRATEGY_EXPRESS_CHECKOUT;
    }

    /**
     * {@inheritDoc}
     * - Provides the template for rendering the PayPal Express Checkout widget.
     * - Sets the necessary data for the template.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PaymentMethodTransfer $paymentMethodTransfer
     * @param \Generated\Shared\Transfer\ExpressCheckoutConfigurationTransfer $expressCheckoutConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\ExpressCheckoutPaymentMethodTemplateTransfer
     */
    public function getTemplate(
        PaymentMethodTransfer $paymentMethodTransfer,
        ExpressCheckoutConfigurationTransfer $expressCheckoutConfigurationTransfer,
    ): ExpressCheckoutPaymentMethodTemplateTransfer {
        return $this->getFactory()
            ->createPayPalExpressCheckoutPaymentMethodTemplateReader()
            ->getPayPalCheckoutPaymentMethodTemplate($paymentMethodTransfer, $expressCheckoutConfigurationTransfer);
    }
}
