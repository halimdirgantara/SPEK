<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'account_number',
        'type',
        'parent_id',
        'organization_id',
        'created_by',
    ];

    /**
     * Get the organization that owns the program activity.
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the user who created the program activity.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the parent program activity.
     */
    public function parent()
    {
        return $this->belongsTo(ProgramActivity::class, 'parent_id');
    }

    /**
     * Get the children program activities.
     */
    public function children()
    {
        return $this->hasMany(ProgramActivity::class, 'parent_id');
    }
}
