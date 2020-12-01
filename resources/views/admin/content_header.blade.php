<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            @yield('header', 'Лендинг. Админка.')
        </h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        @yield('breadcrumbs')
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="float-right">
    @stack('buttons2')
</div>
<div class="clearfix"></div>
