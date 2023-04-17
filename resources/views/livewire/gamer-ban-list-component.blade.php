<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">manage_accounts</i>
                        </div>
                        <h4 class="card-title">Oyuncu Ban Listesi</h4>
                        <h5>{{ $banned_users->count() }} Banlı Oyuncu Bulundu</h5>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <div id="datatables_wrapper" class="dataTables_wrapper ">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive py-4" wire:ignore>
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
                                                        E-mail
                                                    </th>
                                                    <th class="sorting">
                                                        Gamer ID
                                                    </th>
                                                    <th class="sorting">
                                                        Kim Banladı
                                                    </th>
                                                    <th class="sorting">
                                                        Ban Türü
                                                    </th>
                                                    <th class="sorting">
                                                        Ban Süresi
                                                    </th>
                                                    <th class="disabled-sorting text-right sorting">
                                                        İşlemler
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                use App\Http\Controllers\HashController;
                                                $hash = new HashController();
                                                @endphp

                                                @foreach ($users as $user)
                                                    @if($banned_users->contains('gamer_id', $user->gamer_id))
                                                        @php
                                                            $banned_user = $banned_users->where('gamer_id', $user->gamer_id)->first();
                                                        @endphp
                                                        <tr role="row" class="odd">
                                                            <td tabindex="0" class="sorting_1">{{ $user->id }}</td>
                                                            <td>{{ $user->player_nick }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->gamer_id }}</td>
                                                            <td>{{ $banned_user->who_banned }}</td>
                                                            <td>{{ $banned_user->ban_type }}</td>
                                                            <td>{{ $banned_user->ban_time }}</td>
                                                            <td class="text-right">
                                                                <span class="btn btn-sm btn-info" wire:click="banDetail({{ $user->id }})">
                                                                    <i class="material-icons">info</i> Ban Detayı
                                                                </span>
                                                                @if (Auth::user()->authority_status == 3)
                                                                    <button type="button" class="btn btn-sm btn-danger">
                                                                        <i class="material-icons">close</i> Ban kaldır
                                                                    </button>
                                                                @else
                                                                <button type="button" class="btn btn-sm btn-danger" wire:click="deleteBanData({{ $user->id }})">
                                                                    <i class="material-icons">close</i> Ban kaldır
                                                                </button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
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
            <!-- Ban kaldırma  modal -->
            <div wire:ignore.self class="modal fade" id="deleteUserModal" tabindex="-1" data-backdrop="static"data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body pt-4 pb-4">
                            <h6 class="swal2-title" id="swal2-title" style="display: flex;">Oyuncunun banını kaldırmada eminmisiniz</h6>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-primary" wire:click="cancel()" data-dismiss="modal"
                                aria-label="Close" style="margin-right:10px;">İptal</button>
                            <button class="btn btn-sm btn-danger" wire:click="deleteBanData()">Ban kaldırma</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ban Detayı modal -->
            <div wire:ignore.self class="modal fade" id="banDetailModal" tabindex="-1" data-backdrop="static"
                data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Oyuncu Ban Detayı</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                wire:click="closeViewUserModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-asd">
                                <p><b>Oyuncu Adı:</b> {{ $view_ban_user_name }}</p>
                                <p><b>Oyuncu Email:</b> {{ $view_ban_user_email }}</p>
                                <hr>
                                <p><b>Ban Açıklaması</b></p>
                                    <p style="word-wrap: break-word; overflow-wrap: break-word;">{{ $view_ban_description }}</p>
                                <hr>
                                <p><b>Ban Görseli</b></p>
                                <div class="row justify-content-start">
                                    <div class="col-6">
                                        <img class="img-fluid" src="{{ asset('uploads/ban_images') }}/{{ $view_ban_image }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>



@push('scripts')
    <script>
                window.addEventListener('close-modal', event => {
            const modalIds = ['banDetailModal'];

            modalIds.forEach(id => {
                $(`#${id}`).modal('hide');
                document.getElementById(id).style.opacity = "0";
                document.getElementById(id).style.display = "none";
                var backdrop = document.querySelector('.modal-backdrop');

                // backdrop değişkeninin null olup olmadığını kontrol edin
                if (backdrop !== null) {
                    // backdrop değişkeni null değilse, ebeveyninden kaldırın
                    backdrop.parentNode.removeChild(backdrop);
                }
                


            });
        });
        

        window.addEventListener('show-ban-detail-modal', event => {
            $('#banDetailModal');
            setTimeout(function() {
                variable = "banDetailModal";
                document.getElementById('banDetailModal').style.opacity = "1";
                document.getElementById('banDetailModal').style.display = "block";
                var divElement = document.createElement("div");
                divElement.classList.add("modal-backdrop", "fade", "show");
                document.body.appendChild(divElement);
            }, 150);
            modal('show');
        });
    </script>
@endpush
