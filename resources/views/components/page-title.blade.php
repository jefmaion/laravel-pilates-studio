<div class="row">
    <div class="col">
        <h3 class="font-weight-ligdht"> {{ $title }}</h3>
    </div>
    @if(isset($breadcrumb))
    <div class="col ">
        <x-breadcrumb>
            {{ $breadcrumb }}
        </x-breadcrumb>
    </div>
    @endif
</div>