@extends('layouts.master')
@section('title', 'Anasayfa')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">group</i>
                            </div>
                            <p class="card-category">Toplam Oyuncu Sayısı</p>
                            <h3 class="card-title">{{ $users->count()}}</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">admin_panel_settings</i>
                            </div>
                            <p class="card-category">Toplam Yetkili Sayısı</p>
                            <h3 class="card-title">{{ $admin->count() }}</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">public</i>
                            </div>
                            <p class="card-category">Online Oyuncu Sayısı</p>
                            <h3 class="card-title">{{ $online_gamer_count->count() }}</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">trending_up</i>
                            </div>
                            <p class="card-category">Son 24 Saatte En Yüksek Oyuncu Sayısı</p>
                            <h3 class="card-title">{{ $highest_player_count }}</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">person_off</i>
                            </div>
                            <p class="card-category">Toplam Banlanan Oyuncu sayısı</p>
                            <h3 class="card-title">{{ $ban_users->count()}}</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
