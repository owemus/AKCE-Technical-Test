<?php

namespace AKCE\Clients\Repositories;

use AKCE\Generic\Repositories\BaseRepository as BaseRepository;
use AKCE\Clients\Contracts\IClientAccountRepository as IClientAccountRepository;

use Validator as Validator;

class ClientAccountRepository extends BaseRepository implements IClientAccountRepository
{
    function __construct()
    {
        parent::__construct();
        $this->_model = "AKCE\Clients\Models\ClientAccount";
    }

    public function FindWithRelationships($id)
    {
        $model = $this->_model;
        $relationships = (new $model)->relationships();
        $returnRelationships = array();
        
        foreach ($relationships as $relationship => $info)
        {
            array_push($returnRelationships, $relationship);
        }

        return $model::with($returnRelationships)->find($id)->makeVisible('transactions');
    }
}