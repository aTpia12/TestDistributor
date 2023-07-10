<?php

namespace Tests\Feature\Customers;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteCustomerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_example(): void
    {
        $customer = Customer::factory()->create();

        $this->deleteJson(route('api.v1.customers.destroy', $customer))->assertNoContent();

        $this->assertDatabaseCount('customers', 0);
    }
}
