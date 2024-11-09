@extends('layouts.app')

@section('content')
<h1>Invoice Pembayaran</h1>

<p>Nama: {{ $client->name }}</p>
<p>Jumlah: {{ $client->package->price }}</p>
<p>Tanggal Pembayaran: {{ now() }}</p>

<a href="{{ route('clients.index') }}" class="btn btn-secondary">Kembali ke Daftar Klien</a>
@endsection
