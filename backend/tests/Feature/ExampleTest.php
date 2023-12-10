<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testDoang()
    {
        Log::info(Carbon::parse("12-11-9")->setTime(23,59,59));
        self::assertTrue(true);
    }
}
