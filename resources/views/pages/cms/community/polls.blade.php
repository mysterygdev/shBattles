@extends('layouts.cms.app')
@section('index', 'polls')
@section('title', 'Polls')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Polls</h2>
        @guest
          <p>Please login to continue.</p>
        @else
          @if (count($data['polls']->getPolls()) > 0)
            <p id="response"></p>
            <form id="poll_form" method="post">
            </form>
            @foreach ($data['polls']->getPolls() as $fet)
              <span id="{{$fet->id}}">{{$fet->poll_question}}</span>
              @if (count($data['polls']->getPollOptions($fet->id)) > 0)
                @foreach ($data['polls']->getPollOptions($fet->id) as $res)
                  <div>
                    <input type="radio" class="poll" name="pollopt{{$res->id}}" id="pollopt{{$res->id}}" value="{{$res->poll_option}}">{{$res->poll_option}}
                  </div>
                @endforeach
                <input type="hidden" value="{{$fet->poll_question}}" id="pollquestion{{$fet->id}}">
                <button class="btn btn-sm" id="poll_submit">Submit</button>
                <br>
              @else
                no options exist
              @endif
              <br>
            @endforeach
          @else
            No polls exist.
          @endif
        @endguest
    </div>
  </section>

    @include('layouts.cms.footer')
    @include('layouts.cms.scripts')
@endsection
