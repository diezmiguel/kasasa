<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Utils\Calculator;
use App\Utils\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoanController extends Controller
{
    protected $calculate;

    public function __construct(Calculator $calculator)
    {
        $this->calculate = $calculator;
    }

    /**
     * Saves a new loan.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->messages(), 'success' => false], 400);
        }
        try {
            $loanModel = new Loan();
            $loanModel->name = $request->name;
            $loanModel->ssn = $request->ssn;
            $loanModel->dob = $request->dob;
            $loanModel->loan_amount = $request->loan_amount;
            $loanModel->rate = $request->rate;
            $loanModel->type = $request->type;
            $loanModel->term = $request->term;
            $loanModel->apr = $this->calculate->Apr($request);
            $loanModel->save();
            $response = ['msg' => Constants::SUCCESS_LOAN_ADDED, 'success' => true];
        } catch (\Exception $e) {
            Log::error('Error occurred:'.$e->getMessage());

            return response()->json(['msg' => Constants::ERROR_ADDING_LOAN, 'success' => false, 'execption' => $e->getMessage()], Constants::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json($response, Constants::HTTP_RESOURCE_CREATED);
    }

    /**
     * lists all loans in the system,.
     */
    public function list()
    {
        return response()->json(Loan::all());
    }

    /**
     * rules to be used in the validator.
     */
    private function rules()
    {
        return [
            'name' => 'required',
            'ssn' => 'required',
            'dob' => 'required|date_format:Y-m-d',
        ];
    }

    /**
     * Custome messages to be use with the validator.
     */
    private function messages()
    {
        return [
            'name.required' => 'Name is required',
            'ssn.required' => 'SSN is required',
            'dob.date_format' => 'Date format should be (yyyy-mm-dd)',
        ];
    }
}
