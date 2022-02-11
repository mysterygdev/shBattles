@extends('layouts.cms.app')
@section('index', 'shareDp')
@section('title', 'Share DP')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')
  @include('partials.cms.pageHeader')
  <section class="blog-area ptb-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-12">
          @guest
            <p>Please login to continue.</p>
          @else
            <p>Here you can share your donation points with other players.</p>
            <h4>Available donation points: {{$data['share']->getSenderDp()}}</h4>
            <h4 id="response"></h4>
            <form class="form-inline" method="post">
              <div class="form-group">
                <input type="text" placeholder="how much dp?" class="form-control" name="dp" id="dp"/>
              </div>
              <div class="form-group">
                <input type="text" placeholder="char name" class="form-control m_l_5" name="char" id="char"/>
              </div>
              <br>
              <button type="submit" class="default-btn" name="submit" id="submit" style="margin-left:10px;">Submit</button>
            </form>
          @endguest
        </div>
        @include('partials.cms.widgets')
      </div>
    </div>
  </section>
  @include('layouts.cms.footer')
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
