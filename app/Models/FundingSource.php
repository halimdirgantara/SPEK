<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundingSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'funding_source',
        'account_code',
        'budget',
    ];

    /**
     * Get the package that owns the funding source.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
