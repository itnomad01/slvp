<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Org;
use App\Models\Post;
use App\Scopes\ScopeTicketsByUser;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'org_id', 'post_id'];

    protected $attributes = ['user_id' => 0, 'org_id' => 0, 'post_id' => 0];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function org()
    {
        return $this->belongsTo(Org::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new ScopeTicketsByUser);
    }
}
