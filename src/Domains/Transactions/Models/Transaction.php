<?php namespace AKCE\Transactions\Models;

use Illuminate\Database\Eloquent\Model;
use  AKCE\Generic\Contracts\RelationshipsTrait as RelationshipsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model {

    use RelationshipsTrait;
    use SoftDeletes;

    protected $fillable = ['debit_client_account_id', 'credit_client_account_id', 'amount', 'message'];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];
}
