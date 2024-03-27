@extends('layout.inc.app')

@section('title')
    {{ ucwords($title_page) }}
@endsection

@section('page_header')
    @include('layout.inc.page_header', [
        'title' => $title,
        'subtitle' => __('messages.preview'),
        'breadcrumb' => $breadcrumb ?? [],
    ])
@endsection

@section('main_page')
    <section class="content">
        <div class="container-fluid">
            @include('layout.inc.form.show', [
                'dataType' => $dataType ?? [],
                'object' => $object,
            ])
        </div>
    </section>
@endsection

@section('after_script')
    <script>
        $(document).ready(function() {
            $(".grade_level-management").addClass("active");
        });
    </script>
@endsection
