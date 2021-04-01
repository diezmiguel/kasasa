<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'loan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'ssn', 'dob', 'loan_amount', 'rate', 'type', 'term', 'apr',
    ];

    protected $hidden = [];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
