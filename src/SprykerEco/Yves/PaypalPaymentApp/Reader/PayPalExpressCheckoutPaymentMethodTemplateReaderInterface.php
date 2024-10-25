<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Yves\PaypalPaymentApp\Reader;

use Generated\Shared\Transfer\ExpressCheckoutConfigurationTransfer;
use Generated\Shared\Transfer\ExpressCheckoutPaymentMethodTemplateTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;

interface PayPalExpressCheckoutPaymentMethodTemplateReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentMethodTransfer $paymentMethodTransfer
     * @param \Generated\Shared\Transfer\ExpressCheckoutConfigurationTransfer $expressCheckoutConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\ExpressCheckoutPaymentMethodTemplateTransfer
     */
    public function getPayPalCheckoutPaymentMethodTemplate(
        PaymentMethodTransfer $paymentMethodTransfer,
        ExpressCheckoutConfigurationTransfer $expressCheckoutConfigurationTransfer,
    ): ExpressCheckoutPaymentMethodTemplateTransfer;
}
