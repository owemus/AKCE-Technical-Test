<?php

namespace AKCE\Clients\Repositories;

use AKCE\Generic\Repositories\BaseRepository as BaseRepository;
use AKCE\Clients\Contracts\IClientRepository as IClientRepository;
use Validator as Validator;

class ClientRepository extends BaseRepository implements IClientRepository
{
    function __construct()
    {
        parent::__construct();
        $this->_model = "AKCE\Clients\Models\Client";
    }
}