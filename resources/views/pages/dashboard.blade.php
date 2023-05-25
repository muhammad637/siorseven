@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'dashboard', 'master' => 'home'])
    <div class="container-fluid py-4">
        <div class="row lg-justify-content-center sm-justify-content-start">
            <div class="col-xl-3 col-sm-6 col-md-4 mb-xl-0 mb-4 ms-5">
                <div class="card rounded-3" style="width: 16rem">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Komputer</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $komputers }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="badge bg-gradient-light text-sm font-weight-bolder">No Job</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="fa fa-desktop text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-4 mb-xl-0 mb-4 ms-5">
                <div class="card rounded-3" style="width: 16rem">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">JUMLAH PRINTER</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $printers }}
                                    </h5>
                                    <p class="mb-0">
                                        <span
                                            class="badge bg-gradient-warning text-sm font-weight-bolder badge-pill badge-sm">On
                                            Progress</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="fa fa-print text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-4 mb-xl-0 mb-4 ms-5">
                <div class="card rounded-3" style="width: 16rem">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">JUMLAH TEKNISI</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $users->count() }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="badge bg-transparant text-success text-sm font-weight-bolder">Orang</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- table --}}
        <div class="card my-4">
            <h4 class=" text-uppercase mt-4 mx-2">list Order Terakhir</h4>
            <hr>
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                tanggal order
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                ruangan
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                barang
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                status
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                keterangan  
                            </th>
                            <th class="text-secondary opacity-7 text-xxs font-weight-bolder opacity-7 text-uppercase">
                                Nama Teknisi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-uppercase">
                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    <p class="ps-3 text-xs font-weight-bold mb-0">{{ $order->user->nama }}</p>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">
                                        {{ $order->barang->jenis . ' ' . $order->barang->merk->merk . ' ' . $order->barang->tipe }}
                                    </p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if ($order->status == 'selesai')
                                        <p class="text-xs font-weight-bold mb-0">{{$order->status}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$order->status_selesai}}</p>
                                    @elseif ($order->status == 'on progress')
                                    <p class="text-xs font-weight-bold mb-0">{{$order->status}}</p>
                                    @else
                                    <p class="text-xs font-weight-bold mb-0">pending</p>
                                    @endif

                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                </td>
                                <td class="align-middle">
                                    <a href="" class="ms-4 badge bg-success" data-bs-toggle="modal"
                                        data-bs-target="#keterangan-{{$order->id}}"><i
                                            class="fa fa-envelope"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>


        @include('layouts.footers.auth.footer')
    </div>
    </section>
@endsection
