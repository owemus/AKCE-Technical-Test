<?php

namespace AKCE\Clients\Repositories;

use AKCE\Generic\Repositories\BaseRepository as BaseRepository;
use AKCE\Clients\Contracts\IClientAddressRepository as IClientAddressRepository;
use Validator as Validator;

class ClientAddressRepository extends BaseRepository implements IClientAddressRepository
{
    function __construct()
    {
        parent::__construct();
        $this->_model = "AKCE\Clients\Models\ClientAddress";
    }
}