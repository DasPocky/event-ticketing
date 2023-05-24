<?php
namespace App\Enums;

enum PaymentStatusEnum:string {

    case Pending = 'pending';
    case RequiresPaymentMethod = 'requires_payment_method';
    case Confirmed = 'confirmed';

    case Failed = 'failed';
    case Cancelled = 'cancelled';

}
