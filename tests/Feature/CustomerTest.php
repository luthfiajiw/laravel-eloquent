<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Wallet;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\VirtualAccountSeeder;
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

    public function testInsertRelationship()
    {
        $customer = new Customer();
        $customer->id = "LAW";
        $customer->name = "Luthfi";
        $customer->email = "law@mail.com";
        $customer->save();
        assertNotNull($customer);
        
        $wallet = new Wallet();
        $wallet->amount = 100000;
        $customer->wallet()->save($wallet);
    }

    public function testHashOneThrough()
    {
        $this->seed([CustomerSeeder::class, WalletSeeder::class, VirtualAccountSeeder::class]);
        
        $customer = Customer::find('LAW');
        assertNotNull($customer);

        $virtualAccount = $customer->virtualAccount;
        assertNotNull($virtualAccount);
        assertEquals('BCA', $virtualAccount->bank);
    }

}
