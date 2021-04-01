<?php

namespace App\Utils;

class Calculator
{
    /**
     * List of the fee types.
     *
     * @var array
     */
    protected $fee_types = [];

    public function __construct()
    {
        $this->fee_types = Constants::LOAN_FEE_TYPES;
    }

    /**
     * Calcaulate the  APR when adding a new loan.
     *
     * @return float the apr value calculated
     *
     * @param object $request request containing all the values
     */
    public function Apr($request): float
    {
        $fee = isset($this->fee_types[$request->type]) ? $this->fee_types[$request->type] : 0.00;

        $interest = $this->getInterest($request->loan_amount, $request->rate, $request->term);

        $quotient = $this->getQuotient($fee, $interest, $request->loan_amount);

        $apr = (($quotient / $request->term) * 365) * 100;

        return (float) $apr;
    }

    /**
     * calculate the quotient for the APR.
     *
     * @return int the calculation of the Quotient
     *
     * @param int   $fee       The fee amount based on the  loan type
     * @param float $interest  The in terest value fore the loan
     * @param float $principal The loan amount
     */
    private function getQuotient(int $fee, float $interest, float $principal): int
    {
        $quotient = ($fee + $interest) / $principal;

        return (int) $quotient;
    }

    /**
     * Calculate the interest.
     *
     * @return float the calculation of the Interest to be used in the loan
     *
     * @param float $loanAmount The amount of the loan
     * @param float $rate       Rate value
     * @param int   $term       The loan term
     */
    private function getInterest(float $loanAmount, float $rate, int $term): float
    {
        $interest = ($loanAmount * $rate * $term) / 100;

        return (float) $interest;
    }
}
