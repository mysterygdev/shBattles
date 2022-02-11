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
                          <h5>Events</h5>
                        </div>
                        <div class="card-body">
                          <a href="/admin/site/newEvent" class="btn btn-sm btn-primary float-right">New Event</a>
                          @Separator(50)
                          @if (count($data['events']->getEvents()) > 0)
                            <p id="response"></p>
                            <table class="table table-striped" id="events">
                              <thead>
                                <tr>
                                  <th>Event ID</th>
                                  <th>Title</th>
                                  <th>Details</th>
                                  <th>Start Time</th>
                                  <th>End Time</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($data['events']->getEvents() as $res)
                                  <form method="post">
                                    <tr>
                                      <td>{{$res->EventID}}</td>
                                      <td>
                                        <input type="text" class="form-control" name="eventTitle{{$res->EventID}}" value="{{$res->Title}}"/>
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="eventDetails{{$res->EventID}}" value="{{$res->Details}}"/>
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="eventStartTime{{$res->EventID}}" value="{{$res->StartTime}}"/>
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="eventEndTime{{$res->EventID}}" value="{{$res->EndTime}}"/>
                                      </td>
                                      <td>
                                        <button class="btn btn-sm btn-primary" name="submit" id="submit" data-id="{{$res->EventID}}">Update</button>
                                      </td>
                                      <td>
                                        <button class="btn btn-sm btn-danger" id="delete" data-id="{{$res->EventID}}">Delete</button>
                                      </td>
                                    </tr>
                                  </form>
                                @endforeach
                              </tbody>
                            </table>
                          @else
                            There are no events to edit.
                          @endif
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

          let eventId = $(this).data("id");
          let eventTitle = $("input[name=eventTitle"+eventId + "]").val();
          let eventDetails = $("input[name=eventDetails"+eventId + "]").val();
          let eventStartTime = $("input[name=eventStartTime"+eventId + "]").val();
          let eventEndTime = $("input[name=eventTitle"+eventId + "]").val();

          $.ajax(
                {
                    url: '/admin/site/updateEvent',
                    method: 'POST',
                    data: {
                        eventId,
                        eventTitle,
                        eventDetails,
                        eventStartTime,
                        eventEndTime,
                    },
                    success: function(response) {
                        $("#response").html(response);
                    },
                    dataType: 'text'
                }
            )
        });
        $("button#delete").click(function(e){
          e.preventDefault();

          let eventId = $(this).data("id");

          $.ajax(
                {
                    url: '/admin/site/deleteEvent',
                    method: 'POST',
                    data: {
                        eventId
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
