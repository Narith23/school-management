<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 d-flex align-items-baseline">
                <h1 class="mr-1">{{ ucwords($title) }}</h1> <span class="text-muted ml-1">{{ $subtitle ?? '' }}</span> <a href="javascript:void(0)" class="text-muted ml-1"> {{ __("messages.back_to_all") }} {{ ucwords($title) }}</a>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @foreach ($breadcrumb as $item)
                        @if ($item['active'] == false)
                            <li class="breadcrumb-item"><a
                                    href="{{ $item['url'] == "project.show" ? route($item['url'], $project->id) : $item['url'] }}">{{ ucwords($item['title']) }}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item active">{{ ucwords($item['title']) }}</li>
                        @endif
                    @endforeach
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
