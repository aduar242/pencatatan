@extends('layouts.app')

@section('content')
<h1>Daftar Klien</h1>

<!-- Menampilkan pesan sukses jika ada -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Tambah Klien</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Tanggal Bayar</th>
            <th>Jatuh Tempo</th>
            <th>Paket</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $index => $client)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $client->name }}</td>
            <td>{{ $client->address }}</td>
            <td>{{ $client->payment_date ?? '-' }}</td>
            <td>{{ $client->due_date }}</td>
            <td>{{ $client->package->name }} - {{ $client->package->price }}</td>
            <td>
                @if($client->due_date < now())
                    <button class="btn btn-warning btn-sm" onclick="openPaymentModal({{ $client->id }}, '{{ $client->name }}')">Bayar</button>
                @endif
                <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal Pembayaran -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('payments.process') }}" method="POST" id="paymentForm">
                @csrf
                <!-- Input hidden untuk client_id -->
                <input type="hidden" name="client_id" id="client_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Konfirmasi Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin melakukan pembayaran untuk <span id="client_name"></span>?</p>
                    <div class="form-group">
                        <label for="amount">Jumlah Uang yang Dibayarkan</label>
                        <input type="number" class="form-control" name="amount" id="amount" required min="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    function openPaymentModal(clientId, clientName) {
        document.getElementById('client_id').value = clientId; // Mengisi client_id ke input hidden
        document.getElementById('client_name').innerText = clientName;
        $('#paymentModal').modal('show');
    }
</script>


@endsection
