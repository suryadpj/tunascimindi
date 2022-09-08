@extends('layouts.master')

@section('content')
    <!-- wallet balance -->
    <div class="row mb-3">
        <div class="col-12 px-0">
            <div class="card shadow-sm mb-4">
                <div class="card theme-bg text-white border-0">
                    <div class="card-body
                    @switch($profil->membership)
                        @case(1)
                           bg-secondary
                        @break
                        @case(2)
                           bg-warning
                        @break
                        @case(3)
                           bg-light
                        @break
                        @case(4)
                           bg-danger
                        @break
                        @case(5)
                           bg-white text-dark
                        @break

                        @default
                            bg-white text-dark

                    @endswitch">
                        <div class="row mb-3">
                            <div class="col-auto align-self-center">
                                Kartu Member
                            </div>
                            <div class="col align-self-center text-end">
                                <p class="small">
                                    <span class="text-uppercase size-10">{{ $profil->registerdate }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h1 class="fw-normal mb-2 text-center">
                                    @switch($profil->membership)
                                        @case(1)
                                            Platinum Member
                                        @break
                                        @case(2)
                                            Gold Member
                                        @break
                                        @case(3)
                                            Silver Member
                                        @break
                                        @case(4)
                                            Bronze Member
                                        @break
                                        @case(5)
                                            New Member
                                        @break
                                        @default
                                            Member

                                    @endswitch
                                </h1>
                                <p class="mb-0 text-muted size-12">{{ Auth::user()->name }}<br>{{ Auth::user()->nomor_rangka }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-auto">
                    <figure class="avatar avatar-60 rounded-10">
                        @if (Auth::user()->fotoprofilpath)
                            <img src="../{{ Auth::user()->fotoprofilpath }}" alt="">
                        @else
                            <img src="assets_loginv2/img/logo_tunas.png" alt="">
                        @endif
                    </figure>
                </div>
                <div class="col px-0 align-self-center">
                    <h3 class="mb-0 text-color-theme">{{ Auth::user()->name }}</h3>
                    <p class="text-muted ">{{ Auth::user()->city }}</p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="text-muted mb-3">
                <table width="100%">
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>:</th>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <th>alamat</th>
                        <th>:</th>
                        <td>{{ Auth::user()->city }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Telp</th>
                        <th>:</th>
                        <td>{{ Auth::user()->phone }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <th>:</th>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <th>Hobi</th>
                        <th>:</th>
                        <td>{{ $profil->hobi }}</td>
                    </tr>
                    <tr>
                        <th>Makanan & Minuman</th>
                        <th>:</th>
                        <td>{{ $profil->food_drink }}</td>
                    </tr>
                </table>
            </p>
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p class="text-muted mb-3">
                <table width="100%">
                    <tr>
                        <th>Tipe</th>
                        <th>:</th>
                        <td>{{ $profil->unit }}</td>
                    </tr>
                    <tr>
                        <th>Tahun</th>
                        <th>:</th>
                        <td>{{ $profil->tahun }}</td>
                    </tr>
                </table>
            </p>
            <div class="row">
                <div class="col d-grid">
                    {{-- <button class="btn btn-default btn-lg shadow-sm">TCO Sesuai</button> --}}
                </div>
                <div class="col d-grid">
                    <a href="promo" class="btn btn-light btn-lg shadow-sm">Promo</a>
                </div>
            </div>
        </div>
    </div>
@endsection
