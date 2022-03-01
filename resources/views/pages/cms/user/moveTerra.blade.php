@extends('layouts.cms.app')
@section('index', 'moveTerra')
@section('title', 'Move To Terra')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content">
        <h2 class="mt-0 text-center">Move To Terra</h2>
        @guest
          <p>Please login to continue.</p>
        @else
          <p class="text-center">Here you can move to our special map terra.</p>
          <p id="response"></p>
          @if(count($data['terra']->getAliveCharacters()) > 0)
            <form class="form-inline" method="post">
              <div class="col-md-3"></div>
              <div class="col-md-8">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Char Name</th>
                      <th>Select</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data['terra']->getAliveCharacters() as $fet)
                      <tr>
                        <td>{{$fet->CharName}}</td>
                        <td><input type="radio" name="CharID" value="{{$fet->CharID}}"></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              @Separator(20)
              <p class="text-center">
                <button type="submit" class="btn btn-sm" name="submit" id="submit" style="margin-left:10px;">Select character</button>
              </p>
            </form>
          @else
            You have no alive characters.
          @endif
        @endguest
    </div>
  </section>

  @include('layouts.cms.footer')
  @include('layouts.cms.scripts')
  <script>
    const shareBtn = document.getElementById('submit');
    shareBtn.addEventListener('click', e => {
      e.preventDefault();

      const dp =  document.querySelector('input[name="dp"]').value;
      const char =  document.querySelector('input[name="char"]').value;

      const response =  document.querySelector('#response');

      fetch('/user/getShareDp', {
        method: 'post',
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          dp,
          char
        })
      })
      .then(r => r.text())
      .then(data => {
        var parser = new DOMParser();
        var doc = parser.parseFromString(data, "text/html");
        response.innerHTML = doc.documentElement.innerHTML;
      })
    });
  </script>
@endsection
