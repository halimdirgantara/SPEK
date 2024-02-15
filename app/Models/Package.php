<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_code',
        'package_name',
        'institution_name',
        'work_unit',
        'budget_year',
        'work_location',
        'work_volume',
        'work_description',
        'work_specifications',
        'domestic_products',
        'small_business',
        'spp_economic_aspect',
        'spp_social_aspect',
        'spp_environmental_aspect',
        'pre_dipa_dpa',
        'total_budget',
        'procurement_type',
        'procurement_method',
        'utilization_start',
        'utilization_end',
        'contract_start',
        'contract_end',
        'provider_selection_start',
        'provider_selection_end',
        'package_update_date',
    ];

    /**
     * Get the funding sources for the package.
     */
    public function fundingSources()
    {
        return $this->hasMany(FundingSource::class);
    }
}
