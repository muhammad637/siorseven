@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create Barang', 'master' => 'Master Data'])
    <div class="row mt-4 mx-4">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h5>List Barang</h5>
                <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modaltambah">
                    Tambah Barang
                </button>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="myTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipe
                                        Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis
                                        Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Merk Barang
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($barangs as $barang)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $barang->tipe }}</h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $barang->jenis }}</p>
                                        </td>

                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $barang->merk }}</p>
                                        </td>

                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $barang->status }}</p>
                                        </td>





                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center gap-1">
                                                <a href="#modaledit-{{ $barang->id }}" data-bs-toggle="modal"
                                                    class="badge bg-warning">edit</a>
                                                @if ($barang->status == 'aktif')
                                                    <form action="{{ route('nonaktif.barang', ['barang' => $barang->id]) }}"
                                                        method="post" class="inline-block"> 
                                                        @method('put')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger inline-block"><i
                                                                class="bi bi-x-circle"></i></button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('aktif.barang', ['barang' => $barang->id]) }}"
                                                        method="post">
                                                        @method('put')
                                                        @csrf
                                                        <button type="submit" class="btn btn-success"><i
                                                                class="bi bi-check2-circle"></i></button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modaledit-{{ $barang->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modaledittbarang" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modaleditbarang">Form Edit barang</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('update.barang', ['barang' => $barang->id]) }}"
                                                    method="post">
                                                    @method('put')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="">Tipe Barang</label>
                                                                <input class="form-control" name="tipe" type="text"
                                                                    value="{{ $barang->tipe }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="">Jenis Barang</label>
                                                                <input class="form-control" name="jenis" type="text"
                                                                    value="{{ $barang->jenis }}">
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="">Merk Barang</label>
                                                                <input class="form-control" name="merk" type="text"
                                                                    value="{{ $barang->merk }}">
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
                                                        <button type="button" class="btn bg-gradient-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn bg-gradient-primary">Save
                                                            asdaschanges</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
                    <h5 class="modal-title" id="modaltambahLabel">Form tambah barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('store.barang') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="Tipe Barang" name="tipe"
                                            type="text">
                                        <span class="input-group-text"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="Jenis Barang" name="jenis"
                                            type="text">
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
                                        <input class="form-control" placeholder="Merk Barang" name="merk"
                                            type="text">
                                        <span class="input-group-text"><i class="fa fa-user"
                                                aria-hidden="true"></i></span>
                                    </div>
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
