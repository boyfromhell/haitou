<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\BonusRequest;
use App\Models\Bonus;

class BonusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:bonus-mod');
    }

    public function index()
    {
        $bonus = Bonus::all();
        return view('staff.bonus.index', compact('bonus'));
    }

    public function create()
    {
        return view('staff.bonus.create');
    }

    public function store(BonusRequest $request)
    {
        $bonus = new Bonus();
        $bonus->name = $request->input('name');
        $bonus->cost = $request->input('cost');
        $bonus->bonus_type = $request->input('bonus_type');

        $bytes = $request->input('bytes');
        $value = $request->input('quantity');

        if (!empty($bytes)) {
            $bonus->bytes = $bytes;
            $bonus->quantity = $this->convert($value, $bytes);
        } else {
            $bonus->quantity = $value;
        }

        $bonus->save();

        toastr()->success('Novo bônus cadastrado.', 'Sucesso');
        return redirect()->to('staff/bonus');
    }

    private function convert($size, $unit)
    {
        $convert = null;

        if ($unit == 0) {
            $convert = round($size * 1024 * 1024, 4);
        }
        if ($unit == 1) {
            $convert = round($size * 1024 * 1024 * 1024, 4);
        }
        if ($unit == 2) {
            $convert = round($size * 1024 * 1024 * 1024 * 1024, 4);
        }
        return $convert;
    }

    public function edit($bonus_id)
    {
        $bon = Bonus::findOrFail($bonus_id);
        return view('staff.bonus.edit', compact('bon'));
    }

    public function update(BonusRequest $request, $bonus_id)
    {
        $bon = Bonus::findOrFail($bonus_id);
        $bon->name = $request->input('name');

        $cost = $request->input('cost');
        $bon->cost = $cost;
        $bon->bonus_type = $request->input('bonus_type');

        $bytes = $request->input('bytes');
        $value = $request->input('quantity');

        if (!empty($bytes)) {
            $bon->bytes = $bytes;
            $bon->quantity = $this->convert($value, $bytes);
        } else {
            $bon->quantity = $value;
        }

        $bon->update();
        toastr()->info('Bônus atualizado.', 'Sucesso');
        return redirect()->to('staff/bonus');
    }

    public function destroy($bonus_id)
    {
        Bonus::findOrFail($bonus_id)->delete();
        toastr()->warning('Bônus deletado.', 'Aviso');
        return redirect()->to('staff/bonus');
    }

    public function enableDisable($bonus_id)
    {
        $bon = Bonus::findOrFail($bonus_id);
        $bon->is_enabled = !$bon->is_enabled;
        $bon->save();
        toastr()->success('Bônus Ativado/Desativado', 'Aviso');
        return redirect()->to('staff/bonus');
    }
}
