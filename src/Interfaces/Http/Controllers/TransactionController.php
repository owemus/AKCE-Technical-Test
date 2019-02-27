<?php 

namespace Interfaces\Http\Controllers;

use AKCE\Transactions\Contracts\ITransactionService as ITransactionService;
use AKCE\Clients\Contracts\IClientAccountService as IClientAccountService;

use Illuminate\Http\Request as Request;

class TransactionController extends BaseRESTController
{
    protected $_accountService;

    function __construct(ITransactionService $transactionService, IClientAccountService $clientAccountService)
    {
        parent::__construct();
        $this->_service = $transactionService;
        $this->_accountService = $clientAccountService;
    }

    public function Transfer(Request $request)
    {
        $this->_accountService->Debit(
            array(
                "account_id" => $request->debit_client_account_id, 
                "amount" => $request->amount
            )
        );

        $this->_accountService->Credit(
            array(
                "account_id" => $request->credit_client_account_id, 
                "amount" => $request->amount
            )
        );

        return $this->Insert($request);
    }
}
