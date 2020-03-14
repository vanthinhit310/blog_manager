{{-- manager --}}
<div class="modal mm-animated fadeIn is-active modal-manager__Inmodal">
    <div class="modal-background" @click.stop="hideInputModal()"></div>
    <div class="modal-content mm-animated fadeInDown">
        <div class="box">
            @include('layouts.footers.modal-media', ['modal' => true])
        </div>
        <div class="modal-footer pt-0">
            <button @click.stop="hideInputModal()" type="button" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Confirm</button>
        </div>
    </div>
    <button class="modal-close is-large is-hidden-touch" @click.stop="hideInputModal()"></button>
</div>
