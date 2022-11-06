<?php

namespace App\Models;

use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPremium extends Model
{
    use HasFactory;

    protected $table = 'user_premiums';

    protected $fillable = [
        'package_id',
        'user_id',
        'end_of_subscription'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
