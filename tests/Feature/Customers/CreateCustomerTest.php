<?php

namespace Tests\Feature\Customers;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCustomerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_create_customers(): void
    {

        $response = $this->postJson(route('api.v1.customers.store'), [
            'data' => [
                'type' => 'customers',
                'attributes' => [
                    'company_name' => 'Company Test',
                    'contact_name' => 'Contact Test',
                    'email' => 'tes@test.com',
                    'phone' => '2234567892'
                ],
            ]
        ]);

        $response->assertCreated();

        $customer = Customer::first();

        $response->assertExactJson([
            'data' => [
                'type' => 'customers',
                'id' => (string) $customer->getRouteKey(),
                'attributes' => [
                    'company_name' => 'Company Test',
                    'contact_name' => 'Contact Test',
                    'email' => 'tes@test.com',
                    'phone' => '2234567892'
                ],
                'links' => [
                    'self' => route('api.v1.customers.show', $customer)
                ]
            ]
        ]);
    }
}
