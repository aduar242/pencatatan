<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Package;
use Illuminate\Http\Request;
use Carbon\Carbon; // Tambahkan ini di atas file jika belum

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('package')->get();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        $packages = Package::all();
        return view('clients.create', compact('packages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'due_date' => 'required|date',
            'package_id' => 'required|exists:packages,id',
        ]);
    
        // Tambahkan payment_date sebagai tanggal sekarang saat membuat klien
        Client::create(array_merge($validated, ['payment_date' => Carbon::now()]));
    
        return redirect()->route('clients.index');
    }
    

    public function show($id)
    {
        $client = Client::with('package')->findOrFail($id);
        return view('clients.show', compact('client'));
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $packages = Package::all();
        return view('clients.edit', compact('client', 'packages'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'due_date' => 'required|date',
            'package_id' => 'required|exists:packages,id',
        ]);

        $client = Client::findOrFail($id);
        $client->update($validated);

        return redirect()->route('clients.index');
    }

    public function destroy($id)
    {
        Client::destroy($id);
        return redirect()->route('clients.index');
    }
}
