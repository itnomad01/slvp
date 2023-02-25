<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Inout;
use App\Models\User;
use App\Models\Post;
use App\Models\Org;
use App\Models\Ticket;

class TicketController extends Controller
{
    public User $pu; // авторизованный пользователь-плательщик
    public Post $bp; // запись, на которую приобретается билет
    public Org $ot; // организация, в которой покупается билет
    public $fuserid; // для какого пользователя ID приобретается билет
    public $uobalance; // баланс между плательщиком и продавцом

    public function show(Request $request)
    {
        $this->pu = Auth::user();
        $validatedData = $request->validate([
            'user_id' => ['required', 'numeric', 'exists:App\Models\User,id'],
            'org_id' => ['required', 'numeric', 'exists:App\Models\Org,id'],
            'post_id' => ['required', 'numeric', 'exists:App\Models\Post,id']
        ]);
        $this->bp = Post::findOrFail($validatedData['post_id']);
        $this->ot = Org::findOrFail($validatedData['org_id']);
        $this->fuserid = $validatedData['user_id'];
        $ni = new Inout;
        $ni->user_id = $this->pu->id;
        $ni->org_id = $this->ot->id;
        $ni->sum = 0;
        $this->uobalance = $ni->balance;
        return view('ticket-buy', ['pu' => $this->pu, 'bp' => $this->bp, 'ot' => $this->ot, 'fuid' => $this->fuserid, 'uobalance' => $this->uobalance]);
    }

    public function store(Request $request)
    {
        $this->pu = Auth::user();
        $ticket = new Ticket;
        $ni = new Inout;
        $validatedData = $request->validate([
            'user_id' => ['required', 'numeric', 'exists:App\Models\User,id'],
            'org_id' => ['required', 'numeric', 'exists:App\Models\Org,id'],
            'post_id' => ['required', 'numeric', 'exists:App\Models\Post,id']
        ]);
        $this->bp = Post::findOrFail($validatedData['post_id']);
        $this->ot = Org::findOrFail($validatedData['org_id']);
        $this->fuserid = $validatedData['user_id'];
        $ni->user_id = $this->pu->id;
        $ni->org_id = $this->ot->id;
        $ni->sum = 0;
        $this->uobalance = $ni->balance;
        if ($this->uobalance >= $this->bp->price)
        {
            $ni->sum = -1 * $this->bp->price;
            $ni->total = $ni->balance;
            $ni->save();
            if ($ni->id > 0) {
                $ticket->fill($validatedData);
                $ticket->save();
                $ni->ticket_id = $ticket->id;
                $ni->save();
                return redirect()->route('posts', $this->bp->id);
            } else {
                return response(null, 403);
            }
        } else {
            return redirect()->route('home');
        }
    }
}
