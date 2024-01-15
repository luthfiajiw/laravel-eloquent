<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Database\Seeders\VoucherSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
}
