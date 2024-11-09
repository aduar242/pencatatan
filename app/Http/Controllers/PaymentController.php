<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function store(Request $request, Client $client)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'client_id' => 'required|exists:clients,id'
        ]);

        $client = Client::findOrFail($validated['client_id']);

        // Catat pembayaran
        $payment = new Payment();
        $payment->client_id = $client->id;
        $payment->amount = $validated['amount'];
        $payment->save();

        // Perbarui tanggal jatuh tempo menjadi 1 bulan dari tanggal jatuh tempo saat ini
        $client->due_date = Carbon::parse($client->due_date)->addMonth();
        $client->payment_date = now();
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Pembayaran berhasil dicatat dan jatuh tempo diperbarui');
    }

    public function processPayment(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
        ]);
    
        // Temukan klien berdasarkan ID
        $client = Client::findOrFail($validated['client_id']);
    
        // Simpan data pembayaran
        Payment::create([
            'client_id' => $client->id,
            'amount' => $validated['amount'],
        ]);
    
        // Update `due_date` dengan menambahkan 1 bulan dari `due_date` saat ini
        $client->due_date = Carbon::parse($client->due_date)->addMonth();
        $client->payment_date = Carbon::now();
        $client->save();
    
        return redirect()->route('clients.index')->with('success', 'Data berhasil diperbarui.');
    }
        
}
