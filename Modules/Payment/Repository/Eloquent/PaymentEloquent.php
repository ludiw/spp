<?php

namespace Modules\Payment\Repository\Eloquent;

use Modules\Payment\Entities\Payment;
use Modules\Payment\Repository\PaymentRepository;

class PaymentEloquent implements PaymentRepository
{
    /** @var Payment */
    protected $payment;
    
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }
    
    public function all()
    {
        return $this->payment->all();
    }
}