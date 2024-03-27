@extends("layout.inc.app")

@section('title')
    {{ ucwords($title_page) }}
@endsection

@section('page_header')
    @include('layout.inc.page_header', [
        'title' => $title,
        'subtitle' => 'Create',
        'breadcrumb' => $breadcrumb ?? [],
    ])
@endsection

@section('main_page')
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route($url_store) }}" method="POST">
                @csrf
                @include('layout.inc.form.create', [
                    'dataType' => $dataType ?? []
                ])
            </form>
        </div>
    </section>
@endsection

@section('after_script')
    <script>
        $(document).ready(function() {
            $(".teacher-management").addClass("active");
        })
    </script>
@endsection
