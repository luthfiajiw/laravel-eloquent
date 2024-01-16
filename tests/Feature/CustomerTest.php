<?php

namespace Tests\Feature;

use App\Models\Customer;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\WalletSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

class CustomerTest extends TestCase
{
    
    public function testOneToOne(): void
    {
        $this->seed([CustomerSeeder::class, WalletSeeder::class]);

        $customer = Customer::find("LAW");
        assertNotNull($customer);

        // Wallet::where('customer_id', $customer->id)->first();
        $wallet = $customer->wallet;
        assertNotNull($wallet);
        assertEquals(100000, $wallet->amount);
    }
}
