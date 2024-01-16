<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp() : void
    {
        parent::setUp();
        
        DB::delete('DELETE FROM categories');
        DB::delete('DELETE FROM vouchers');
        DB::delete('DELETE FROM customers');
        DB::delete('DELETE FROM wallets');
    }
}
