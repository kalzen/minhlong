@extends('layouts.minhlong')

@section('content')
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.library.page_title') }}</h1>
                    <div class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('site.nav.home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('site.library.page_title') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-service-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="table-responsive wow fadeInUp">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('site.library.page_title') }}</th>
                                <th>{{ __('site.library.download') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($documents as $doc)
                                @php($media = $doc->getFirstMedia('file'))
                                <tr>
                                    <td>{{ $doc->title }}</td>
                                    <td>
                                        @if ($media)
                                            <a href="{{ route('site.library.download', $doc) }}" class="btn-default btn-highlighted btn-sm">{{ __('site.library.download') }}</a>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">—</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
