<?php namespace AKCE\Clients\Models;

use Illuminate\Database\Eloquent\Model;
use  AKCE\Generic\Contracts\RelationshipsTrait as RelationshipsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientAccount extends Model {

    use RelationshipsTrait;
    use SoftDeletes;

    protected $appends = array('status', 'transactions');
    protected $fillable = ['client_id', 'type', 'balance'];
    protected $hidden = array('debit_transactions', 'credit_transactions', 'transactions');

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

    public function getBalanceAttribute($value)
    {
        return abs($value);
    }

    public function getTransactionsAttribute()
    {
        return $this->debit_transactions->merge($this->credit_transactions);
    }

    public function getStatusAttribute($value)
    {
        if($this->getOriginal('balance') < 0)
        {
            return "DR";
        }
        else
        {
            return "CR";
        }
    }

    public function debit_transactions()
    {
        return $this->hasMany('AKCE\Transactions\Models\Transaction', 'debit_client_account_id');
    }
    
    public function credit_transactions()
    {
        return $this->hasMany('AKCE\Transactions\Models\Transaction', 'credit_client_account_id');
    }
}
