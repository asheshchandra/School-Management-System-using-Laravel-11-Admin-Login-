<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    protected $fillable = [
        'class_id',
        'academic_year_id',
        'fee_head_id',
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december',
    ];
    public function FeeHead()
    {
        return $this->belongsTo(FeeHead::class, 'fee_head_id');
    }
    public function AcademicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    public function classes()
    {
        return $this->belongsTo(classes::class, 'class_id');
    }
}
