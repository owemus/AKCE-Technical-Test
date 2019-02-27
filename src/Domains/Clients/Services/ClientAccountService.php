<?php

namespace AKCE\Clients\Services;

use AKCE\Generic\Services\BaseService as BaseService;
use AKCE\Clients\Contracts\IClientAccountService as IClientAccountService;
use AKCE\Clients\Contracts\IClientAccountRepository as IClientAccountRepository;

class ClientAccountService extends BaseService implements IClientAccountService
{
    function __construct(IClientAccountRepository $clientAccountRepository)
    {
        parent::__construct();
        $this->_repository = $clientAccountRepository;
    }

    public function Credit($data)
    {
        $lockedAccount = $this->_repository->FindAndLock($data["account_id"]);
        $lockedAccount->balance = $lockedAccount->getOriginal('balance') + $data["amount"];

        $this->_repository->UpdateAndUnlock($lockedAccount);

        return $this->_responseUtil->GenerateResponse(true, null, null, null);
    }

    public function Debit($data)
    {
        $lockedAccount = $this->_repository->FindAndLock($data["account_id"]);
        $lockedAccount->balance =  $lockedAccount->getOriginal('balance') - $data["amount"];

        $this->_repository->UpdateAndUnlock($lockedAccount);

        return $this->_responseUtil->GenerateResponse(true, null, null, null);
    }
}