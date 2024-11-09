@extends('layouts.app')

@section('content')
<h1>Tambah Paket</h1>

<form action="{{ route('packages.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nama Paket</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="price">Harga</label>
        <input type="number" class="form-control" id="price" name="price" required>
    </div>
    <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
