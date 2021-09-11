<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $id
 * @property-read Collection|Assignment[] $assignments
 * @property-read Carbon $start
 * @property-read Carbon $end
 * @property-read Week $next
 * @property-read Week $previous
 * @property-read string $label
 */
class Week extends Model {
    private static $_current = null;

    public static function current(): Week {
        if (self::$_current === null) {
            self::$_current = self::byDate(Carbon::now());
        }
        return self::$_current;
    }

    public static function byDate(Carbon $moment): Week {
        return Week::firstOrCreate([
            'id' => $moment->format('o-W'),
        ]);
    }

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['id'];

    public function weeksUntil(Week $week): int {
        $diff = $this->end->diff($week->end);
        $weeks = (int)ceil($diff->days / 7);
        return $weeks * $diff->invert === 1 ? -1 : 1;
    }

    public function getStartAttribute() {
        [$year, $week] = explode('-', $this->id);
        return (new Carbon)
            ->isoWeekYear($year)
            ->isoWeek($week)
            ->startOfWeek();
    }

    public function getEndAttribute() {
        [$year, $week] = explode('-', $this->id);
        return (new Carbon)
            ->isoWeekYear($year)
            ->isoWeek($week)
            ->endOfWeek();
    }

    public function getNextAttribute() {
        return self::byDate($this->end->addDay());
    }

    public function getPreviousAttribute() {
        return self::byDate($this->start->subDay());
    }

    public function getLabelAttribute() {
        $start = $this->start;
        $end = $this->end;
        return $start->month === $end->month ?
            sprintf('%d - %d %s.',
                $start->day,
                $end->day,
                $start->shortLocaleMonth
            ) :
            sprintf('%d %s. - %d %s.',
                $start->day,
                $start->shortLocaleMonth,
                $end->day,
                $end->shortLocaleMonth,
            );
    }

    public function assignments() {
        return $this->hasMany(Assignment::class);
    }
}
