<?php

namespace App\Utils;

class Constants
{
    //Loans MSGS
    const  SUCCESS_LOAN_ADDED = 'Loan added.';
    const  SUCCESS_LOAN_DELETED = 'Loan deleted';
    const  SUCCESS_LOAN_UPDATED = 'Loan updated';
    const  ERROR_ADDING_LOAN = 'There was an error adding your loan, please try again';

    //HTTP CODES
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_RESOURCE_CREATED = 201;

    const LOAN_FEE_TYPES = ['student' => 0.00, 'auto' => 500, 'personal' => 750, 'mertgage' => 1500];
}
