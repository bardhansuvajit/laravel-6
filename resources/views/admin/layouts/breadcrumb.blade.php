<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0">@yield('page')</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                @if ( trim($__env->yieldContent('page')) === 'Dashboard' )
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                @else
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">@yield('page')</li>
                @endif
            </ol>
        </div>
        </div>
    </div>
</div>