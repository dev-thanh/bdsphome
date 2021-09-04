    
@extends('frontend.master')
@section('main')
    <?php if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	} ?>
    <main id="main">
        <div class="container">
            <ul class="breadcrumb__global">
                <li>
                    <a href="index.html" title="trang chủ">
                    Trang chủ
                    </a>
                </li>
                <li>
                    <a href="{{route('home.faq')}}" title="Câu hỏi thường gặp">
                    Câu hỏi thường gặp
                    </a>
                </li>
            </ul>
        </div>
        <section class="page__question">
            <div class="container">
                <div class="module module-page__question">
                    <div class="module__header">
                        <h2 class="title">
                            Câu hỏi thường gặp
                        </h2>
                    </div>
                    <div class="module__content">

                        @foreach($content as $k => $item)
                        <div class="question__group">
                            <div class="question__header @if($loop->first) active @endif">
                                <h3 class="question__title">
                                {{$item->question}}
                                </h3>
                                <button class="btn btn__question">
                                <img src="{{ __BASE_URL__ }}/images/icons/arrow-down.svg" alt="x.svg">
                                <img src="{{ __BASE_URL__ }}/images/icons/x.svg" alt="x.svg">
                                </button>
                            </div>
                            <div class="question__body @if($loop->first) active @endif">
                                <div class="question__content">
                                    {{$item->asw}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection