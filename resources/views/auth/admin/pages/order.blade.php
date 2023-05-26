@php
    use Carbon\Carbon;
@endphp
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User', 'master' => 'pages'])
    <div class="row mt-4 mx-4">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h5>List Order</h5>
                @if (auth()->user()->cekLevel == 'admin')
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modaltambah">
                        <i class="fa fa-cart-plus" aria-hidden="true"></i> Order
                    </button>
                @endif
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="myTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Order
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pesan
                                        Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kerusakan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Selesai
                                    </th>
                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Aksi
                                    </th> --}}
                                    @if (auth()->user()->cekLevel == 'admin')
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                            Teknisi</th>
                                    @endif
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    @php
                                        // $i += $order->jumlah_order;
                                        $nohp = $order->ruangan->no_hp;
                                        if (substr(trim($nohp), 0, 1) == '0') {
                                            $nohp = '62' . substr(trim($nohp), 1);
                                        }
                                        // $array = json_decode($order->pesan, true);
                                    @endphp
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $parse($order->tanggal_order) }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $order->barang->jenis->jenis . ' ' . $order->barang->merk->merk . ' ' . $order->barang->tipe->tipe }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $order->status == null ? 'pending' : $order->status }}</p>
                                        </td>
                                        <td>
                                            @if ($order->pesan_status != null)
                                                <button type="button"
                                                    class="badge bg-gradient-success btn-block mb-0 border-0"
                                                    data-bs-toggle="modal" data-bs-target="#keterangan-{{ $order->id }}">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                </button>
                                            @else
                                                <p class="text-sm font-weight-bold mb-0">
                                                    {{ $order->pesan_status == null ? ' - ' : $order->pesan_status }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $order->pesan_kerusakan }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $order->tanggal_selesai ? $parse($order->tanggal_selesai) : '-' }}</p>
                                        </td>
                                        {{-- <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                @if (auth()->user()->cekLevel == 'admin')
                                                    <a href="https://wa.me/{{ $nohp }}/?text=SIORSEVEN%0Auntuk : {{ $order->ruangan->nama }}%0Aorderan barang dari barang{{ $order->barang->jenis->jenis }} {{ $order->barang->merk->merk }} {{ $order->barang->tipe->tipe }}mohon diambil ke ruang IT RSUD Blambangan Banyuwangi%0Adari Admin SIORSEVEN: {{ auth()->user()->nama }}"
                                                        target="_blank" class="badge bg-info p-2"><i
                                                            class="fa fa-whatsapp fs-4" aria-hidden="true"></i></a>
                                                @else
                                                    <a href="#update-{{ $order->id }}" class="badge bg-secondary"
                                                        data-bs-toggle="modal">update</a>
                                                @endif

                                            </p>
                                        </td> --}}
                                        @if (auth()->user()->cekLevel == 'admin')
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $order->user->nama }}</h6>
                                                    </div>
                                                </div>

                                            </td>
                                        @endif
                                    </tr>

                                    <!-- Modal Pesan Status  -->
                                    <div class="modal fade" id="keterangan-{{ $order->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="keterangan-{{ $order->id }}Title"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Keterangan
                                                        Status
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Nama
                                                                Teknisi:</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $order->user->nama }}" readonly
                                                                id="recipient-name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Keterangan
                                                                Status</label>
                                                            <textarea class="form-control" id="message-text" readonly value="{{ $order->pesan_status }}">{{ $order->pesan_status }}</textarea>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn bg-gradient-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn bg-gradient-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- modal update order --}}
                                    <div class="modal fade" id="update-{{ $order->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="update-{{ $order->id }}-Title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Form Update
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('update.order', ['order' => $order->id]) }}"
                                                    method="post">
                                                    <div class="modal-body">

                                                        @method('put')
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Nama Barang</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $order->barang->jenis->jenis . ' ' . $order->barang->merk->merk . ' ' . $order->barang->tipe->tipe }}"
                                                                        readonly id="recipient-name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="message-text"
                                                                        class="col-form-label">Kerusakan</label>
                                                                    <input type="text" name=""
                                                                        value="{{ $order->pesan_kerusakan }}" readonly
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Status</label>
                                                                    <select name="status"
                                                                        id="status-{{ $order->id }}"
                                                                        class="form-control">
                                                                        <option value=""
                                                                            {{ $order->status == '' ? 'selected' : '' }}>
                                                                            pending</option>
                                                                        <option value="on progress"
                                                                            {{ $order->status == 'on progress' ? 'selected' : '' }}>
                                                                            on progress</option>
                                                                        <option value="selesai"
                                                                            {{ $order->status == 'selesai' ? 'selected' : '' }}>
                                                                            selesai</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div id="status_selesai-{{ $order->id }}"
                                                                    class="form-group"
                                                                    style="display:{{ $order->status_selesai ? '' : 'none;' }}">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Status Selesai</label>
                                                                    <select name="status_selesai" id=""
                                                                        class="form-control">
                                                                        <option value=""
                                                                            {{ $order->status_selesai == '' ? 'selected' : '' }}>
                                                                            notselected</option>
                                                                        <option value="tidak bisa diperbaiki"
                                                                            {{ $order->status_selesai == 'rusak berat' ? 'selected' : '' }}>
                                                                            tidak bisa diperbaiki</option>
                                                                        <option value="sudah bisa digunakan"
                                                                            {{ $order->status_selesai == 'selesai' ? 'selected' : '' }}>
                                                                            sudah bisa digunakan</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="message-text" class="col-form-label">Pesan
                                                                        Status</label>
                                                                    <textarea name="pesan_status" id="" class="form-control"> {{ $order->pesan_status }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Tanggal Order</label>
                                                                    <input type="date"
                                                                        value="{{ $order->created_at }}"
                                                                        name="tanggal_order" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="message-text"
                                                                        class="col-form-label">Tanggal Selesai</label>
                                                                    <input type="date"
                                                                        value="{{ $order->tanggal_selesai }}"
                                                                        name="tanggal_selesai" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn bg-gradient-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            class="btn bg-gradient-primary">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    {{-- script form --}}
                                    <script>
                                        $(document).ready(function() {
                                            $("#status-{{ $order->id }}").change(function() {
                                                // alert($(this).val())
                                                if ($(this).val() == 'selesai') {
                                                    $("#status_selesai-{{ $order->id }}").show();
                                                    // alert('oke')
                                                } else {
                                                    $("#status_selesai-{{ $order->id }}").hide();
                                                    // alert("not oke {{ $order->id }}")
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
    <div class="" style="height:100vh;"></div>

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
                                        <select class="form-control" name="user_id" type="text">
                                            <option value="">Pilih Teknisi</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-text"><i class="fa fa-user-o"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <select class="form-control" name="barang_id" type="text">
                                            <option value="">Pilih Barang</option>
                                            @foreach ($barangs as $barang)
                                                <option value="{{ $barang->id }}">{{ $barang->jenis->jenis }}
                                                    {{ $barang->merk->merk }} {{ $barang->tipe->tipe }}</option>
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
                                        <span class="input-group-text"><i class="fa fa-hand-rock-o"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    {{-- <div class="input-group mb-4">
                                        <input class="form-control" placeholder="No Handphone" name="no_telephone"
                                            type="number">
                                        <span class="input-group-text"><i class="fa fa-mobile" aria-hidden="true"></i></i></span>
                                    </div> --}}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <select class="form-control" name="ruangan_id" type="text">
                                            <option value="">Pilih Barang</option>
                                            @foreach ($ruangans as $ruangan)
                                                <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}||
                                                    {{ $ruangan->no_hp }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-text"><i class="fa fa-key"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
