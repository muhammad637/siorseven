@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create Barang', 'master' => 'Master Data'])
    <div class="row mt-4 mx-4">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h5>List Order</h5>
                <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modaltambah">
                    Tambah Order
                </button>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="myTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Teknisi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kerusakan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Pesan Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Selesai
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        No HandPhone
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Pesan
                                    </th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $order->user->nama }}</h6>
                                                </div>
                                            </div>
                                           
                                        </td>

                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $order->barang->jenis }}</p>
                                        </td>

                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $order->pesan_kerusakan }}</p>
                                        </td>

                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $order->status }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $order->pesan_status }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $order->created_at }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $order->tanggal_selesai }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$order->user->no_telephone}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$order->user->pesan_status
                                            }}</p>
                                        </td>
                                    </tr>
                                  
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Tambah User -->
    <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="modaltambahLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaltambahLabel">Form Tambah Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('store.order') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <select class="form-control" name="user_id"
                                            type="text">
                                        <option value="">Pilih Teknisi</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->nama}}</option>
                                        @endforeach
                                        </select>
                                        <span class="input-group-text"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <select class="form-control" name="barang_id"
                                            type="text">
                                        <option value="">Pilih Barang</option>
                                        @foreach ($barangs as $barang)
                                            <option value="{{$barang->id}}">{{$barang->jenis}} {{$barang->tipe}} {{$barang->merk->merk}}</option>
                                        @endforeach
                                        </select>
                                        <span class="input-group-text"><i class="fa fa-key"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="Kerusakan Barang" name="pesan_kerusakan"
                                            type="text" value="matot">
                                        <span class="input-group-text"><i class="fa fa-hand-rock-o" aria-hidden="true"></i></span>
                                    </div>
                                    {{-- <div class="input-group mb-4">
                                        <input class="form-control" placeholder="No Handphone" name="no_telephone"
                                            type="number">
                                        <span class="input-group-text"><i class="fa fa-mobile" aria-hidden="true"></i></i></span>
                                    </div> --}}
                                </div>
                            </div>
                            
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="S" name="status" type="text">
                                        <span class="input-group-text"><i class="fa fa-id-card"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div> --}}

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Save asdaschanges</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
