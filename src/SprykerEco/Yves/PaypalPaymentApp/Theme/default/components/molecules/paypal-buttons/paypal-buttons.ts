/* tslint:disable: no-any */
declare const paypal: any;
/* tslint:enable */

import Component from 'ShopUi/models/component';
import ScriptLoader from 'ShopUi/components/molecules/script-loader/script-loader';
import AjaxLoader from 'ShopUi/components/molecules/ajax-loader/ajax-loader';

interface OrderData {
    orderId: string;
    merchantId: string;
    payId: string;
}

export default class PaypalButtons extends Component {
    protected scriptLoader: ScriptLoader;
    protected ajaxLoader: AjaxLoader;
    protected buttonsContainer: HTMLElement;
    protected orderData: OrderData;

    protected readyCallback(): void {

    }

    protected init(): void {
        this.scriptLoader = <ScriptLoader>Array.from(this.getElementsByClassName(`${this.jsName}__script-loader`))[0];
        this.ajaxLoader = <AjaxLoader>Array.from(this.getElementsByClassName(`${this.jsName}__ajax-loader`))[0];
        this.buttonsContainer = <HTMLElement>Array.from(this.getElementsByClassName(`${this.jsName}__buttons-container`))[0];

        this.mapEvents();
    }

    protected mapEvents(): void {
        this.scriptLoader.addEventListener('scriptload', () => this.onPaypalScriptLoad(), {once: true});
    }

    protected onPaypalScriptLoad(): void {
        this.initPaypalButtons();
    }

    protected initPaypalButtons(): void {
        paypal.Buttons({
            createOrder: () => this.createOrder(),
            onApprove: (data) => this.handleTransaction(data, this.successUrl),
            onCancel: (data) => this.handleTransaction(data, this.cancelUrl),
            onError: (err) => this.handleTransaction(err, this.failureUrl),
        }).render(this.buttonsContainer);
    }

    protected async createOrder(): Promise<string> {
        const requestData = {
            paymentMethod: this.paymentMethod,
            paymentProvider: this.paymentProvider,
            _token: this.csrfToken,
        };

        const response = await fetch(this.preOrderPaymentUrl, {
            method: 'post',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(requestData),
        });

        const parsedResponse = await response.json();
        this.orderData = parsedResponse.content;

        this.setAttribute('csrf-token', parsedResponse.csrfToken);

        return this.orderData.orderId;
    }

    protected handleTransaction(data: any, redirectUrl: string): void {
        this.toggleLoaderVisibility(false);

        const queryString = new URLSearchParams(data).toString();
        const fullUrl = `${redirectUrl}?${queryString}`;
        window.location.assign(fullUrl);
    }

    protected toggleLoaderVisibility(isVisible: boolean): void {
        this.ajaxLoader.classList.toggle('is-invisible', !isVisible);
    }

    protected get preOrderPaymentUrl(): string {
        return this.getAttribute('pre-order-payment-url') || '';
    }

    protected get successUrl(): string {
        return this.getAttribute('success-url') || '';
    }

    protected get failureUrl(): string {
        return this.getAttribute('failure-url') || '';
    }

    protected get cancelUrl(): string {
        return this.getAttribute('cancel-url') || '';
    }

    protected get csrfToken(): string {
        return this.getAttribute('csrf-token') || '';
    }

    protected get paymentProvider(): string {
        return this.getAttribute('payment-provider') || '';
    }

    protected get paymentMethod(): string {
        return this.getAttribute('payment-method') || '';
    }
}
