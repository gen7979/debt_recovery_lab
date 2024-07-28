<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function calculate(Request $request)
    {
        // フォームからの入力データを取得
        $principal = $request->input('principal');           // 借入金額
        $interestRate = $request->input('interest_rate');    // 金利
        $monthlyPayment = $request->input('monthly_payment');// 毎月の返済金額

        // 返済計算ロジック
        $balance = $principal; // 残高を元金で初期化
        $months = 0; // 月数を初期化
        while ($balance > 0) { // 残高が0になるまでループ
            $interest = $balance * $interestRate / 100 / 12; // 毎月の利息を計算
            $balance += $interest - $monthlyPayment; // 利息を加え、月々の支払いを差し引く
            if ($monthlyPayment <= $interest) {
                // 月々の支払いが利息を下回る場合、返済が完了しないため、エラーを表示
                $error = "月々の支払い額が利息を下回っています。返済が完了しません。";
                return view('calculate', compact('error'));
            }
            $months++; // 月数をカウント
        }

        $data = [
            'months' => $months
        ];

        return view('calculate',['data' => $data]);
    }
}
