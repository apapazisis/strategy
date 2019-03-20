<?php

interface PaymentInterface
{
    public function sendPayment(Configuration $conf);
}

abstract class AbstractPayment implements PaymentInterface
{
    public function sendPayment(Configuration $conf)
    {
        $this->pay($conf);
    }
    
    abstract public function pay($conf);
}


class Paypal extends AbstractPayment
{
    public function pay($conf)
    {
        echo 'Pay with Paypal';
        echo $conf->id;
    }
}

class Bank extends AbstractPayment
{
    public function pay($conf)
    {
        echo 'Pay with Bank';
        echo $conf->id;
    }
}

class Factory
{
    private $arr = [
        1 => Bank::class,
        2 => Paypal::class
    ];    
    
    public function createPaymentObject(int $id)
    {
        return new $this->arr[$id];
    }
}

class Configuration
{
    public $id = 123;
}

$factory = new Factory();
$ob = $factory->createPaymentObject(2);
$configuration = new Configuration();
$configuration->id = 456;
$ob->sendPayment($configuration);
