<?php 

namespace Interfaces\Http\Controllers;

use AKCE\Clients\Contracts\IClientAddressService as IClientAddressService;

class ClientAddressController extends BaseRESTController
{
    function __construct(IClientAddressService $clientAddressService)
    {
        parent::__construct();
        $this->_service = $clientAddressService;
    }
}
