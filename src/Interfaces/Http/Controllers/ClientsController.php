<?php 

namespace Interfaces\Http\Controllers;

use AKCE\Clients\Contracts\IClientService as IClientService;

class ClientsController extends BaseRESTController
{
    function __construct(IClientService $clientService)
    {
        parent::__construct();
        $this->_service = $clientService;
    }
}
