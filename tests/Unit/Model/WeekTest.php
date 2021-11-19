<?php

namespace Tests\Unit\Model;

use App\Models\Week;
use Tests\TestCase;

class WeekTest extends TestCase {
    public function testWeeksUntil() {
        $wk40 = new Week();
        $wk40->fill(['id' => '2021-40']);
        $wk50 = new Week();
        $wk50->fill(['id' => '2021-50']);

        $this->assertEquals(10, $wk40->weeksUntil($wk50));
        $this->assertEquals(-10, $wk50->weeksUntil($wk40));
    }
}
