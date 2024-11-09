@extends('layouts.app')

@section('content')
<h1>Detail Klien</h1>

<p>Nama: {{ $client->name }}</p>
<p>Alamat: {{ $client->address }}</p>
<p>Tanggal Bayar: {{ $client->payment_date }}</p>
<p>Jatuh Tempo: {{ $client->due_date }}</p>
<p>Paket: {{ $client->package->name }} - {{ $client->package->price }}</p>

<a href="{{ route('clients.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
