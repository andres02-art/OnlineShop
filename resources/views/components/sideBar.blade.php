<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="profileSideBar" aria-labelledby="offcanvasScrollingLabel">
    {{ $slot }}
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Opciones</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <profile-menu :auth-user={{ Auth::user()->id??'false' }}></profile-menu>
        <hr>
        <nav class="d-fex col-3 flex-column flex-warp bd-sidebar">
            <div class="row"><p class="px-5 link-secondary" data-bs-dismiss="offcanvas" aria-label="Close">Cerrar</p></div>
        </nav>
    </div>
</div>
