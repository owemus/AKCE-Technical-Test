<?php

namespace AKCE\Transactions\Repositories;

use AKCE\Generic\Repositories\BaseRepository as BaseRepository;
use AKCE\Transactions\Contracts\ITransactionRepository as ITransactionRepository;
use Validator as Validator;

class TransactionRepository extends BaseRepository implements ITransactionRepository
{
    function __construct()
    {
        parent::__construct();
        $this->_model = "AKCE\Transactions\Models\Transaction";
    }
}