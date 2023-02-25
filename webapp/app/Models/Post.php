<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mediafile;
use App\Models\User;
use App\Models\Org;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    public function picture() {
        return $this->belongsTo(Mediafile::class);
    }

    public function video() {
        return $this->belongsTo(Mediafile::class);
    }

    public function videopriview() {
        return $this->belongsTo(Mediafile::class);
    }

    public function getStreamStringAttribute() {
        return "{$this->stream_name}/{$this->stream_token}";
    }

    public function getCvAttribute() {
        return $this->cv_before + $this->cv_live + $this->cv_after;
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function org() {
        return $this->belongsTo(Org::class);
    }

    protected static function booted()
    {
        static::creating(function (Post $post) {
            $post->user_id = Auth::id();
            $post->org_id = Auth::user()->org_id;
            $post->stream_name = Str::uuid();
            $post->stream_token = Str::random(32);
        });
    }
}
