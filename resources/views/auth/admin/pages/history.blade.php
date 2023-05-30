@php
    use Carbon\Carbon;
@endphp
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'history', 'master' => 'Pages'])
    {{-- <div class="card shadow-lg mx-4 card-profile-bottom">
    <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{asset('/img/team-1.jpg')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        Sayo Kravits
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        Public Relations
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center "
                                data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                                <i class="ni ni-app"></i>
                                <span class="ms-2">App</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                <i class="ni ni-email-83"></i>
                                <span class="ms-2">Messages</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                <i class="ni ni-settings-gear-65"></i>
                                <span class="ms-2">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <div class="row mt-4 mx-4">
        <div class="card mb-4">
            <div class="card-header p-3">
                <div class="flex justify-content-between align-items-center">
                    @if (session()->get('header'))
                        <h3 class="text-dark fw-bold text-capitalize">{{ session()->get('header') }}</h3>
                    @else
                        <h3 class="text-dark fw-bold">History</h3>
                    @endif
                @if (auth()->user()->cekLevel == 'admin')     
                
                    {{-- eksport --}}
                    <div class="dropdown">
                        <a href="#" class="btn bg-gradient-dark dropdown-toggle " data-bs-toggle="dropdown"
                            id="navbarDropdownMenuLink2">
                            <i class="fa fa-arrow-circle-down" aria-hidden="true"></i> Excel
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                            <li>
                                <a href="{{ route('history.exportAll') }}" class="dropdown-item">
                                    Semua
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#laporanBulan" data-bs-toggle="modal">
                                    Bulan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#laporanBarang" data-bs-toggle="modal">
                                    Barang
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="d-md-flex d-sm-block gap-2 mb-4">
                    <p class="mb-0">Tampilkan : </p>
                    <a href="{{ route('history') }}" class="badge bg-gradient-success btn-block mb-0 border-0">Semua</a>
                    <button type="button" class="badge bg-gradient-success btn-block mb-0 border-0" data-bs-toggle="modal"
                        data-bs-target="#historyBulan">
                        Bulan
                    </button>
                    <button type="button" class="badge bg-gradient-success btn-block mb-0 border-0" data-bs-toggle="modal"
                        data-bs-target="#historyBarang">
                        Barang
                    </button>
                    <button type="button" class="badge bg-gradient-success btn-block mb-0 border-0" data-bs-toggle="modal"
                        data-bs-target="#historyStatus">

                        Status
                    </button>
                </div>
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
                                        Barang
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Keterangan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kerusakan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Selesai</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Teknisi
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>
                            <tbody>
                                @if (session()->get('history') != 'tidak ada')
                                    @foreach ($historys as $history)
                                        @php
                                            // $i += $order->jumlah_order;
                                            $nohp = $history->ruangan->no_hp;
                                            if (substr(trim($nohp), 0, 1) == '0') {
                                                $nohp = '62' . substr(trim($nohp), 1);
                                            }
                                            // $array = json_decode($order->pesan, true);
                                        @endphp
                                        <tr>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">
                                                    {{ Carbon::parse($history->tanggal_order)->format('d-M-Y') }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">
                                                    {{ $history->barang->jenis->jenis . ' ' . $history->barang->merk->merk . ' ' . $history->barang->tipe->tipe }}

                                                </p>
                                            </td>
                                            <td>
                                                <p
                                                    class="text-sm font-weight-bold mb-0 {{ $history->status_selesai == 'rusak berat' ? 'text-danger' : 'text-success' }}">
                                                    <i class="text-success fa fa-check-circle" aria-hidden="true"></i>
                                                    {{ $history->status_selesai }}
                                                </p>
                                            </td>
                                            <td>
                                                <button type="button"
                                                    class="badge bg-gradient-success btn-block mb-0 border-0"
                                                    data-bs-toggle="modal" data-bs-target="#keterangan-{{ $history->id }}">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                </button>

                                                <!-- Modal Keterangan -->
                                                <div class="modal fade" id="keterangan-{{ $history->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="keterangan-{{ $history->id }}Title"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Keterangan
                                                                    Status
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form>
                                                                    <div class="form-group">
                                                                        <label for="recipient-name"
                                                                            class="col-form-label">Teknisi:</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $history->user->nama }}" disable
                                                                            id="recipient-name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="message-text"
                                                                            class="col-form-label">Keterangan Status</label>
                                                                        <textarea class="form-control" id="message-text" readonly value="{{ $history->pesan_status }}">{{ $history->pesan_status }}</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn bg-gradient-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn bg-gradient-primary">Send
                                                                    message</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0"></i>
                                                    {{ $history->pesan_kerusakan }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">
                                                    {{ Carbon::parse($history->tanggal_selesai)->format('d-M-Y') }}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $history->user->nama }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <a href="https://wa.me/{{ $nohp }}/?text=SIORSEVEN%0Auntuk ruangan: {{ $history->ruangan->nama }}%0Aorderan barang dari barang{{ $history->barang->jenis->jenis }} {{ $history->barang->merk->merk }} {{ $history->barang->tipe->tipe }}mohon diambil ke ruang IT RSUD Blambangan Banyuwangi%0Adari Admin SIORSEVEN: {{ auth()->user()->nama }}"
                                                            target="_blank" class="badge bg-info p-2"><i
                                                                class="fa fa-whatsapp fs-4" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            {{-- histori bulan --}}
            <div class="modal fade" id="historyBulan" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pilih Bulan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{ route('history.bulan') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="example-month-input" class="form-control-label">Month</label>
                                    <input class="form-control" type="month" value="2018-11" id="example-month-input"
                                        name="bulan">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn bg-gradient-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- histori perbarang --}}
            <div class="modal fade" id="historyBarang" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-capitalize" id="exampleModalLabel">pilih Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{ route('history.barang') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="example-month-input" class="form-control-label">Barang</label>
                                    <select name="barang_id" id="" class="form-control">
                                        <option value="" selected>Pilih Barang ..</option>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}">{{ $barang->jenis->jenis }} -
                                                {{ $barang->merk->merk }} - {{ $barang->tipe->tipe }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn bg-gradient-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- histori perStatus --}}
            <div class="modal fade" id="historyStatus" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-capitalize" id="exampleModalLabel">history sesusai status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{ route('history.status') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="example-month-input" class="form-control-label">Status</label>
                                    <select name="status_selesai" id="" class="form-control">
                                        <option value="" selected>Pilih Status ..</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="rusak berat">Rusak Berat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn bg-gradient-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- laporan bulan --}}
        <div class="modal fade" id="laporanBulan" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pilih Bulan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ route('history.exportBulan') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="example-month-input" class="form-control-label">Month</label>
                                <input class="form-control" type="month" value="2018-11" id="example-month-input"
                                    name="bulan">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-gradient-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- laporan barang --}}
        <div class="modal fade" id="laporanBarang" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-capitalize" id="exampleModalLabel">pilih Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ route('history.exportBarang') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="example-month-input" class="form-control-label">Barang</label>
                                <select name="barang_id" id="" class="form-control">
                                    <option value="" selected>Pilih Barang ..</option>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id }}">{{ $barang->jenis->jenis }} -
                                            {{ $barang->merk->merk }} - {{ $barang->tipe->tipe }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-gradient-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="" style="height:100vh;"></div>

@endsection
