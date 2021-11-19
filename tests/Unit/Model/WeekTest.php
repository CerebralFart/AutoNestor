<?php

namespace Tests\Unit\Model;

use App\Models\Week;
use Tests\TestCase;

class WeekTest extends TestCase {
    private $wk40;
    private $wk50;

    public function __construct(?string $name = null, array $data = [], $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $this->wk40 = new Week();
        $this->wk40->fill(['id' => '2021-40']);
        $this->wk50 = new Week();
        $this->wk50->fill(['id' => '2021-50']);
    }

    public function testISOWeekAttribute(){
        $this->assertEquals(2021, $this->wk40->isoWeek->isoWeekYear);
        $this->assertEquals(40, $this->wk40->isoWeek->isoWeek);
        $this->assertEquals(2021, $this->wk50->isoWeek->isoWeekYear);
        $this->assertEquals(50, $this->wk50->isoWeek->isoWeek);
    }
    public function testStartAttribute() {
        $this->assertStringStartsWith('2021-10-04T', $this->wk40->start->toIso8601String());
        $this->assertStringStartsWith('2021-12-13T', $this->wk50->start->toIso8601String());
    }

    public function testEndAttribute() {
        $this->assertStringStartsWith('2021-10-10T', $this->wk40->end->toIso8601String());
        $this->assertStringStartsWith('2021-12-19T', $this->wk50->end->toIso8601String());
    }

    public function testWeeksUntil() {
        $this->assertEquals(10, $this->wk40->weeksUntil($this->wk50));
        $this->assertEquals(-10, $this->wk50->weeksUntil($this->wk40));
    }
}
