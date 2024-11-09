@extends('layouts.app')

@section('content')
<h1>Tambah Klien</h1>

<form action="{{ route('clients.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="address">Alamat</label>
        <textarea class="form-control" id="address" name="address" required></textarea>
    </div>
    <div class="form-group">
        <label for="due_date">Tanggal Jatuh Tempo</label>
        <input type="date" class="form-control" id="due_date" name="due_date" required>
    </div>
    <div class="form-group">
        <label for="package_id">Paket</label>
        <select class="form-control" id="package_id" name="package_id" required>
            @foreach($packages as $package)
                <option value="{{ $package->id }}">{{ $package->name }} - {{ $package->price }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
