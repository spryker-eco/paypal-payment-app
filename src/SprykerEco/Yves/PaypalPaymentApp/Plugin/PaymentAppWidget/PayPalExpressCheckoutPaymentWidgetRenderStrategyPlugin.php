<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\PaypalPaymentApp\Plugin\PaymentAppWidget;

use Generated\Shared\Transfer\ExpressCheckoutConfigurationTransfer;
use Generated\Shared\Transfer\ExpressCheckoutPaymentMethodTemplateTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Spryker\Yves\Kernel\AbstractPlugin;
use SprykerShop\Yves\PaymentAppWidgetExtension\Dependency\Plugin\ExpressCheckoutPaymentWidgetRenderStrategyPluginInterface;

/**
 * @method \SprykerShop\Yves\MerchantProductWidget\MerchantProductWidgetFactory getFactory()
 */
class PayPalExpressCheckoutPaymentWidgetRenderStrategyPlugin extends AbstractPlugin implements ExpressCheckoutPaymentWidgetRenderStrategyPluginInterface
{

    public function isApplicable(
        PaymentMethodTransfer $paymentMethodTransfer,
        ExpressCheckoutConfigurationTransfer $expressCheckoutConfigurationTransfer
    ): bool {
        // TODO: Implement isApplicable() method.
    }

    public function getTemplate(
        PaymentMethodTransfer $paymentMethodTransfer,
        ExpressCheckoutConfigurationTransfer $expressCheckoutConfigurationTransfer
    ): ExpressCheckoutPaymentMethodTemplateTransfer {
        // TODO: Implement getTemplate() method.
    }
}
