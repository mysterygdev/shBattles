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
          <!-- TODO: first, check if item exists in warehouse, then do this .. -->
          @if(count($data['terra']->getAliveCharacters()) > 0)
            @if(count($data['terra']->checkIfUserHasItem('100204', 1)) > 0)
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
                @if (isset($_POST['submit']))
                  @if ($data['terra']->checkIfCharNotSelected())
                    You must select a character to continue.
                  @else
                    <!-- If char selected, continue .. -->
                    <p class="text-center">
                      <button type="submit" class="btn btn-md" name="moveChar" id="moveChar" style="margin-left:10px;">Move character</button>
                    </p>
                  @endif
              @endif
              @if(isset($_POST["moveChar"]) || !empty($_POST["moveChar"]))
                @if ($data['terra']->movePlayerToMap())
                  <p class="text-center">
                    Character moved to Terra successfully.
                  </p>
                @else
                  <p class="text-center">
                    An error has occured.
                  </p>
                @endif
              @endif
              </form>
            @else
              <p class="text-center fw_bold">You do not have the required item to proceed.</p>
            @endif
          @else
            <p class="text-center fw_bold">You have no alive characters.</p>
          @endif
        @endguest
    </div>
  </section>

  @include('layouts.cms.footer')
  @include('layouts.cms.scripts')
@endsection
