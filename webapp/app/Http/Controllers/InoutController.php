<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Inout;
use App\Models\Org;
use App\Models\User;

class InoutController extends Controller
{

    public function show($id = 0)
    {
        if ($id > 0) {
            return view('inout', ['inouts' => [Inout::limitByUser()->findOrFail($id)]]);
        } else {
            return view('inout', ['inouts' => Inout::limitByUser()->orderByDesc('id')->paginate(10)]);
        }
    }

    public function show_balance()
    {
        /* универсальный одиночный запрос
         * SELECT * from `inouts` AS `b` INNER JOIN(SELECT max(`id`) as `mid` FROM `inouts` AS `a` GROUP BY `a`.`org_id`,`a`.`user_id`) AS `a` ON `a`.`mid`=`b`.`id`
        */
        return view('inout-balance', ['inouts'=> Inout::getBalances()->limitByUser()->paginate(10)]);
    }

    public function getkvit(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => ['required', 'numeric'],
            'org_id' => ['required', 'numeric']
        ]);
        $org = Org::findOrFail($validatedData['org_id']);
        $user = User::findOrFail($validatedData['user_id']);
        $qs = ["ST00012", "Name={$org->fintitle}","PersonalAcc={$org->personal_acc}", "BankName={$org->bank_name}", "BIC={$org->bic}", "CorrespAcc={$org->corresp_acc}", "PayeeINN={$org->inn}", "KPP={$org->kpp}", "CBC={$org->kbk}", "OKTMO={$org->oktmo}", "Purpose=ID {$user->id} {$org->purpose}", "DrawerStatus={$org->drawer_status}", "PersAcc={$user->id}"];
        $ms = implode('|',$qs);
        $pdf = PDF::loadView('pdf/kvit', ['org' => $org, 'user' => $user, 'ms' => $ms]);
        return $pdf->download('kvit.pdf');
    }

    public function edit()
    {
        if (in_array(Auth::user()->access_level, [2, 3, 4])) {
            return view('inout-add');
        }
    }

    public function store(Request $request)
    {
        if (in_array(Auth::user()->access_level, [2, 3, 4])) {
            $inout = new Inout;
            $validatedData = $request->validate([
                'title_doc' => ['required', 'string', 'max:64'],
                'number_doc' => ['required', 'string', 'max:64'],
                'date_doc' => ['required', 'date'],
                'user_id' => ['required', 'numeric'],
                'sum' => ['required', 'numeric']
            ]);
            $inout->fill($validatedData);
            $inout->org_id = Auth::user()->org_id;
            $inout->total = $inout->balance;
            $inout->save();
            return redirect()->route('inouts');
        }
    }
}
