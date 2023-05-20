@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Barang', 'master' => 'Master Data'])
    <div class="row mt-4 mx-4">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h5>List Barang</h5>
                <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modaltambah">
                    Tambah
                </button>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 text-center table-striped" id="myTable">
                            <thead>
                                <tr class="text-center">
                                    <th
                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Jenis
                                        Barang</th>
                                    <th
                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7  ps-2">
                                        Merk Barang
                                    </th>
                                    <th
                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Tipe
                                        Barang</th>
                                    <th
                                        class="text-center text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Aksi</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($barangs as $barang)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm text-uppercase">{{ $barang->jenis }}</h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <p class="text-sm text-uppercase font-weight-bold mb-0">
                                                {{ $barang->merk->merk }}</p>
                                        </td>

                                        <td>
                                            <p class="text-sm text-uppercase font-weight-bold mb-0">{{ $barang->tipe }}</p>
                                        </td>

                                        <td>
                                            <span
                                                class="text-center badge badge-sm {{ $barang->status == 'nonaktif' ? 'bg-gradient-secondary' : 'bg-gradient-success' }}">{{ $barang->status }}</span>
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
                                                        <button type="submit" class="badge bg-gradient-danger border-0"><i
                                                                class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('aktif.barang', ['barang' => $barang->id]) }}"
                                                        method="post">
                                                        @method('put')
                                                        @csrf
                                                        <button type="submit" class="badge bg-gradient-success border-0"><i
                                                                class="fa fa-check-circle-o"
                                                                aria-hidden="true"></i></button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- modal edit --}}
                                    <div class="modal fade" id="modaledit-{{ $barang->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modaledittbarang" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-capitalize" id="modaleditbarang">Form Edit
                                                        barang</h5>
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
                                                                <label for="">Jenis Barang</label>
                                                                <div class="input-group mb-4">
                                                                    <select class="form-control text-capitalize"
                                                                        name="jenis" id="">
                                                                        <option class="text-uppercase" value="komputer"
                                                                            {{ $barang->jenis == 'komputer' ? 'selected' : '' }}>
                                                                            komputer</option>
                                                                        <option class="text-uppercase" value="printer"
                                                                            {{ $barang->jenis == 'printer' ? 'selected' : '' }}>
                                                                            printer</option>
                                                                    </select>
                                                                    <span class="input-group-text">
                                                                        <i class="fa fa-arrows-v"
                                                                            aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="">Merk Barang</label>
                                                                <div class="input-group mb-4">
                                                                    {{-- <input type="text" class="form-control" name="merk" placeholder="merk barang .." > --}}
                                                                    <select class="form-control text-capitalize"
                                                                        name="merk_id" id="merk-{{ $barang->id }}">
                                                                        @foreach ($merks as $merk)
                                                                            <option value="{{ $merk->id }}"
                                                                                {{ $barang->merk->merk == $merk->merk ? 'selected' : '' }}
                                                                                class="text-uppercase">
                                                                                {{ $merk->merk }}</option>
                                                                        @endforeach
                                                                        <option value="other">lainnya ...</option>
                                                                    </select>
                                                                    <span class="input-group-text">
                                                                        <i class="fa fa-exchange"
                                                                            aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group" id="merk_other-{{ $barang->id }}"
                                                                    style="display:none;">
                                                                    <label for="other" class="text-capitalize">merk
                                                                        Barang Lainnya</label>
                                                                    <div class="input-group mb-4">
                                                                        <input class="form-control"
                                                                            placeholder="Merk Barang ..." name="merk"
                                                                             type="text">
                                                                        <span class="input-group-text">
                                                                            <i class="fa fa-plus-square"
                                                                                aria-hidden="true"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="tipe">Tipe Barang</label>
                                                                    <div class="input-group mb-4">
                                                                        <input class="form-control"
                                                                            placeholder="Tipe Barang" name="tipe"
                                                                            id="tipe" type="text"
                                                                            value="{{ $barang->tipe }}">
                                                                        <span class="input-group-text">
                                                                            <i class="fa fa-plus-square"
                                                                                aria-hidden="true"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn bg-gradient-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            class="btn bg-gradient-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- script form --}}
                                    <script>
                                        $(document).ready(function() {
                                            $("#merk-{{ $barang->id }}").change(function() {
                                                if ($(this).val() === 'other') {
                                                    $("#merk_other-{{ $barang->id }}").show();
                                                    alert('oke')
                                                } else {
                                                    $("#merk_other-{{ $barang->id }}").hide();
                                                    alert("not oke {{ $barang->id }}")
                                                }
                                            });
                                        });
                                    </script>
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
                    <h5 class="modal-title text-capitalize" id="modaltambahLabel">Form tambah barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('store.barang') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6">
                                <label for="">Jenis Barang</label>
                                <div class="input-group mb-4">
                                    <select class="form-control text-capitalize" name="jenis" id="">
                                        <option value="" selected>jenis barang ..</option>
                                        <option class="text-uppercase" value="komputer">komputer</option>
                                        <option class="text-uppercase" value="printer">printer</option>
                                    </select>
                                    <span class="input-group-text">
                                        <i class="fa fa-arrows-v" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Merk Barang</label>
                                <div class="input-group mb-4">
                                    {{-- <input type="text" class="form-control" name="merk" placeholder="merk barang .." > --}}
                                    <select class="form-control text-capitalize" name="merk_id" id="merk">
                                        <option value="" selected>merk barang ..</option>
                                        @foreach ($merks as $merk)
                                            <option value="{{ $merk->id }}" class="text-uppercase">
                                                {{ $merk->merk }}</option>
                                        @endforeach
                                        <option value="other">lainnya ...</option>
                                    </select>
                                    <span class="input-group-text">
                                        <i class="fa fa-exchange" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="merk_other" style="display:none;">
                                    <label for="other" class="text-capitalize">merk Barang Lainnya</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="Merk Barang ..." name="merk"
                                             type="text">
                                        <span class="input-group-text">
                                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe">Tipe Barang</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="Tipe Barang" name="tipe"
                                            id="tipe" type="text">
                                        <span class="input-group-text">
                                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn bg-gradient-primary">Save</button>
                            </div>
                            
                </form>
            </div>
        </div>
    </div>
@endsection
