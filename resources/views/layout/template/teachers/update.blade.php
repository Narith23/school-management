@extends('layout.inc.app')

@section('title')
    {{ ucwords($title_page) }}
@endsection

@section('page_header')
    @include('layout.inc.page_header', [
        'title' => $title,
        'subtitle' => 'Update',
        'breadcrumb' => $breadcrumb ?? [],
    ])
@endsection

@section('main_page')
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route($url_update, $object->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('layout.inc.form.update', [
                    'dataType' => $dataType ?? [],
                    'object' => $object,
                ])
            </form>
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
