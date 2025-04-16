@extends('layouts.app')
@section('content')
<div class="text-center mt-5">
    <h3>Scan QR Code untuk Lapor Kerusakan</h3>
    <div class="mt-4">
        {!! $qr !!}
    </div>
</div>
@endsection
