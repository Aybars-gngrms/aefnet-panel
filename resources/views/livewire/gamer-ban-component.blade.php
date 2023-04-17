<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">manage_accounts</i>
                        </div>
                        <h4 class="card-title">Oyuncu Ban İşlemleri</h4>
                        <h5>{{ $users->count() }} Oyuncu Bulundu</h5>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <div id="datatables_wrapper" class="dataTables_wrapper "">
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
                                                        Oyuncu ID
                                                    </th>
                                                    <th class="disabled-sorting text-right sorting">
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
                                                            <td>{{ $user->gamer_id }}</td>
                                                            <td class="text-right">
                                                                @if (Auth::user()->authority_status == 3)
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-danger"><i
                                                                            class="material-icons">person_off</i>
                                                                        Banla</button>
                                                                    @foreach ($banned_users as $ban_user)
                                                                        @if ($ban_user->gamer_id == $user->gamer_id)
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-success"><i
                                                                                    class="material-icons">edit_note</i>
                                                                                Ban düzenle</button>
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-danger"><i
                                                                                    class="material-icons">close</i>
                                                                                Ban kaldır</button>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <button type="button" class="btn btn-sm btn-danger"
                                                                        @if ($banned_users->where('gamer_id', $user->gamer_id)->count() > 0) disabled
                                                                        @else
                                                                        wire:click="banUsers({{ $user->id }})" @endif>
                                                                        <i class="material-icons">person_off</i> Banla
                                                                    </button>

                                                                    @foreach ($banned_users as $ban_user)
                                                                        @if ($ban_user->gamer_id == $user->gamer_id)
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-success"wire:click="ban_editUsers({{ $user->id }})"><i
                                                                                    class="material-icons">edit_note</i>
                                                                                Ban düzenle</button>
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-danger"wire:click="deleteUserData({{ $user->id }})"><i
                                                                                    class="material-icons">close</i>
                                                                                Ban kaldır</button>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
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



    </div>
    {{-- Oyuncu ban model --}}
    <div wire:ignore.self class="modal fade" id="banUserModal" tabindex="-1" data-backdrop="static"
        data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Oyuncu Ban</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="banUserData">

                        {{-- Ban türü ve süresi  --}}
                        <div class="form-group row col-md-12">
                            <div class="col-md-6">
                                <label for="content" class="md-label-floating">Ban Türü Seçiniz</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="sohbet_banı"
                                            value="Sohbet Banı" wire:model='ban_type'> Sohbet Banı
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="oyun_banı"
                                            value="Oyun Banı" wire:model='ban_type'> Oyun Banı
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="oda_kurma_banı"
                                            value="Oda Kurma Banı" wire:model='ban_type'> Oda
                                        Kurma Banı
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="server_banı"
                                            value="Server Banı" wire:model='ban_type'> Server
                                        Banı
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                @error('ban_type')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="content" class="md-label-floating">Ban Süresi Seçiniz</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="1"
                                            value="1" wire:model='ban_time'> 1 Gün
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="7" value="7"
                                            wire:model='ban_time'> 7 Gün
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="14" value="14"
                                            wire:model='ban_time'> 14 Gün
                                        Gün
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="30" value="30"
                                            wire:model='ban_time'> 30 Gün
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="süresiz"
                                            value="Süresiz" wire:model='ban_time'>
                                        Süresiz
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                @error('ban_time')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Kullanıcının banlanma sebebi --}}
                        <div class="form-group row">
                            <label for="ban_description" class="md-label-floating">Kullanıcının Banlanma Sebebi
                                Nedir?</label>
                            <textarea class="form-control" id="ban_description" wire:model='ban_description' rows="3"></textarea>
                            @error('content')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Ban resmi --}}
                        <div class="form-group row">
                            <div class="fileinput fileinput-new text-center mr-5" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                <div>
                                    <span class="btn btn-raised  btn-info btn-simple btn-file">
                                        <span class="fileinput-new">Ban Görseli</span>
                                        <span class="fileinput-exists">Değiştir</span>
                                        <input type="file" name="ban_image" wire:model='ban_image' />
                                    </span>
                                    <a href="javascript:;" class="btn btn-danger fileinput-exists">
                                        <i class="fa fa-times"></i> Kaldır</a>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer col-md-12">
                            <button type="submit" class="btn btn-sm btn-success">Banla</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Oyuncu ban düzenleme modal -->
    <div wire:ignore.self class="modal fade" id="baneditUserModal" tabindex="-1" data-backdrop="static"
        data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Oyuncu Ban Düzenleme</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="baneditUserData">

                        {{-- Ban türü ve ban süresi  --}}
                        <div class="form-group row col-md-12">
                            <div class="col-md-6">
                                <label for="content" class="md-label-floating">Ban Türü Seçiniz</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="sohbet_banı"
                                            value="Sohbet Banı" wire:model='ban_type'> Sohbet Banı
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="oyun_banı"
                                            value="Oyun Banı" wire:model='ban_type'> Oyun Banı
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="oda_kurma_banı"
                                            value="Oda Kurma Banı" wire:model='ban_type'> Oda
                                        Kurma Banı
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="server_banı"
                                            value="Server Banı" wire:model='ban_type'> Server
                                        Banı
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                @error('ban_type')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="content" class="md-label-floating">Ban Süresi Seçiniz</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="24_saat"
                                            value="1" wire:model='ban_time'> 1 Gün
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="7_gün" value="7"
                                            wire:model='ban_time'> 7 Gün
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="14_gün" value="14"
                                            wire:model='ban_time'> 14
                                        Gün
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="30_gün" value="30"
                                            wire:model='ban_time'> 30 Gün
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="süresiz"
                                            value="Süresiz" wire:model='ban_time'>
                                        Süresiz
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                @error('ban_time')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        {{-- Kullanıcı banlanma sebebi  --}}
                        <div class="form-group row">
                            <label for="ban_description" class="md-label-floating">Kullanıcının Banlanma Sebebi
                                Nedir?</label>
                            <textarea class="form-control" id="ban_description" wire:model='ban_description' rows="3"></textarea>
                            @error('content')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Ban resmi  --}}
                        <div class="form-group row">
                            @if ($view_ban_image == "")
                            
                                
                                    
                            @else
                            <div class="col-6">
                                <img class="img-fluid" src="{{ asset('uploads/ban_images') }}/{{ $view_ban_image }}"
                                    alt="">
                                
                            </div>
                            @endif
                            <div class="fileinput fileinput-new text-center mr-5" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                <div>
                                    <span class="btn btn-raised  btn-info btn-simple btn-file">
                                        <span for='ban_image' class="fileinput-new">Ban Görseli</span>
                                        <span class="fileinput-exists">Değiştir</span>
                                        <input type="file" name="ban_image" wire:model='ban_image'
                                            id='ban_image' />

                                    </span>
                                    <a href="javascript:;" class="btn btn-danger fileinput-exists"
                                        data-dismiss="fileinput">
                                        <i class="fa fa-times"></i> Kaldır</a>
                                </div>
                            </div>
                        </div>


                        <div class="modal-footer col-md-12">
                            <button type="submit" class="btn btn-sm btn-success">Ban düzenle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            const modalIds = ['banUserModal', 'baneditUserModal'];

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

        window.addEventListener('show-ban-user-modal', event => {
            $('#banUserModal');
            setTimeout(function() {
                variable = "banUserModal";
                document.getElementById('banUserModal').style.opacity = "1";
                document.getElementById('banUserModal').style.display = "block";
                var divElement = document.createElement("div");
                divElement.classList.add("modal-backdrop", "fade", "show");
                document.body.appendChild(divElement);
            }, 150);
            modal('show');
        });

        window.addEventListener('show-ban-edit-user-modal', event => {
            $('#baneditUserModal');
            setTimeout(function() {
                variable = "ban_editUserModal";
                document.getElementById('baneditUserModal').style.opacity = "1";
                document.getElementById('baneditUserModal').style.display = "block";
                var divElement = document.createElement("div");
                divElement.classList.add("modal-backdrop", "fade", "show");
                document.body.appendChild(divElement);
            }, 150);
            modal('show');
        });
    </script>
@endpush
