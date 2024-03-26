@extends("layout.inc.app")

@section("title")
    {{ ucwords($title_page) }}
@endsection

@section("page_header")
    @include("layout.inc.page_header", [
        "title" => $title,
        "breadcrumb" => $breadcrumb ?? []
    ])
@endsection

@section("after_script")
    <script>
        $(document).ready(function() {
            $(".dashboard").addClass("active");
        })
    </script>
@endsection
