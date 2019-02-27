<?php

namespace AKCE\Transactions\Services;

use AKCE\Generic\Services\BaseService as BaseService;
use AKCE\Transactions\Contracts\ITransactionService as ITransactionService;
use AKCE\Transactions\Contracts\ITransactionRepository as ITransactionRepository;

class TransactionService extends BaseService implements ITransactionService
{
    function __construct(ITransactionRepository $transactionRepository)
    {
        parent::__construct();
        $this->_repository = $transactionRepository;
    }
}