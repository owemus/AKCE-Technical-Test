<?php

namespace AKCE\Clients\Services;

use AKCE\Generic\Services\BaseService as BaseService;
use AKCE\Clients\Contracts\IClientAddressService as IClientAddressService;
use AKCE\Clients\Contracts\IClientAddressRepository as IClientAddressRepository;

class ClientAddressService extends BaseService implements IClientAddressService
{
    function __construct(IClientAddressRepository $clientAddressRepository)
    {
        parent::__construct();
        $this->_repository = $clientAddressRepository;
    }
}