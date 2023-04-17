@extends('layouts.master')
@section('title', 'Oyuncu Mesaj Listesi')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">manage_accounts</i>
                            </div>
                            <h4 class="card-title">Oyuncu Mesaj Listesi</h4>
                            <h5>{{ $messages->count() }} Mesaj Bulundu</h5>
                        </div>
                        <div class="card-body">
                            <div class="material-datatables">
                                <div id="datatables_wrapper" class="dataTables_wrapper" >
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive py-4">
                                            <table class="table table-flush" id="datatables">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc">
                                                            ID
                                                        </th>
                                                        <th class="sorting">
                                                            Konu
                                                        </th>
                                                        <th class="sorting">
                                                            Mesaj
                                                        </th>
                                                        <th class="sorting">
                                                            Tarih
                                                        </th>
                                                        <th class="sorting">
                                                            Durum
                                                        </th>
                                                        <th class="disabled-sorting text-right sorting">
                                                            İşlem
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    use App\Http\Controllers\HashController;

                                                    $hash = new HashController();
                                                    @endphp

                                                    @if ($messages->count() > 0)
                                                        @foreach ($messages as $message)
                                                            <tr role="row" class="odd">
                                                                <td tabindex="0" class="sorting_1">{{ $message->user_id }}
                                                                </td>
                                                                <td>{{ $message->subject }}</td>
                                                                <td>{{ $message->content }}</td>
                                                                <td>{{ $message->created_at }}</td>
                                                                <td>
                                                                    @if ($message->status ==  1)
                                                                        <i class="material-icons" style="font-size:14px;position:relative;top:2px;">task_alt</i> Gönderildi
                                                                    @else
                                                                        <i class="material-icons" style="font-size:14px;position:relative;top:2px;">schedule</i> Okundu
                                                                    @endif

                                                                </td>
                                                                <td class="text-right">
                                                                    <a href="{{route('gamer-process.messages.delete', $message->id)}}" class="btn btn-sm btn-danger">Kaldır</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="4" style="text-align: center;"><small>No User
                                                                    Found</small></td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
