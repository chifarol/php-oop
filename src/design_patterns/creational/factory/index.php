<?php

// factory classes often have a create method, which will return an instance of the said class/interface
// useful if you need a bunch if if-else statements to determine the class to use

namespace Chifarol\PhpOOP;

abstract class PaymentMethodCreator
{
    abstract public function getPaymentMethod(): PaymentMethodInterface;

    public function someOperation(): string
    {
        // Call the factory method to create a Payment object.
        $Payment = $this->getPaymentMethod();
        // Now, use the Payment.
        $result = "PaymentMethod: The same paymentMethod's code has just worked with " .
            $Payment->operation();

        return $result;
    }
}

class SelectPayment extends PaymentMethodCreator
{
    public function __construct(private string $category)
    {

    }

    public function getPaymentMethod(): PaymentMethodInterface
    {
        if ($this->category === "stripe") {

            return new StripePayment();
        } else {
            return new PaypalPayment();

        }
    }
}


interface PaymentMethodInterface
{
    public function operation(): string;
}


class StripePayment implements PaymentMethodInterface
{
    public function operation(): string
    {
        return "{Result of the StripePayment}";
    }
}

class PaypalPayment implements PaymentMethodInterface
{
    public function operation(): string
    {
        return "{Result of the PaypalPayment}";
    }
}


function clientCode(PaymentMethodCreator $paymentMethod)
{
    // ...
    echo "Client: I'm not aware of the paymentMethod's class, but it still works.\n"
        . $paymentMethod->someOperation();
    // ...
}


echo "<pre>";


echo "App: Launched with the paypal payment.\n";
echo (new SelectPayment("paypal"))->getPaymentMethod()->operation();
echo "\n\n";

echo "App: Launched with the stripe payment.\n";
echo (new SelectPayment("stripe"))->getPaymentMethod()->operation();
echo "\n\n";

echo "App: Launched with the ConcretePaymentMethod2.\n";
clientCode(new SelectPayment("stripe"));



echo "</pre>";