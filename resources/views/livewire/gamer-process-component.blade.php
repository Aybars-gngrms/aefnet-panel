<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        @if (Auth::user()->authority_status == 3)
                            <button class="btn btn-sm btn-success" style="float: right; margin-top:1%;">

                                Oyuncu Ekle
                            </button>
                        @else
                            <button class="btn btn-sm btn-success" style="float: right; margin-top:1%;"
                                wire:click="storeUser">

                                Oyuncu Ekle
                            </button>
                        @endif
                        <div class="card-icon">
                            <i class="material-icons">manage_accounts</i>
                        </div>
                        <h4 class="card-title">Oyuncu İşlemleri</h4>
                        <h5>{{ $users->count() }} Oyuncu Bulundu</h5>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="material-datatables">
                            <div id="datatables_wrapper" class="dataTables_wrapper">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive py-4 " wire:ignore>
                                        <table class="table table-flush" id="datatables">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                        rowspan="1" colspan="1" style="width: 111px"
                                                        aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">
                                                        ID
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatables"
                                                        rowspan="1" colspan="1" style="width: 111px"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Oyuncu Adı
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatables"
                                                        rowspan="1" colspan="1" style="width: 111px"
                                                        aria-label="Office: activate to sort column ascending">
                                                        E-mail
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatables"
                                                        rowspan="1" colspan="1" style="width: 111px"
                                                        aria-label="Age: activate to sort column ascending">
                                                        Ad Güncelleme
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatables"
                                                        rowspan="1" colspan="1" style="width: 111px"
                                                        aria-label="Date: activate to sort column ascending">
                                                        Son Giriş
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatables"
                                                        rowspan="1" colspan="1" style="width: 111px"
                                                        aria-label="Date: activate to sort column ascending">
                                                        İstisna
                                                    </th>
                                                    <th class="disabled-sorting text-right sorting" tabindex="0"
                                                        aria-controls="datatables" rowspan="1" colspan="1"
                                                        style="width: 211px"
                                                        aria-label="Actions: activate to sort column ascending">
                                                        İşlemler
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($users->count() > 0)

                                                    @foreach ($users as $user)
                                                        <tr role="row" class="odd">
                                                            <td tabindex="0" class="sorting_1">{{ $user->id }}
                                                            </td>
                                                            <td>{{ $user->player_nick }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->nick_update_date }}</td>
                                                            <td>{{ $user->last_login_date }}</td>
                                                            <td>
                                                                @if (Auth::user()->authority_status == 3)
                                                                    <button title='istisna'
                                                                        class="btn btn-primary btn-sm"><i
                                                                            class="material-icons">text_increase</i></button>
                                                                @else
                                                                    <button
                                                                        wire:click="exceptionalUsers({{ $user->id }})"
                                                                        title='istisna'
                                                                        class="btn btn-primary btn-sm"><i
                                                                            class="material-icons">text_increase</i></button>
                                                                @endif
                                                            </td>
                                                            <td class="text-right">
                                                                @if (Auth::user()->authority_status == 3)
                                                                    @if (collect($messages)->where('user_id', $user->gamer_id)->isNotEmpty())
                                                                        <a class="btn btn-info btn-sm">
                                                                            <i class="material-icons">inbox</i>
                                                                        </a>
                                                                    @endif

                                                                    <button type="button"
                                                                        class="btn btn-warning btn-sm"><i
                                                                            class="material-icons">message</i></button>
                                                                    <button class="btn btn-success btn-sm"><i
                                                                            class="material-icons">edit_note</i></button>
                                                                    <button class="btn btn-danger btn-sm"><i
                                                                            class="material-icons">close</i></button>
                                                                @else
                                                                    @if (collect($messages)->where('user_id', $user->gamer_id)->isNotEmpty())
                                                                        <a href="{{ route('gamer-process.messages', $user->gamer_id) }}"
                                                                            class="btn btn-info btn-sm">
                                                                            <i class="material-icons">inbox</i>
                                                                        </a>
                                                                    @endif

                                                                    <button type="button"
                                                                        wire:click="messageUsers({{ $user->id }})"
                                                                        class="btn btn-warning btn-sm"><i
                                                                            class="material-icons">message</i></button>
                                                                    <button
                                                                        wire:click="editUsers({{ $user->id }})"
                                                                        class="btn btn-success btn-sm"><i
                                                                            class="material-icons">edit_note</i></button>
                                                                    <button
                                                                        wire:click="deleteConfirmation({{ $user->id }})"
                                                                        class="btn btn-danger btn-sm"><i
                                                                            class="material-icons">close</i></button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4" style="text-align: center;">
                                                            <small>Oyuncu Bulunamadı</small>
                                                        </td>
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
    <!-- Oyuncu ekleme modal -->
    <div wire:ignore.self class="modal fade" id="addUserModal" tabindex="-1" data-backdrop="static"
        data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Oyuncu Ekleme</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeUserData">
                        {{-- Kullanıcı adı input --}}
                        <div class="form-group row">
                            <label for="player_nick" class="md-label-floating">Oyuncu Adı</label>
                            <input type="text" id="player_nick" class="form-control" oninput="cevir()"
                                wire:model="player_nick">
                            @error('player_nick')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Kullanıcı e-mail input --}}
                        <div class="form-group row">
                            <label for="email" class="md-label-floating">E-mail</label>
                            <input type="email" id="email" class="form-control" wire:model="email">
                            @error('email')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Kullanıcı güvenlik sorusu select option input --}}
                        <div class="form-group row">
                            <div class="form-check col-md-6">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="security_question"
                                        value="Favori içiceğiniz" wire:model='security_question'> Favori içiceğiniz
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check col-md-6">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="security_question"
                                        value="En sevdiğiniz renk" wire:model='security_question'> En sevdiğiniz renk
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check col-md-6">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="security_question"
                                        value="Bilgisayarınızın Markası" wire:model='security_question'>
                                    Bilgisayarınızın markası
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check col-md-6">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="security_question"
                                        value="Telefon no son 4 hanesi" wire:model='security_question'> Telefon no son
                                    4 hanesi
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            @error('security_question')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror

                        </div>

                        {{-- Kullanıcı güvenlik sorusu cevabı input input --}}
                        <div class="form-group row">
                            <label for="security_answer" class="md-label-floating">Güvenlik Sorusu Cevabı</label>
                            <input type="text" id="security_answer" class="form-control"
                                wire:model="security_answer">
                            @error('security_answer')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Kullanıcı şifre input input --}}
                        <div class="form-group row">
                            <label for="password" class="md-label-floating">Şifre</label>
                            <input type="text" id="password" class="form-control" wire:model="password">
                            @error('password')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="modal-footer col-md-12">
                            <button type="submit" class="btn btn-sm btn-success">Oyuncu Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Oyuncu düzenleme modal -->
    <div wire:ignore.self class="modal fade" id="editUserModal" tabindex="-1" data-backdrop="static"
        data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Oyuncu Düzenleme</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="editUserData">

                        {{-- Kullanıcı adı düzenle  --}}
                        <div class="form-group row">
                            <label for="player_nick" class="md-label-floating">Oyuncu Adı</label>
                            <input type="text" id="player_nick" class="form-control" oninput="cevir()"
                                wire:model="player_nick">
                            @error('player_nick')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Kullanıcı e-mail input --}}
                        <div class="form-group row">
                            <label for="email" class="md-label-floating">E-mail</label>
                            <input type="email" id="email" class="form-control" wire:model="email">
                            @error('email')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Kullanıcı güvenlik sorusu select opiton --}}
                        <div class="form-group row">
                            <div class="form-group row">
                                <div class="form-check col-md-6">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="security_question"
                                            value="Favori içiceğiniz" wire:model='security_question'> Favori
                                        içiceğiniz
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check col-md-6">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="security_question"
                                            value="En sevdiğiniz renk" wire:model='security_question'> En sevdiğiniz
                                        renk
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check col-md-6">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="security_question"
                                            value="Bilgisayarınızın Markası" wire:model='security_question'>
                                        Bilgisayarınızın markası
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check col-md-6">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="security_question"
                                            value="Telefon no son 4 hanesi" wire:model='security_question'> Telefon no
                                        son 4 hanesi
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                @error('security_question')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror

                            </div>

                            @error('security_question')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Kullanıcı güvenlik sorusu cevabı --}}
                        <div class="form-group row">
                            <label for="security_answer" class="md-label-floating">Güvenlik Sorusu Cevabı</label>
                            <input type="text" id="security_answer" class="form-control"
                                wire:model="security_answer">
                            @error('security_answer')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Kullanıcı şifre input --}}
                        <div class="form-group row">
                            <label for="password" class="md-label-floating">Şifre</label>
                            <input type="text" id="password" class="form-control" wire:model="password">
                            @error('password')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="modal-footer col-md-12">
                            <button type="submit" class="btn btn-sm btn-success">Oyuncu Düzenle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Oyuncu istisna ekleme modal -->
    <div wire:ignore.self class="modal fade" id="exceptionalUserModal" tabindex="-1" data-backdrop="static"
        role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Oyuncu İstisnası</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="exceptionalUserData">

                        {{-- Kullanıcı istisna ekleme,sınırsız yapma,istisna yok select option --}}
                        <div class="form-group row">
                            <div class=" checkbox-radios">
                                @foreach ($exceptionals as $exceptional)
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exceptional_id"
                                                value="{{ $exceptional->id }}" wire:model='exceptional_id'>
                                            {{ $exceptional->name }}
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer col-md-12">
                            <button type="submit" class="btn btn-sm btn-success">İstisna Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Oyuncu mesaj gönderme modal -->
    <div wire:ignore.self class="modal fade" id="messageUserModal" tabindex="-1" data-backdrop="static"
        data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Oyuncu Mesaj Gönderme</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="messageUserData">
                        <input type="hidden" name="admin_id" id="admin_id" wire.model='admin_id'
                            value="{{ Auth::user()->id }}">

                        {{-- Kullanıcı mesaj konu  input --}}
                        <div class="form-group row">
                            <label for="subject" class="md-label-floating">Konu</label>
                            <input type="text" id="subject" class="form-control" wire:model="subject">
                            @error('subject')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Kullanıcı mesaj içerik textarea --}}
                        <div class="form-group row">
                            <label for="content" class="md-label-floating">İçerik</label>
                            <textarea type="text" id="content" class="form-control" wire:model="content"></textarea>
                            @error('content')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="modal-footer col-md-12">
                            <button type="submit" class="btn btn-sm btn-success">Mesaj Gönder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Oyuncu silme modal -->
    <div wire:ignore.self class="modal fade" id="deleteUserModal" tabindex="-1" data-backdrop="static"
        data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body pt-4 pb-4">
                    <h6 class="swal2-title" id="swal2-title" style="display: flex;">Bu oyuncuyu silmekte eminmisin
                    </h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="close" data-dismiss="modal"
                        aria-label="Close" style="margin-right:10px;">İptal</button>
                    <button class="btn btn-sm btn-danger" wire:click="deleteUserData()">Oyuncuyu Sil</button>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            const modalIds = ['addUserModal', 'editUserModal', 'exceptionalUserModal', 'messageUserModal',
                'deleteUserModal'
            ];

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


        window.addEventListener('show-new-user-modal', event => {
            $('#addUserModal');
            setTimeout(function() {
                variable = "addUserModal";
                document.getElementById('addUserModal').style.opacity = "1";
                document.getElementById('addUserModal').style.display = "block";
                var divElement = document.createElement("div");
                divElement.classList.add("modal-backdrop", "fade", "show");
                document.body.appendChild(divElement);
            }, 150);
            modal('show');
        });

        window.addEventListener('show-edit-user-modal', event => {
            $('#editUserModal').modal('show');
            setTimeout(function() {
                variable = "editUserModal";
                document.getElementById(variable).style.opacity = "1";
                document.getElementById(variable).style.display = "block";
                var divElement = document.createElement("div");
                divElement.classList.add("modal-backdrop", "fade", "show");
                document.body.appendChild(divElement);
            }, 150);
        });

        window.addEventListener('show-message-user-modal', event => {
            $('#messageUserModal').modal('show');
            setTimeout(function() {
                variable = "messageUserModal";
                document.getElementById(variable).style.opacity = "1";
                document.getElementById(variable).style.display = "block";
                var divElement = document.createElement("div");
                divElement.classList.add("modal-backdrop", "fade", "show");
                document.body.appendChild(divElement);
            }, 150);
        });

        window.addEventListener('show-exceptional-user-modal', event => {
            $('#exceptionalUserModal').modal('show');
            setTimeout(function() {
                variable = "exceptionalUserModal";
                document.getElementById(variable).style.opacity = "1";
                document.getElementById(variable).style.display = "block";
                var divElement = document.createElement("div");
                divElement.classList.add("modal-backdrop", "fade", "show");
                document.body.appendChild(divElement);
            }, 150);
        });

        window.addEventListener('show-delete-confirmation-modal', event => {
            $('#deleteUserModal').modal('show');
            setTimeout(function() {
                variable = "deleteUserModal";
                document.getElementById(variable).style.opacity = "1";
                document.getElementById(variable).style.display = "block";
                var divElement = document.createElement("div");
                divElement.classList.add("modal-backdrop", "fade", "show");
                document.body.appendChild(divElement);
            }, 150);
        });
    </script>
@endpush
