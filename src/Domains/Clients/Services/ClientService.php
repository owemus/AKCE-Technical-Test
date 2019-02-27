<?php

namespace AKCE\Clients\Services;

use AKCE\Generic\Services\BaseService as BaseService;
use AKCE\Clients\Contracts\IClientService as IClientService;
use AKCE\Clients\Contracts\IClientRepository as IClientRepository;

class ClientService extends BaseService implements IClientService
{
    function __construct(IClientRepository $clientRepository)
    {
        parent::__construct();
        $this->_repository = $clientRepository;
    }
}