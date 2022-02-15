@extends('layouts.cms.app')
@section('index', 'support')
@section('title', 'Support')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>

      {{-- <div class="info">
        <div>
          <div class="container">
            <h1>title</h1>
          </div>
        </div>
      </div> --}}
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Support</h2>
        @guest
          <p>Please login to continue.</p>
        @else
          {{-- {{display('get_ticket_modal','','0','2','Create Ticket')}}
          {{display('get_e_ticket_modal','','0','2','Edit Ticket')}} --}}
        <div role="tabpanel">
          <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#myT" aria-controls="myT" role="tab" data-toggle="tab" aria-expanded="true">My Tickets</a></li>
            <li class=""><a href="#newT" aria-controls="newT" role="tab" data-toggle="tab" aria-expanded="false">New Ticket</a></li>
          </ul>

          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="myT">
              <div class="table-responsive dataTables_wrapper no-footer" id="TableLoader">
                <table class="display dTables dataTable table table-sm table-dark table-striped text-center" id="TabularData">
                  <thead>
                    <tr class="text-center">
                      <td>Ticket ID</td>
                      <td>Subject</td>
                      <td>Status</td>
                      <td>Last Updated</td>
                      <td>Edit</td>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      #display('get_e_ticket_modal','<i class="fas fa-user-plus"></i>','0','2','Edit Ticket');
                      $data['support']->getTickets();
                    @endphp
                    @foreach($data['support']->fet as $res)
                      <tr>
                        <td class="text-center">{{$res->TicketID}}</td>
                        <td class="text-center">{{$res->Subject}}</td>
                        <td class="text-center">{{$data['data']->tracker($res->Status)}}</td>
                        <td class="text-center">{{$data['data']->convertTimeToDate('F d, Y h:i', $res->Date)}}</td>
                        <td class="text-center"><a href="/help/support/ticket/{{$res->TicketID}}" target="_blank" class="btn gradient color-white">Edit</a></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="newT">
              <form class="send_ticket" method="POST">
                <div class="text-center">
                  <label for="MessageTest">Please provide as much detail as possible so we can best assist you.</label>
                </div>
                <p id="response"></p>
                <div class="row m_b_10">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                    <div class="text-center">
                      <label for="MessageTest">Category:</label>
                    </div>
                    <div class="input-wrap">
                      <select name="Category" id="Category" class="form-control form-custom tac">
                        <option>Choose One</option>
                        <option>Billing</option>
                        <option>Bug Reports</option>
                        <option>Player Reports</option>
                        <option>Ban Appeal</option>
                        <option>GM Services</option>
                        <option>Technical Issues</option>
                        <option>Others</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row m_b_10">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                    <div class="text-center">
                      <label for="MessageTest">Subject:</label>
                    </div>
                    <div class="input-wrap">
                      <input type="text" name="Subject" placeholder="Subject" class="form-control form-custom tac b_i"/>
                    </div>
                  </div>
                </div>
                <div class="row m_b_10">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                    <div class="text-center">
                      <label for="MessageTest">Message:</label>
                    </div>
                    <div class="youplay-textarea form-group">
                      <textarea name="Message" placeholder="Message" class="form-control form-custom tac b_i"></textarea>
                    </div>
                  </div>
                </div>
                @php Separator(20); @endphp
                <div class="row m_b_10">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                    <button type="button" class="btn gradient color-white text-center" id="send_ticket_submit">Create Ticket <i class="fa fa-send"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        @endguest
    </div>
  </section>
  @include('layouts.cms.footer')
  @include('layouts.cms.scripts')
  <script>
    $(document).ready(function(){
      $("button#send_ticket_submit").click(function(){
        $.ajax({
          type: "POST",
          url:"/resources/jquery/addons/ajax/site/support/send_ticket_submit.php",
          data: $("form.send_ticket").serialize(),
          success: function(message){
            $("#response").html(message);
            $("#TableLoader").load(location.href + " #TabularData");
          },
          error: function(){
            alert("Error");
          }
        });
      });
    });
  </script>
@endsection
