@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
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
                                        <span class="text-success text-sm font-weight-bolder">Orang</span>
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

        {{-- crousell --}}
        <div id="carouselExampleControls" class="carousel slide py-3 " data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item">
                    <div class="page-header min-vh-50 m-3 border-radius-xl"
                        style="background-image: url('https://images.unsplash.com/photo-1537511446984-935f663eb1f4?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1920&amp;q=80');">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 my-auto">
                                    <h4 class="text-white mb-0 fadeIn1 fadeInBottom">Pricing Plans</h4>
                                    <h1 class="text-white fadeIn2 fadeInBottom">Work with the rockets</h1>
                                    <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">Wealth creation is an
                                        evolutionarily recent positive-sum game. Status is an old zero-sum game. Those
                                        attacking wealth creation are often just seeking status.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="page-header min-vh-50 m-3 border-radius-xl"
                        style="background-image: url('https://images.unsplash.com/photo-1543269865-cbf427effbad?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1920&amp;q=80');">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 my-auto">
                                    <h4 class="text-white mb-0 fadeIn1 fadeInBottom">Our Team</h4>
                                    <h1 class="text-white fadeIn2 fadeInBottom">Work with the best</h1>
                                    <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">Free people make free choices.
                                        Free choices mean you get unequal outcomes. You can have freedom, or you can have
                                        equal outcomes. You can’t have both.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item active">
                    <div class="page-header min-vh-50 m-3 border-radius-xl"
                        style="background-image: url('https://images.unsplash.com/photo-1552793494-111afe03d0ca?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1920&amp;q=80');">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 my-auto">
                                    <h4 class="text-white mb-0 fadeIn1 fadeInBottom">Office Places</h4>
                                    <h1 class="text-white fadeIn2 fadeInBottom">Work from home</h1>
                                    <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">You’re spending time to save
                                        money when you should be spending money to save time.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid px-3">
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>
            <div class="min-vh-75 position-absolute w-100 top-0">
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon position-absolute bottom-50" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon position-absolute bottom-50" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
        {{-- end crousell --}}
        {{-- table --}}
        <div class="card">
            <h4 class=" text-uppercase mt-4 mx-2">list Order Terakhir</h4>
            <hr>
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Teknisi
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">barang
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                status</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                tanggal order</th>
                            <th class="text-secondary opacity-7 text-xxs font-weight-bolder opacity-7 text-uppercase">
                                keterangan</th>
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
