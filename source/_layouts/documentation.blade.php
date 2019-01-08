@extends('_layouts.master')
@section('body-classes', 'single')

@section('meta')
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@maizzlemail">
<meta name="twitter:creator" content="@cossssmin">
<meta property="twitter:image" content="{{ $page->baseUrl . '/img/maizzle-card.jpg' }}" />
<meta name="twitter:title" content="{!! $page->title ? $page->title . ' - ' : '' !!}{{ $page->name ?? '' }} Documentation">
<meta name="twitter:description" content="{!! $page->description ? $page->description : 'Documentation for the ' . $page->name !!}">
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ $page->baseUrl }}" />
<meta property="og:image" content="{{ $page->baseUrl . '/img/maizzle-card.jpg' }}" />
<meta property="og:title" content="{!! $page->title ? $page->title . ' - ' : '' !!}{{ $page->name ?? '' }} Documentation" />
<meta property="og:description" content="{!! $page->description ? $page->description : 'Documentation for the ' . $page->name !!}" />
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.css" />
@endpush

@section('body')

    @include('_layouts.partials.headers.page')

    <div class="container flex flex-row justify-between">

        @include('_layouts.partials.navigation')

        <main class="content min-w-0 md:w-4/5 lg:w-full md:pl-8 lg:pl-0 pt-24 md:pt-32 md:text-sm text-grey-darker transition-transform z-40">
            <div class="content-overlay hidden fixed pin-r pin-t h-full w-full bg-white opacity-25"></div>
            @yield('content')
            @include('_layouts.components.pagenav', ['page' => $page])
        </main>

        <aside class="hidden lg:block w-1/3 sidebar-navigation mt-20">
            <div class="pl-16 fixed sticky top-20 w-full">
                <div class="overflow-y-auto wrapper py-12">
                    <h4 class="font-normal text-grey-darkest mb-4 mt-2 p-0">Quickies</h4>
                    <ul class="quickies list-reset text-sm text-grey-dark"></ul>
                </div>
            </div>
        </aside>
    </div>

@push('scripts')
    <script src="{{ mix('/js/app.js') }}"></script>
    @include('_layouts.partials.docsearch')
@endpush

@endsection
