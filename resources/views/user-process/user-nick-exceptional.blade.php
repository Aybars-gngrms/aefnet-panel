@extends('layouts.master')
@section('title', 'Oyuncu Ad İstisnaları')
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
                            <h4 class="card-title">Oyuncu Ad İstisnaları</h4>
                            <h5>{{ $users->count() }} Mesaj Bulundu</h5>
                        </div>
                        <div class="card-body">
                            <div class="material-datatables">
                                <div id="datatables_wrapper" class="dataTables_wrapper ">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive py-4">
                                            <table  class="table table-flush" id="datatables">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc">
                                                            ID
                                                        </th>
                                                        <th class="sorting">
                                                            Oyuncu Adı
                                                        </th>
                                                        <th class="sorting">
                                                            Email
                                                        </th>
                                                        <th class="sorting" >
                                                            İstisna
                                                        </th>
                                                        <th class="disabled-sorting text-right sorting" >
                                                            İşlem
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    use App\Http\Controllers\HashController;

                                                    $hash = new HashController();
                                                    @endphp

                                                    @if ($users->count() > 0)
                                                        @foreach ($users as $user)
                                                            <tr role="row" class="odd">
                                                                <td tabindex="0" class="sorting_1">{{ $user->id }}
                                                                </td>
                                                                <td>{{ $user->player_nick }}</td>
                                                                <td>{{ $user->email }}</td>
                                                                <td>
                                                                    @if ($user->exceptional_id ==  1)
                                                                        İstisna
                                                                    @else
                                                                        Sınırsız İstisna
                                                                    @endif

                                                                </td>
                                                                <td class="text-right">
                                                                    @if (Auth::user()->authority_status == 3)
                                                                        <button  class="btn btn-sm btn-danger">Kaldır</button>
                                                                    @else
                                                                    <form action="{{ route('user-nick-exceptional.exceptional.delete', $user->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('POST')
                                                                        <button type="submit" class="btn btn-sm btn-danger">Kaldır</button>
                                                                    </form>
                                                                    @endif
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

