<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Yves\PaypalPaymentApp;

use Spryker\Yves\Kernel\AbstractFactory;
use SprykerEco\Yves\PaypalPaymentApp\Reader\PayPalExpressCheckoutPaymentMethodTemplateReader;
use SprykerEco\Yves\PaypalPaymentApp\Reader\PayPalExpressCheckoutPaymentMethodTemplateReaderInterface;

/**
 * @method \SprykerEco\Yves\PaypalPaymentApp\PaypalPaymentAppConfig getConfig()
 */
class PaypalPaymentAppFactory extends AbstractFactory
{
    /**
     * @return \SprykerEco\Yves\PaypalPaymentApp\Reader\PayPalExpressCheckoutPaymentMethodTemplateReaderInterface
     */
    public function createPayPalExpressCheckoutPaymentMethodTemplateReader(): PayPalExpressCheckoutPaymentMethodTemplateReaderInterface
    {
        return new PayPalExpressCheckoutPaymentMethodTemplateReader($this->getConfig());
    }
}
