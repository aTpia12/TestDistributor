<?php

namespace Tests\Feature\Customers;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListCustomersTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_fetch_a_single_customer(): void
    {
        $customer = Customer::factory()->create();

        $response = $this->getJson(route('api.v1.customers.show', $customer->getRouteKey()));

        $response->assertExactJson([
            'data' => [
                'type' => 'customers',
                'id' => (string) $customer->getRouteKey(),
                'attributes' => [
                    'company_name' => $customer->company_name,
                    'contact_name' => $customer->contact_name,
                    'email' => $customer->email,
                    'phone' => $customer->phone
                ],
                'links' => [
                    'self' => route('api.v1.customers.show', $customer->getRouteKey())
                ]
            ]
        ]);
    }

    /** @test */
    public function can_fetch_all_customers()
    {
        $this->withoutExceptionHandling();
        $customers = Customer::factory()->count(3)->create();

        $response = $this->getJson(route('api.v1.customers.index'));

        $response->assertExactJson([
            'data' => [
                [
                    'type' => 'customers',
                    'id' => (string) $customers[0]->getRouteKey(),
                    'attributes' => [
                        'company_name' => $customers[0]->company_name,
                        'contact_name' => $customers[0]->contact_name,
                        'email' => $customers[0]->email,
                        'phone' => $customers[0]->phone
                    ],
                    'links' => [
                        'self' => route('api.v1.customers.show', $customers[0]->getRouteKey())
                    ]
                ],
                [
                    'type' => 'customers',
                    'id' => (string) $customers[1]->getRouteKey(),
                    'attributes' => [
                        'company_name' => $customers[1]->company_name,
                        'contact_name' => $customers[1]->contact_name,
                        'email' => $customers[1]->email,
                        'phone' => $customers[1]->phone
                    ],
                    'links' => [
                        'self' => route('api.v1.customers.show', $customers[1]->getRouteKey())
                    ]
                ],
                [
                    'type' => 'customers',
                    'id' => (string) $customers[2]->getRouteKey(),
                    'attributes' => [
                        'company_name' => $customers[2]->company_name,
                        'contact_name' => $customers[2]->contact_name,
                        'email' => $customers[2]->email,
                        'phone' => $customers[2]->phone
                    ],
                    'links' => [
                        'self' => route('api.v1.customers.show', $customers[2]->getRouteKey())
                    ]
                ]
            ]
        ]);
    }
}
