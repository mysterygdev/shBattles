@extends('layouts.cms.app')
@section('index', 'support')
@section('title', 'Support')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Support
      </h1>
      <div class="breadcrumbs">
        <a href="/">Home</a> /
        <a href="#">User</a> /
        <a href="/support">Support</a> /
        <span class="color-1">Ticket</span>
      </div>
    </div>
  </div>
  </section>
  {{display('get_ticket_modal','','0','2','Create Ticket')}}
  {{display('get_e_ticket_modal','','0','2','Edit Ticket')}}
  <section class="blog-content ptb150 each-element">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
            <div class="text-center">
              @guest
              <p>Please login to continue.</p>
              @else
                @if (count($data['support']->getTicketData($_SESSION['User']['UserUID'], $data['ticketID'])) > 0)
                  @foreach($data['support']->getTicketData($_SESSION['User']['UserUID'], $data['ticketID']) as $res)
                    <div class="row m_b_10">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                    <div class="text-center">
                        <h4 class="u">Editing Ticket: {{$res->Subject}}</h4>
                        <h5 class="u">Category: {{$res->Category}}</h5>
                      </div>
                    </div>
                  </div>
                  <form class="form-inline">
                    <div class="row pl_10_p">
                      <div class="form-group mx-sm-3 mb-2">
                        <label class="pr_5" for="TcktTest">Ticket ID:</label>
                        <input type="text" name="ticketID" value="{{$res->TicketID}}" class="form-control form-custom input-sm tac b_i" readonly/>
                      </div>
                      <div class="form-group mx-sm-3 mb-2">
                        <label class="pr_5" for="SubTest">Subject:</label>
                        <input type="text" name="Subject" value="{{$res->Subject}}" class="form-control form-custom input-sm tac b_i" readonly/>
                      </div>
                    </div>
                  </form>
                  @endforeach
                  <div class="container">
                    @foreach($data['support']->editTicket($_SESSION['User']['UserUID'], $data['ticketID']) as $tickets)
                      @if($tickets->Type == '0')
                        <div class="row">
                          <div class="col-md-4 col-md-offset-1 badge-pill badge-lightblue mt1p">
                            <div class="row plr_15">
                              <div class="col-md-12">
                                {{-- {{var_dump($data['user']->getUserGameInfo(5, 'UserID'))}} --}}
                                <p class="b_i"> {{$data['user']->getUserGameInfo($tickets->UserUID, 'UserID')}} said:</p>
                              </div>
                            </div>
                            <div class="row plr_15">
                              <div class="col-md-12">
                                <div class="float-left">
                                  {{$tickets->Message}}
                                </div>
                                <div class="float-right">
                                  {{date('F d, Y h:i:s A', strtotime($tickets->Date))}}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @php Separator(15); @endphp
                      @elseif($tickets->Type == '1')
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-4 col-md-offset-1 badge-pill badge-indiega mt1p">
                            <div class="row tar plr_15">
                              <div class="col-md-12">
                                <p class="b_i"> {{$data['user']->getUserGameInfo($tickets->RespUID, 'UserID')}} said:</p>
                              </div>
                            </div>
                            <div class="row tar plr_15">
                              <div class="col-md-12">
                                <div class="float-left">
                                  {{$tickets->Message}}
                                </div>
                                <div class="float-right">
                                  {{date('F d, Y h:i:s A', strtotime($tickets->Date))}}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @php Separator(15); @endphp
                      @endif
                    @endforeach
                  </div>
                  <form class="edit_ticket">
                    <input type="hidden" name="Category" value="{{$res->Category}}"/>
                    <input type="hidden" name="UserUID" value="{{$res->UserUID}}"/>
                    <input type="hidden" name="TicketID" value="{{$res->TicketID}}"/>
                    <input type="hidden" name="Subject" value="{{$res->Subject}}"/>
                    @if($res->Status==1 || $res->Status==2 || $res->Status==3)
                      <p id="response"></p>
                      <div class="row m_b_10">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <label for="MessageTest">Message:</label>
                            </div>
                            <div class="input-wrap">
                              <textarea name="Message" placeholder="Your message here..."
                              class="general_input italic"></textarea>
                            </div>
                        </div>
                      </div>
                      @php Separator(20); @endphp
                      <div class="row m_b_10">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <button type="button" class="btn gradient color-white text-center" id="edit_ticket_answer">Send
                      Message <i class="fa fa-send"></i></button>
                        </div>
                      </div>
                    @else
                      <div class="col-md-12 tac">
                        <button class="btn btn-dark f_20">
                            This ticket has been closed and is no longer available for editing.
                        </button>
                      </div>
                    @endif
                  </form>
                @else
                <p>🤯 This is not your ticket 🤯</p>
                @endif
              @endguest
            </div>
        </div>
        @include('partials.cms.widgets')
      </div>
    </div>
  </section>
  <script>
	$(document).ready(function(){
		$("button#edit_ticket_answer").click(function(){
			$.ajax({
				type: "POST",
				url:"/resources/jquery/addons/ajax/site/support/edit_ticket_answer.php",
				data: $("form.edit_ticket").serialize(),
				success: function(message){
					$("#response").html(message);
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>
	@include('layouts.cms.footer')
@endsection
