@extends('layouts.app')

@section('content')
<h1>Edit Klien</h1>

<form action="{{ route('clients.update', $client->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}" required>
    </div>
    <div class="form-group">
        <label for="address">Alamat</label>
        <textarea class="form-control" id="address" name="address" required>{{ $client->address }}</textarea>
    </div>
    <div class="form-group">
        <label for="due_date">Tanggal Jatuh Tempo</label>
        <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $client->due_date }}" required>
    </div>
    <div class="form-group">
        <label for="package_id">Paket</label>
        <select class="form-control" id="package_id" name="package_id" required>
            @foreach($packages as $package)
                <option value="{{ $package->id }}" {{ $client->package_id == $package->id ? 'selected' : '' }}>{{ $package->name }} - {{ $package->price }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
