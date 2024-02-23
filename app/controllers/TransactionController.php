<?php

namespace App\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Leaf\Controller;
use Leaf\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->request = new Request;
    }

    public function make()
    {
        $data = [
            'source_user_id' => $this->request->get('source_user_id'),
            'target_user_id' => $this->request->get('target_user_id'),
            'amount' => $this->request->get('amount'),
        ];

        $validated = form()->validate($data, [
            'source_user_id' => 'required',
            'target_user_id' => 'required',
            'amount' => 'required',
        ]);

        if ($validated) {
            $sourceUser = User::find($data['source_user_id']);
            $targetUser = User::find($data['target_user_id']);

            if ($sourceUser->balance >= $data['amount']) {
                $sourceUser->balance = $sourceUser->balance - $data['amount'];
                $targetUser->balance = $targetUser->balance + $data['amount'];
                $sourceUser->save();
                $targetUser->save();

                $transaction = new Transaction();
                $transaction->source_user_id = $data['source_user_id'];
                $transaction->target_user_id = $data['target_user_id'];
                $transaction->amount = $data['amount'];
                $transaction->transaction_date = date('Y-m-d H:i:s');

                if ($transaction->save()) {
                    response()->json([
                        'success' => true,
                        'message' => "Para transferi başarıyla gerçekleşti."
                    ]);
                }
            } else {
                response()->json([
                    'success' => false,
                    'message' => "Yetersiz bakiye."
                ]);
            }
        }
    }

    public function history()
    {
        response()->json([
            'success' => true,
            'data' => Transaction::query()->where('source_user_id', 1)->get()
        ]);
    }
}