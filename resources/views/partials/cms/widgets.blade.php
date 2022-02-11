<div class="col-auto mpl-sidebar" data-sr=widget data-sr-duration=1200 data-sr-distance=20>
    @if(count($data['widgets']->display()) > 0)
        @foreach($data['widgets']->display() as $widget)
            <div class="mpl-widget mpl-widget-search">
                <h4 class="mpl-widget-title" data-sr-item="widget">{{$widget->Title}}</h4>
                {{-- <h5 class="fsize-20 text-center">{{$widget->Title}}</h5> --}}
                <div class="mpl-widget-content">
                    {{$data['widgets']->loadWidgets($widget->Name, $data)}}
                </div>
            </div>
        @endforeach
    @endif
</div>
