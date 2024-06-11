<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    protected $appends = ['short_name'];

    public function getShortNameAttribute()
    {
        return trim(str_replace('Management',"", $this->name));
    }

    /**
     * Get all of the addon_subscription for the Feature
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addon_subscription()
    {
        return $this->hasMany(AddonSubscription::class)->withTrashed();
    }
}
