@php
    $content = content('howitwork.content');
    $elements = element('howitwork.element')->take(8);
@endphp

<div class="container">
    <div class="card mt-2">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-top  wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
                        <h3 class="mb-2">{{ __(@$content->data->title) }}</h3>
                    </div>
                </div>
            </div>

            <div class="row gy-4 justify-content-center">
                @foreach ($elements as $element)
                    <div class="col-lg-4 col-md-6">
                        <div class="work-item">
                            <div class="work-number bg-pink-light">
                                {{ $loop->iteration }}
                            </div>
                            <div class="work-content">
                                <h4 class="title">{{ __(@$element->data->title) }}</h4>
                                <p class="mt-2"><?= clean($element->data->short_description) ?></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
