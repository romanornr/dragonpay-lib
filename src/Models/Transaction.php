<?php

namespace DragonPay\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * @package DragonPay
 */
class Transaction extends Model
{
    /**
     * table transactions
     * @var string
     */
    protected $table = 'transactions';

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Disable timestamps
     * @var bool
     */
    public $timestamps = false;

}
