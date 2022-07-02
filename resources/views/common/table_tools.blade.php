<div class="row">

    @hasSection('button')

    <div class="col-lg-2">
        @yield('button')
    </div>

    <div class="col-lg-10">
        <form>
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="s" placeholder="Nhập từ khóa tìm kiếm..." aria-label="Recipient's username" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i> Tìm kiếm
                    </button>
                </div>
            </div>
        </form>
    </div>

    @else

    <div class="col-lg-12">
        <form>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="s" placeholder="Nhập từ khóa tìm kiếm..." aria-label="Recipient's username" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i> Tìm kiếm
                    </button>
                </div>
            </div>
        </form>
    </div>

    @endif
</div>