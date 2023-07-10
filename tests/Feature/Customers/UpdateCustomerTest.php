<?php

namespace Tests\Feature\Customers;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateCustomerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_update_a_customer(): void
    {
        $customer = Customer::factory()->create();

        $response = $this->patchJson(route('api.v1.customers.update', $customer), [
                    'company_name' => 'Updated Test',
                    'contact_name' => 'Updated Test',
                    'email' => 'tes@test.com',
                    'phone' => '2234567892'
        ]);

        $response->assertOk();

        $response->assertExactJson([
            'data' => [
                'type' => 'customers',
                'id' => (string) $customer->getRouteKey(),
                'attributes' => [
                    'company_name' => 'Updated Test',
                    'contact_name' => 'Updated Test',
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
