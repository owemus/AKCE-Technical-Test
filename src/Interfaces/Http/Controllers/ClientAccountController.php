<?php 

namespace Interfaces\Http\Controllers;

use AKCE\Clients\Contracts\IClientAccountService as IClientAccountService;

class ClientAccountController extends BaseRESTController
{
    function __construct(IClientAccountService $clientAccountService)
    {
        parent::__construct();
        $this->_service = $clientAccountService;
    }
}
