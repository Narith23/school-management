@extends("layout.inc.app")

@section("title")
    {{ ucwords($title_page) }}
@endsection

@section("page_header")
    @include("layout.inc.page_header", [
        "title" => $title,
        "subtitle" => "Showing from " . $objects->firstItem() . " to " . $objects->lastItem() . " of " . $objects->total(),
        "breadcrumb" => $breadcrumb ?? []
    ])
@endsection

@section("main_page")
    <section class="content">
        <div class="container-fluid">
            @include("layout.inc.button.create", [
                "url" => route($url_create),
                "title" => $title,
                "icon" => "fas fa-plus",
                "class" => "btn-success",
            ])

            @include("layout.base.table", [
                "objects" => $objects ?? [],
                "dataTable" => $dataTable,
            ])
        </div>
    </section>
@endsection

@section("after_script")
    <script>
        $(document).ready(function() {
            $(".teacher-management").addClass("active");
        })
    </script>
@endsection
