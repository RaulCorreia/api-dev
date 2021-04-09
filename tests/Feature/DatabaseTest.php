<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     *
     * @return void
     */
    public function tablesTest(): void
    {
        $tables = DB::select('SHOW TABLES');
        $this->assertCount(7, $tables);
    }

    /**
     * @test
     *
     * @return void
     */
    public function tablesStateTest(): void
    {
        $this->assertDatabaseCount('states', 27);
    }

}
