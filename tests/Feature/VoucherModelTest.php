<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Database\Seeders\VoucherSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;

class VoucherModelTest extends TestCase
{
    public function testCreateVoucher()
    {
        $voucher = new Voucher();
        $voucher->name = "Example Voucer";
        $voucher->voucher_code = "EV0001";
        $voucher->save();

        assertNotNull($voucher->id);
    }

    public function testSoftDeleteVoucher()
    {
        $this->seed(VoucherSeeder::class);
        
        $voucher = Voucher::query()->where('name', 'Pulsa')->first();
        $voucher->delete();

        $voucher = Voucher::query()->where('name', 'Pulsa')->first();
        assertNull($voucher);

        $voucher = Voucher::withTrashed()->where('name', 'Pulsa')->first();
        assertNotNull($voucher);
    }

    public function testLocalScope()
    {
        $voucher = new Voucher();
        $voucher->name = "Promo";
        $voucher->is_active = true;
        $voucher->save();   
        
        $total = Voucher::active()->count();
        assertEquals(1, $total);

        $total = Voucher::nonActive()->count();
        assertEquals(0, $total);
    }
}
