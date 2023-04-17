@extends('layouts.master')
@section('title', 'Oyun Ayarları')
@section('content')
@php
use App\Http\Controllers\HashController;
$hash = new HashController();
@endphp

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class="col-lg-4 col-12">
                    <div class="card card-primary">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                              <i class="material-icons">notifications_active</i>
                            </div>
                            <h3 class="card-title">Genel Duyuru</h3>
                        </div>
                        <div class="card-body text-center">
                            @foreach ($settings1 as $setting1)
                            <form action="{{ route('game-settings.update1') }}" method="POST">
                                @csrf
                                <div class="row justify-content-start">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="settings_description">Sistem Bildirim Metni</label>
                                            <input type="text" name="settings_description" id="settings_description" class="form-control" value="{{ $setting1->settings_description }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <div class="form-check col-md-6">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="settings_status" value="1" {{ $setting1->settings_status == 1 ? 'checked' : '' }}>
                                                    Pasif
                                                    <span class="circle">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="form-check col-md-6">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="settings_status" value="2" {{ $setting1->settings_status == 2 ? 'checked' : '' }}>
                                                    Aktif
                                                    <span class="circle">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="sistem1" class="btn btn-primary">Güncelle</button>
                            </form>
                        @endforeach
                        </div>
                    </div>

                </div>

                <div class="col-lg-4 col-12">
                    <div class="card card-primary">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                              <i class="material-icons">settings</i>
                            </div>
                            <h3 class="card-title">Oyun Bakım Modu</h3>
                        </div>
                        <div class="card-body text-center">
                            @foreach ($settings2 as $setting2)
                            <form action="{{ route('game-settings.update2') }}" method="POST">
                                @csrf
                                <div class="row justify-content-start">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="settings_description">Sistem Bildirim Metni</label>
                                            <input type="text" name="settings_description" id="settings_description" class="form-control" value="{{$setting2->settings_description }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <div class="form-check col-md-6">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="settings_status" value="1" {{ $setting2->settings_status == 1 ? 'checked' : '' }}>
                                                    Pasif
                                                    <span class="circle">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="form-check col-md-6">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="settings_status" value="2" {{ $setting2->settings_status == 2 ? 'checked' : '' }}>
                                                    Aktif
                                                    <span class="circle">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="sistem1" class="btn btn-primary">Güncelle</button>
                            </form>
                        @endforeach


                        </div>
                    </div>

                </div>

                <div class="col-lg-4 col-12">
                    <div class="card card-primary">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                              <i class="material-icons">dns</i>
                            </div>
                            <h3 class="card-title">Server Bakım Modu</h3>
                        </div>
                        <div class="card-body text-center">
                            @foreach ($settings3 as $setting3)
                            <form action="{{ route('game-settings.update3') }}" method="POST">
                                @csrf
                                <div class="row justify-content-start">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="settings_description">Sistem Bildirim Metni</label>
                                            <input type="text" name="settings_description" id="settings_description" class="form-control" value="{{$setting3->settings_description }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <div class="form-check col-md-6">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="settings_status" value="1" {{ $setting3->settings_status == 1 ? 'checked' : '' }}>
                                                    Pasif
                                                    <span class="circle">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="form-check col-md-6">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="settings_status" value="2" {{ $setting3->settings_status == 2 ? 'checked' : '' }}>
                                                    Aktif
                                                    <span class="circle">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="sistem1" class="btn btn-primary">Güncelle</button>
                            </form>
                        @endforeach


                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

@endsection
