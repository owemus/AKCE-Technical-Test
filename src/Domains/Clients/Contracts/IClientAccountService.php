<?php

namespace AKCE\Clients\Contracts;

use AKCE\Generic\Contracts\IBaseService as IBaseService;

interface IClientAccountService extends IBaseService
{
    public function Credit($data);
    public function Debit($data);
}