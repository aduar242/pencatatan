@extends('layouts.app')

@section('content')
<h1>Daftar Paket</h1>

<a href="{{ route('packages.create') }}" class="btn btn-primary">Tambah Paket</a>

@foreach ($packages as $package)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $package->name }}</h5>
            <p class="card-text">Harga: {{ $package->price }}</p>
            <p class="card-text">{{ $package->description }}</p>

            <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-primary">Edit</a>

            <form action="{{ route('packages.destroy', $package->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
@endforeach
@endsection
