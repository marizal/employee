<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoudation\Response;
use Validator;

class TransactionController extends Controller

{
    public function index()
    {
        // fungsi mengambil data transaksi berdasarkan time descending
        $transaction = Transaction::orderBy('time','DESC')->get();
        $response = [
            'message' => 'list transaction order by time',
            'data' => $transaction,
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'title' => 'required',
                'amount' => 'required|numeric',
                'type' => 'required','in:expense,revenue'
            ]);

            if($validator->fails()){
                return response()->json($validator->errors(),422);
            }

            $transaction = Transaction::create($request->all());
            $response = [
                'message' => 'Transaction Created',
                'data' => $transaction
            ];

            return response()->json($response, 201);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed' . $e->errorInfo()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            $validator = Validator::make($request->all(),[
                'title' => 'required',
                'amount' => 'required|numeric',
                'type' => 'required','in:expense,revenue'
            ]);

            if($validator->fails()){
                return response()->json($validator->errors(),422);
            }

            $transaction->update($request->all());
            $response = [
                'message' => 'Transaction been Update',
                'data' => $transaction
            ];

            return response()->json($response, 200);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed' . $e->errorInfo()
            ]);
        }
    }

    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        $response = [
            'message' => 'Detail of Transaction By id ',
            'data' => $transaction
        ];
        return response()->json($response, 200);
    }

    public function destroy($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            $transaction->delete();
            $response = [
                'message' => 'Transaction Deleted'
            ];
            return response()->json($response, 200);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed' . $e->errorInfo()
            ]);
        }
    }
}
