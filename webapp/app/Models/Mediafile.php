<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Org;
use Illuminate\Support\Facades\Auth;

class Mediafile extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function (Mediafile $mediafile) {
            if (Auth::check()) {
                $mediafile->user_id = Auth::id();
                $mediafile->org_id = Auth::user()->org_id;
            }
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function org() {
        return $this->belongsTo(Org::class);
    }
}
