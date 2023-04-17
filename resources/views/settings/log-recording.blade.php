@extends('layouts.master')
@section('title', 'Log Kayıtları')
@section('content')
@php
use App\Http\Controllers\HashController;

$hash = new HashController();
@endphp

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6>Yetkili İşlem Logları</h6>
                        </div>
                        <div class="card-body">
                            @foreach($manager_log as $logLine)
                            {{ $logLine }}<br>
                        @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6>Giriş Çıkış Logları</h6>
                        </div>
                        <div class="card-body">
                            @foreach($last_login_date as $login)
                            {{ $login->last_login_date }} {{$login->name}} yetkilisi giriş yaptı<br>
                        @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6>Kullanıcı İşlem Logları</h6>
                        </div>
                        <div class="card-body">
                            @foreach($user_log as $logLine)
                                {{ $logLine }}<br>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6>Sistem Logları</h6>
                        </div>
                        <div class="card-body">
                            @foreach($system_log as $logLine)
                                {{ $logLine }}<br>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6>İstisna İşlem Logları</h6>
                        </div>
                        <div class="card-body">
                            @foreach($exception_log as $logLine)
                                {{ $logLine }}<br>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6>Ban İşlem Logları</h6>
                        </div>
                        <div class="card-body">
                            @foreach($ban_log as $logLine)
                                {{ $logLine }}<br>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
