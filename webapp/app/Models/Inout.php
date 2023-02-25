<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Org;

class Inout extends Model
{
    use HasFactory;

    protected $fillable = ['title_doc', 'number_doc', 'date_doc', 'user_id', 'sum'];

    protected $attributes = ['sum' => 0, 'total' => 0];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function org()
    {
        return $this->belongsTo(Org::class);
    }

    public function getBeforetotalAttribute()
    {
        $bi = self::where(['user_id' => $this->user_id, 'org_id' => $this->org_id])->where('id', '<', $this->id)->orderByDesc('id')->latest()->firstOr(function () {return new Inout;});
        return $bi->total;
    }

    public function getLasttotalAttribute()
    {
        $li = self::where(['user_id' => $this->user_id, 'org_id' => $this->org_id])->orderByDesc('id')->latest()->firstOr(function () {return new Inout;});
        return $li->total;
    }

    public function getBalanceAttribute()
    {
        return $this->lasttotal + $this->sum;
    }

    public function scopeGetBalances($query)
    {
        $a = DB::select(DB::raw('SELECT max(`id`) AS `mid` FROM `inouts` GROUP BY `org_id`,`user_id`'));
        $b = [];
        foreach ($a as $ae)
        {
            $b[] = $ae->mid;
        }
        return $query->whereIn('id', $b);
    }

    public function scopeLimitByUser($query)
    {
        $us = User::select('id')->limitAL()->get();
        $c = [];
        foreach ($us as $u)
        {
            $c[] = $u->id;
        }
        return $query->whereIn('user_id', $c);
    }
}
