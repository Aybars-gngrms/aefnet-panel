<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">manage_accounts</i>
                        </div>
                        <h4 class="card-title">Oyuncu Bilgileri</h4>
                        <h5>{{ $users->count() }} Oyuncu Bulundu</h5>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <div id="datatables_wrapper"
                                class="dataTables_wrapper>
                                <div class="row">
                                <div class="col-sm-12 table-responsive py-4" wire:ignore>
                                    <table class="table table-flush" id="datatables">
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

                                            @if ($users->count() > 0)
                                                @foreach ($users as $user)
                                                    <tr role="row" class="odd">
                                                        <td tabindex="0" class="sorting_1">{{ $user->id }}
                                                        </td>
                                                        <td>{{ $user->player_nick }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td class="text-right">
                                                            <button class="btn btn-sm btn-info"
                                                                wire:click="viewUserDetails({{ $user->id }})"><i
                                                                    class="material-icons">info</i> Bilgi
                                                            </button>
                                                            <button class="btn btn-sm btn-info"
                                                                wire:click="adlogUserDetails({{ $user->id }})"><i
                                                                    class="material-icons">description</i> Ad
                                                                Log </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" style="text-align: center;"><small>Oyuncu
                                                            Bulunamadı</small></td>
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

{{-- Oyuncu Bilgisi --}}
<div wire:ignore.self class="modal fade" id="viewUserModal" tabindex="-1" data-backdrop="static" data-keyboard="false"
    role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Oyuncu Bilgisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    wire:click="closeViewUserModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID: </th>
                            <td>{{ $view_user_id }}</td>
                        </tr>
                        <tr>
                            <th>E-Mail: </th>
                            <td>{{ $view_user_email }}</td>
                        </tr>

                        <tr>
                            <th>Oyuncu Adı: </th>
                            <td>{{ $view_user_name }}</td>
                        </tr>

                        <tr>
                            <th>Şifre: </th>
                            <td>{{ $view_user_password }}</td>
                        </tr>

                        <tr>
                            <th>Güvenlik Sorusu: </th>
                            <td>{{ $view_user_security_question }}</td>
                        </tr>
                        <tr>
                            <th>Cevap: </th>
                            <td>{{ $view_user_security_answer }}</td>
                        </tr>
                        <tr>
                            <th>İstisna: </th>
                            <td>
                                @if ($view_user_exceptional ==  1)
                                İstisna
                                @elseif ($view_user_exceptional == 2)
                                    Sınırsız İstisna
                                @else
                                    İstsina Yok
                                @endif



                            </td>
                        </tr>
                        <tr>
                            <th>Ban Durumu: </th>
                            <td>{{ $view_user_ban }}</td>
                        </tr>
                        <tr>
                            <th>IP Adresi: </th>
                            <td>{{ $view_user_ip_addres }}</td>
                        </tr>
                        <tr>
                            <th>Hesap Oluşturma Tarihi: </th>
                            <td>{{ $view_user_created_at }}</td>
                        </tr>
                        <tr>
                            <th>Son Giriş: </th>
                            <td>{{ $view_user_last_login_date }}</td>
                        </tr>
                        <tr>
                            <th>Bilgisayar Adı: </th>
                            <td>{{ $view_user_computer_id }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- Oyuncu ad Bilgisi --}}
<div wire:ignore.self class="modal fade" id="adlogUserModal" tabindex="-1" data-backdrop="static" data-keyboard="false"
    role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Oyuncu Ad Bilgisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    wire:click="closeViewUserModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Oyuncu Adı
                            </th>
                            <th>
                                Oluşturulma Tarihi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $log_player_nick }}</td>
                            <td>{{ $log_updated_at }}</td>
                        </tr>

                    </tbody>
                </table>
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
            const modalIds = ['viewUserModal', 'adlogUserModal'];

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

        window.addEventListener('show-view-user-modal', event => {
            $('#viewUserModal');
            setTimeout(function() {
                variable = "viewUserModal";
                document.getElementById('viewUserModal').style.opacity = "1";
                document.getElementById('viewUserModal').style.display = "block";
                var divElement = document.createElement("div");
                divElement.classList.add("modal-backdrop", "fade", "show");
                document.body.appendChild(divElement);
            }, 150);
            modal('show');
        });

        window.addEventListener('show-ad-log-modal', event => {
            $('#adlogUserModal');
            setTimeout(function() {
                variable = "adlogUserModal";
                document.getElementById('adlogUserModal').style.opacity = "1";
                document.getElementById('adlogUserModal').style.display = "block";
                var divElement = document.createElement("div");
                divElement.classList.add("modal-backdrop", "fade", "show");
                document.body.appendChild(divElement);
            }, 150);
            modal('show');
        });
    </script>
@endpush
