@extends('layouts.ap.app')
@section('index', 'events')
@section('title', 'Events')
@section('zone', 'AP')
@section('content')
  @include('partials.ap.nav')
  @include('partials.ap.header')
  <div class="pcoded-main-container">
    <div class="pcoded-wrapper">
      <div class="pcoded-content">
        <div class="pcoded-inner-content">
          {{-- is logged in and is staff --}}
          @if($data['user']->isAuthorized())
            {{-- is adm, gm or gma --}}
            @if($data['user']->isADM() || $data['user']->isGM() || $data['user']->isGMA())
            {{display('get_ticket_modal','','0','2','View Ticket')}}
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Create New Event</h5>
                        </div>
                        <div class="card-body">
                          <p id="response"></p>
                          <form method="post">
                            <div class="form-group mx-sm-3 mb-2">
                              <input type="text" name="title" placeholder="Title" class="form-control"/>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                              <input type="text" name="details" placeholder="Details" class="form-control"/>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                              <input type="text" name="start" placeholder="Start Time" class="form-control"/>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                              <input type="text" name="end" placeholder="End Time" class="form-control"/>
                            </div>
                            <p class="text-center">
                              <button type="submit" class="btn btn-sm btn-primary m_auto" id="submit">Create</button>
                            </p>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @else
            {{redirect('/admin/auth/login')}}
          @endif
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
        $("button#submit").click(function(e){
          e.preventDefault();

          let eventTitle = $("input[name=title]").val();
          let eventDetails = $("input[name=details]").val();
          let eventStartTime = $("input[name=start]").val();
          let eventEndTime = $("input[name=end]").val();

          $.ajax(
                {
                    url: '/admin/site/createEvent',
                    method: 'POST',
                    data: {
                        eventTitle,
                        eventDetails,
                        eventStartTime,
                        eventEndTime
                    },
                    success: function(response) {
                        $("#response").html(response);
                    },
                    dataType: 'text'
                }
            )
        });
    });
  </script>
@endsection
