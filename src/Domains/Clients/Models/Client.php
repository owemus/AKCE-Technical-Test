<?php namespace AKCE\Clients\Models;

use Illuminate\Database\Eloquent\Model;
use  AKCE\Generic\Contracts\RelationshipsTrait as RelationshipsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model {

    use RelationshipsTrait;
    use SoftDeletes;

    protected $fillable = ['name', 'surname'];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

    public function accounts()
    {
        return $this->hasMany('AKCE\Clients\Models\ClientAccount');
    }

    public function addresses()
    {
        return $this->hasMany('AKCE\Clients\Models\ClientAddress');
    }
}
