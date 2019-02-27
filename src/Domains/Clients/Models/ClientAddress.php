<?php namespace AKCE\Clients\Models;

use Illuminate\Database\Eloquent\Model;
use  AKCE\Generic\Contracts\RelationshipsTrait as RelationshipsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientAddress extends Model {

    use RelationshipsTrait;
    use SoftDeletes;

    protected $fillable = ['client_id', 'type', 'address_1', 'address_2', 'city', 'country'];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships
}
