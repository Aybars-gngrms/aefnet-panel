<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <button class="btn btn-sm btn-success" style="float: right; margin-top:1%;"
                        wire:click="addSystem_managerModal" >

                            Yetkili Ekle
                        </button>
                        <div class="card-icon">
                            <i class="material-icons">manage_accounts</i>
                        </div>
                        <h4 class="card-title">Yetkili Bilgileri</h4>
                        <h5>{{ $system_authorities->count() }} Yetkili Bulundu</h5>
                    </div>
                    <div class="card-body">
                        <div class="toolbar"></div>
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
                                                        Yetkisi
                                                    </th>
                                                    <th class="sorting">
                                                        Yetkili Adı
                                                    </th>
                                                    <th class="sorting">
                                                        E-mail
                                                    </th>
                                                    <th class="sorting">
                                                        Son Giriş Tarihi
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

                                                @if ($system_authorities->count() > 0)
                                                    @foreach ($system_authorities as $system_manager)
                                                        <tr role="row" class="odd">
                                                            <td tabindex="0" class="sorting_1">
                                                                {{ $system_manager->id }}</td>
                                                            <td>{{ $system_manager->authority_name }}</td>
                                                            <td>{{ $system_manager->name }}</td>
                                                            <td>{{ $system_manager->email }}</td>
                                                            <td>{{ $system_manager->last_login_date }}</td>
                                                            <td class="text-right">
                                                                <button
                                                                    wire:click="editSystem_managers({{ $system_manager->id }})"
                                                                    class="btn btn-success btn-sm">
                                                                    <i class="material-icons">edit_note</i> Düzenle
                                                                </button>
                                                                @if ($system_manager->name !== 'aefnet')
                                                                    <button
                                                                        wire:click="deleteConfirmation({{ $system_manager->id }})"
                                                                        class="btn btn-danger btn-sm">
                                                                        <i class="material-icons">close</i> Kaldır
                                                                    </button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4" style="text-align: center;"><small>Yetkili
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






    </div>

    <!-- Yetkili ekleme modal -->
    <div wire:ignore.self class="modal fade" id="addSystem_managerModal" tabindex="-1" data-backdrop="static"
        data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yetkili Ekleme</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    wire:click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeSystem_managerData">
                        {{-- Yetkili Yetkisi --}}
                        <div class="form-group row">
                            @foreach ($managers as $manager)
                                <div class="form-check col-md-6">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="{{ $manager->id }}"
                                            value="{{ $manager->id }}" wire:model='manager'>
                                        {{ $manager->manager_name }}
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('manager')
                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror

                        {{-- Yetkili adı input --}}
                        <div class="form-group row">
                            <label for="name" class="md-label-floating">Yetkili Adı</label>
                            <input type="text" id="name" class="form-control" wire:model="name">
                            @error('name')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Yetkili e-mail input --}}
                        <div class="form-group row">
                            <label for="email" class="md-label-floating">E-mail</label>
                            <input type="email" id="email" class="form-control" wire:model="email">
                            @error('email')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Yetkili güvenlik sorusu select option input --}}
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

                        {{-- Yetkili güvenlik sorusu cevabı input input --}}
                        <div class="form-group row">
                            <label for="security_answer" class="md-label-floating">Güvenlik Sorusu Cevabı</label>
                            <input type="text" id="security_answer" class="form-control"
                                wire:model="security_answer">
                            @error('security_answer')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Yetkili şifre input input --}}
                        <div class="form-group row">
                            <label for="password" class="md-label-floating">Şifre</label>
                            <input type="text" id="password" class="form-control" wire:model="password">
                            @error('password')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="modal-footer col-md-12">
                            <button type="submit" class="btn btn-sm btn-success">Yetkili Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Yetkili düzenleme modal -->
    <div wire:ignore.self class="modal fade" id="editSystem_managerModal" tabindex="-1" data-backdrop="static"
        data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yetkili Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="editSystem_managerData">

                        {{-- Yetki ekleme --}}
                        <div class="form-group row">
                            @foreach ($managers as $manager)
                                <div class="form-check col-md-6">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="{{ $manager->id }}"
                                            value="{{ $manager->id }}" wire:model='manager'>
                                        {{ $manager->manager_name }}
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                            @error('security_question')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror

                        </div>

                        {{-- Yetkili adı düzenle  --}}
                        <div class="form-group row">
                            <label for="edit_name" class="md-label-floating">Yetkili Adı</label>
                            <input type="text" id="edit_name" class="form-control" wire:model="name">
                            @error('name')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Yetkili e-mail input --}}
                        <div class="form-group row">
                            <label for="email" class="md-label-floating">E-mail</label>
                            <input type="email" id="email" class="form-control" wire:model="email">
                            @error('email')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Yetkili güvenlik sorusu select opiton --}}
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
                        </div>

                        {{-- Yetkili güvenlik sorusu cevabı --}}
                        <div class="form-group row">
                            <label for="security_answer" class="md-label-floating">Güvenlik Sorusu Cevabı</label>
                            <input type="text" id="security_answer" class="form-control"
                                wire:model="security_answer">
                            @error('security_answer')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Yetkili şifre input --}}
                        <div class="form-group row">
                            <label for="password" class="md-label-floating">Şifre</label>
                            <input type="text" id="password" class="form-control" wire:model="password">
                            @error('password')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="modal-footer col-md-12">
                            <button type="submit" class="btn btn-sm btn-success">Yetkiliyi Düzenle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Yetkili silme modal -->
    <div wire:ignore.self class="modal fade" id="deleteSystem_managerModal" tabindex="-1" data-backdrop="static"
        data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body pt-4 pb-4">
                    <h6 class="swal2-title" id="swal2-title" style="display: flex;">Bu yetkiliyi silmekte eminmisin
                    </h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="cancel()" data-dismiss="modal"
                        aria-label="Close" style="margin-right:10px;">İptal</button>
                    <button class="btn btn-sm btn-danger" wire:click="deleteSystem_managerData()">Yetkiliyi
                        Sil</button>
                </div>
            </div>
        </div>
    </div>



