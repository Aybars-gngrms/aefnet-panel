@extends('layouts.master')
@section('title', 'Site Ayarları')
@section('content')
@php
use App\Http\Controllers\HashController;
$hash = new HashController();
@endphp

    <section class="content">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('site-settings.update')}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card-body card card-primary">
                                    <div class="row justify-content-end">
                                        {{-- Site Logo --}}
                                        <div class="col-md-12">
                                            <img src="{{ asset($config->logo) }}" width="400px" height="100px" alt="Site Logo">

                                            <div class="fileinput fileinput-new text-center mr-5" data-provides="fileinput">
                                                <div class="fileinput-preview fileinput-exists thumbnail img-raised">

                                                </div>
                                                <div>
                                                    <span class="btn btn-raised  btn-info btn-simple btn-file">
                                                        <span for='logo' class="fileinput-new">Logo</span>
                                                        <span class="fileinput-exists">Değiştir</span>
                                                        <input type="file" name="logo" id='logo'/>

                                                    </span>
                                                    <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                                        <i class="fa fa-times"></i> Kaldır</a>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Site Favicon --}}
                                        <div class="col-md-12">
                                            <img src="{{ asset($config->favicon) }}" width="50px" height="50px" alt="Favicon">

                                            <div class="fileinput fileinput-new text-center mr-5" data-provides="fileinput">
                                                <div class="fileinput-preview fileinput-exists thumbnail img-raised">
                                                </div>
                                                <div>
                                                    <span class="btn btn-raised  btn-info btn-simple btn-file">
                                                        <span for='favicon' class="fileinput-new">Favicon</span>
                                                        <span class="fileinput-exists">Değiştir</span>
                                                        <input type="file" name="favicon" id='favicon'/>

                                                    </span>
                                                    <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                                        <i class="fa fa-times"></i> Kaldır</a>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Site  --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Site Başlık</label>
                                                <input type="text" class="form-control" placeholder="Site Başlık ..."
                                                    name="title" value="{{$config->title}}">
                                            </div>
                                        </div>
                                        {{-- Site Email --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="text" class="form-control" placeholder="E-mail ..."
                                                    name="email" value="{{$config->email}}">
                                            </div>
                                        </div>
                                        {{-- Admin paneli giriş sayfası from başlığı --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>ADMIN PANEL Giriş Sayfası Form Başlığı</label>
                                                <input type="text" class="form-control"
                                                    placeholder="ADMIN PANEL Giriş Sayfası Form Başlığı ..."
                                                    name="admin_panel_login_form_title" value="{{$config->admin_panel_login_form_title}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <button name="settings" type="submit"
                                                    class="btn btn-block btn-primary">GÜNCELLE</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
