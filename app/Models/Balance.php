<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Balance extends Model
{
    public $timestamps = false;

    public function deposit(float $value) : Array
    {
        DB::beginTransaction();

        $totalBefore = $this->amount ?: 0;
        $this->amount += number_format($value, 2, '.', '');
        $deposit = $this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'I',
            'amount' => $value,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd')
        ]);

        if ($deposit && $historic) {

            DB::commit();

            return [
                'success' => true,
                'message' => 'Sucesso ao recarregar'

            ];
        }

        if (!$deposit || !$historic) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Falha ao carregar'

            ];
        }
    }

    public function withdraw(float $value) : Array
    {
        DB::beginTransaction();

        if ($this->amount < $value) {

            return [
                'success' => false,
                'message' => 'Saldo insulficiênte'

            ];
        }

        $totalBefore = $this->amount ?: 0;
        $this->amount -= number_format($value, 2, '.', '');

        $withdraw =  $this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'O',
            'amount' => $value,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd')
        ]);

        if ($withdraw && $historic) {

            DB::commit();

            return [
                'success' => true,
                'message' => 'Sucesso ao retirar'

            ];
        }

        if (!$withdraw || !$historic) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Falha ao retirar'

            ];
        }
    }
}
