<?php

namespace App\Services;

use App\Loan;
use App\Utils\Calculator;

class LoanService
{
    public function saveLoan($request)
    {
        $loanModel = new Loan();
        $calculator = new Calculator();
        $loanModel->name = $request->name;
        $loanModel->ssn = $request->ssn;
        $loanModel->dob = $request->dob;
        $loanModel->loan_amount = $request->loan_amount;
        $loanModel->rate = $request->rate;
        $loanModel->type = $request->type;
        $loanModel->term = $request->term;
        $loanModel->apr = $calculator->Apr($request);
        $loanModel->save();
    }
}
