
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Notifikasi', 'master' => 'pages']) 
    <div class="row mt-4 mx-4">
    <div class="card info-card sales-card shadow" style="width: 98%">
    <div class="container my-4 font-poppins">
        <div class="row my-2 justify-content-between">
            <div class="col-md-8 col-12 ">
                <h5 class="fs-1 fw-semibold">Semua Notifikasi</h5>
            </div>
            <div class="col-md-4  col-12">
                
            </div>
        </div>
        @if (count($notifikasis) > 0)
            @foreach ($notifikasis as $notif)
                <div class="alert {{ $notif->status == 'berhasil' ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show" style="background-color: #FB6340;"
                    role="alert">
                    <div class="d-flex justify-content-between text-white">
                        <div class="">
                            <i
                                class="bi {{ $notif->nama_table == 'user' ? 'bi-people' : ($notif->nama_table == 'produk' ? 'bi-tag' : ($notif->nama_table == 'ruangan' ? 'bi-house' : 'bi-cart')) }}"></i>
                            ||

                            {{ $notif->msg }}
                            <i
                                class="bi {{ $notif->jenis_notifikasi == 'tambah' ? 'bi-add-circle' : ($notif->jenis_notifikasi == 'update' ? 'bi-subtract' : ($notif->jenis_notifikasi == 'aktif' ? 'bi-check-circle' : 'bi-x-circle')) }}"></i>
                        </div>
                        <div class="">
                            <span class="text-secondary">{{ Carbon\Carbon::parse($notif->created_at)->format('d M Y H:i:s') }}</span>
                        </div>
                    </div>

                    {{-- <form action="/notifikasi/{{ $notif->id }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn-close" aria-label="Close"></button>
                    </form> --}}
                </div>
            @endforeach

            <!-- Tampilkan pagination menggunakan komponen Bootstrap -->
            
        @else
            <h3 class="fs-2 font-poppins text-secondary text-center my-5">Notifikasi Kosong</h3>
        @endif
    </div>
</div>
</div>




    @endsection