@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User', 'master' => 'Master Data'])
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
            <div class="card-header pb-0">
                <h5>List Users</h5>
                <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modaltambah">
                    Tambah
                </button>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="myTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Level
                                    </th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        NIK</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No Hp</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Level</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @if ($user->id !== auth()->user()->id)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $user->nama }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $user->username }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $user->cekLevel }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $user->nik }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $user->no_telephone }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm {{($user->status == 'nonaktif') ? 'bg-gradient-secondary' : 'bg-gradient-success'}}">{{$user->status}}</span>
                                            </td>

                                            <td class="align-middle text-end">
                                                <div
                                                    class="d-flex px-3 py-1 justify-content-center align-items-center gap-1">
                                                    <a href="#modalEdit-{{ $user->id }}" data-bs-toggle="modal"
                                                        class="badge bg-warning">edit</a>
                                                    @if ($user->status == 'aktif')
                                                        <a href="{{ route('user.nonaktif', ['user' => $user->id]) }}"
                                                            class="badge bg-danger">
                                                            <i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                                    @else
                                                        <a href="{{ route('user.aktif', ['user' => $user->id]) }}"
                                                            class="badge bg-success "><i class="fa fa-check-circle-o"
                                                                aria-hidden="true"></i></a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit User -->
                                        <div class="modal fade" id="modalEdit-{{ $user->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modaleditLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modaleditLabel">Form edit User</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('user.update', ['user' => $user->id]) }}"
                                                        method="post">
                                                        @method('put')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="username">Username</label>
                                                                        <div class="input-group mb-4">
                                                                            <input class="form-control"
                                                                                placeholder="Username" name="username"
                                                                                type="text"
                                                                                value="{{ $user->username }}">
                                                                            <span class="input-group-text">@</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="password">Password</label>
                                                                        <div class="input-group mb-4">
                                                                            <input class="form-control"
                                                                                placeholder="Password" name="password"
                                                                                type="password">
                                                                            <span class="input-group-text"><i
                                                                                    class="fa fa-key"
                                                                                    aria-hidden="true"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Nama</label>
                                                                        <div class="input-group mb-4">
                                                                            <input class="form-control" placeholder="Nama"
                                                                                name="nama" type="text"
                                                                                value="{{ $user->nama }}">
                                                                            <span class="input-group-text"><i
                                                                                    class="fa fa-user"
                                                                                    aria-hidden="true"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="nik">Nomer Induk
                                                                            Kependudukan</label>
                                                                        <div class="input-group mb-4">
                                                                            <input class="form-control" placeholder="NIK"
                                                                                name="nik" type="text"
                                                                                value="{{ $user->nik }}">
                                                                            <span class="input-group-text"><i
                                                                                    class="fa fa-id-card"
                                                                                    aria-hidden="true"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">No Hp</label>
                                                                        <div class="input-group mb-4">
                                                                            <input class="form-control"
                                                                                placeholder="no hp" name="no_telephone"
                                                                                type="text"
                                                                                value="{{ $user->no_telephone }}">
                                                                            <span class="input-group-text"><i
                                                                                    class="fa fa-mobile"
                                                                                    aria-hidden="true"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="cekLevel">Level</label>
                                                                        <div class="input-group mb-4">
                                                                            <select class="form-control"
                                                                                id="exampleFormControlSelect1"
                                                                                name="cekLevel">
                                                                                @if ($user->cekLevel == 'admin')
                                                                                    <option selected value="admin">admin</option>
                                                                                    <option value="teknisi">teknisi</option>
                                                                                    @else
                                                                                    <option value="admin">admin</option>
                                                                                    <option selected value="teknisi">teknisi
                                                                                    </option>
                                                                                @endif
                                                                            </select>
                                                                            <span class="input-group-text"><i
                                                                                    class="fa fa-user-secret"
                                                                                    aria-hidden="true"></i></span>
                                                                        </div>
                                                                    </div>
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
                                    @endif
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
                    <h5 class="modal-title" id="modaltambahLabel">Form tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username_store">Username</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="Username" name="username"
                                            id="username_store" type="text">
                                        <span class="input-group-text">@</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="Password" name="password"
                                            type="password">
                                        <span class="input-group-text"><i class="fa fa-key"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="Nama" name="nama" type="text">
                                        <span class="input-group-text"><i class="fa fa-user"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik">Nomor Induk Kependudukan</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="NIK" name="nik" type="text">
                                        <span class="input-group-text"><i class="fa fa-id-card"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp">No Hp</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="no hp" name="no_telephone"
                                            type="text">
                                        <span class="input-group-text"><i class="fa fa-mobile"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cekLevel">Level</label>
                                    <div class="input-group mb-4">
                                        <select class="form-control" id="exampleFormControlSelect1" name="cekLevel">
                                            <option value="admin">admin</option>
                                            <option value="teknisi">teknisi</option>
                                        </select>
                                        <span class="input-group-text"><i class="fa fa-user-secret"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