</div>

@push('scripts')
    <script>
                window.addEventListener('close-modal', event => {
            const modalIds = ['addSystem_managerModal', 'editSystem_managerModal', 'deleteSystem_managerModal'
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

        window.addEventListener('show-new-manager-modal', event => {
            $('#addSystem_managerModal');
            setTimeout(function() {
                variable = "addSystem_managerModal";
                document.getElementById('addSystem_managerModal').style.opacity = "1";
                document.getElementById('addSystem_managerModal').style.display = "block";
                var divElement = document.createElement("div");
                divElement.classList.add("modal-backdrop", "fade", "show");
                document.body.appendChild(divElement);
            }, 150);
            modal('show');
        });

        window.addEventListener('show-edit-system_manager-modal', event => {
            $('#editSystem_managerModal').modal('show');
            setTimeout(function() {
                variable = "editSystem_managerModal";
                document.getElementById(variable).style.opacity = "1";
                document.getElementById(variable).style.display = "block";
                var divElement = document.createElement("div");
                divElement.classList.add("modal-backdrop", "fade", "show");
                document.body.appendChild(divElement);
            }, 150);
        });

        window.addEventListener('show-delete-confirmation-modal', event => {
            $('#deleteSystem_managerModal').modal('show');
            setTimeout(function() {
                variable = "deleteSystem_managerModal";
                document.getElementById(variable).style.opacity = "1";
                document.getElementById(variable).style.display = "block";
                var divElement = document.createElement("div");
                divElement.classList.add("modal-backdrop", "fade", "show");
                document.body.appendChild(divElement);
            }, 150);
        });


    </script>
@endpush
