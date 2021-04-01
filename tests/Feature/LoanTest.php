<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoanTest extends TestCase
{
    public function SetUp(): void
    {
        parent::setUp();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_see_loans()
    {
        $response = $this->get('/api/loan/list', ['authToken' => env('SECRET_KEY')]);

        $response->assertStatus(200);
    }

    public function test_can_save_new_loan()
    {
        $data = [
        'name' => 'miguelito',
        'ssn' => 123456789,
        'dob' => '2021-10-10',
        'loan_amount' => 1000,
        'rate' => 2.25,
        'type' => 'auto',
        'term' => 720,
        ];
        $response = $this->post('/api/loan/add', $data, ['authToken' => env('SECRET_KEY')]);

        $response->assertStatus(201);
    }

    public function test_can_save_new_loan_without_required_fileds()
    {
        $data = [
        'ssn' => 123456789,
        'dob' => '2021-10-10',
        'loan_amount' => 1000,
        'rate' => 2.25,
        'type' => 'auto',
        'term' => 720,
        ];
        $response = $this->post('/api/loan/add', $data, ['authToken' => env('SECRET_KEY')]);
        $response->assertStatus(400);
    }
}
