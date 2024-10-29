<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Yves\PaypalPaymentApp\Reader;

use Generated\Shared\Transfer\ExpressCheckoutConfigurationTransfer;
use Generated\Shared\Transfer\ExpressCheckoutPaymentMethodTemplateConfigurationTransfer;
use Generated\Shared\Transfer\ExpressCheckoutPaymentMethodTemplateTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\PaypalExpressCheckoutConfigurationTransfer;
use SprykerEco\Yves\PaypalPaymentApp\PaypalPaymentAppConfig;

class PayPalExpressCheckoutPaymentMethodTemplateReader implements PayPalExpressCheckoutPaymentMethodTemplateReaderInterface
{
    /**
     * @var string
     */
    protected const MODULE_NAME_PAYPAL_PAYMENT_APP = 'PaypalPaymentApp';

    /**
     * @var string
     */
    protected const TEMPLATE_TYPE_MOLECULE = 'molecule';

    /**
     * @var string
     */
    protected const TEMPLATE_NAME_PAYPAL_BUTTONS = 'paypal-buttons';

    /**
     * @var \SprykerEco\Yves\PaypalPaymentApp\PaypalPaymentAppConfig
     */
    protected PaypalPaymentAppConfig $paypalPaymentAppConfig;

    /**
     * @param \SprykerEco\Yves\PaypalPaymentApp\PaypalPaymentAppConfig $paypalPaymentAppConfig
     */
    public function __construct(PaypalPaymentAppConfig $paypalPaymentAppConfig)
    {
        $this->paypalPaymentAppConfig = $paypalPaymentAppConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentMethodTransfer $paymentMethodTransfer
     * @param \Generated\Shared\Transfer\ExpressCheckoutConfigurationTransfer $expressCheckoutConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\ExpressCheckoutPaymentMethodTemplateTransfer
     */
    public function getPayPalCheckoutPaymentMethodTemplate(
        PaymentMethodTransfer $paymentMethodTransfer,
        ExpressCheckoutConfigurationTransfer $expressCheckoutConfigurationTransfer,
    ): ExpressCheckoutPaymentMethodTemplateTransfer {
        $paypalQueryParametersTransfer = $this->paypalPaymentAppConfig->getPaypalExpressCheckoutWidgetQueryParameters();
        $paypalScriptParametersTransfer = $this->paypalPaymentAppConfig->getPaypalExpressCheckoutWidgetScriptParameters();

        $paypalQueryParametersTransfer->setCurrency(
            $expressCheckoutConfigurationTransfer->getQuoteOrFail()->getCurrencyOrFail()->getCodeOrFail(),
        );

        $paypalQueryParametersTransfer->fromArray($paymentMethodTransfer->getPaymentMethodAppConfiguration()->getCheckoutConfiguration()->toArray(), true);

        return (new ExpressCheckoutPaymentMethodTemplateTransfer())
            ->setModuleName(static::MODULE_NAME_PAYPAL_PAYMENT_APP)
            ->setTemplateType(static::TEMPLATE_TYPE_MOLECULE)
            ->setTemplateName(static::TEMPLATE_NAME_PAYPAL_BUTTONS)
            ->setTemplateConfiguration(
                (new ExpressCheckoutPaymentMethodTemplateConfigurationTransfer())
                    ->setPaypalExpressCheckoutConfiguration((new PaypalExpressCheckoutConfigurationTransfer())
                        ->setPaypalQueryParameters($paypalQueryParametersTransfer)
                        ->setPaypalScriptParameters($paypalScriptParametersTransfer)
                        ->setRedirectUrls($expressCheckoutConfigurationTransfer->getRedirectUrls())
                        ->setPaymentMethod($paymentMethodTransfer)
                        ->setCsrfToken($expressCheckoutConfigurationTransfer->getCsrfToken())),
            );
    }
}
