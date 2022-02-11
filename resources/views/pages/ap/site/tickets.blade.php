@extends('layouts.ap.app')
@section('index', 'tickets')
@section('title', 'Tickets')
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
                          <h5>Tickets</h5>
                        </div>
                        <div class="card-body">
                          @if (count($data['tickets']->getTickets()) > 0)
                            <div class="table-responsive">
                              <table class="table table-dark">
                                <thead>
                                  <tr>
                                    <th>Ticket ID</th>
                                    <th>Category</th>
                                    <th>Account Name</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($data['tickets']->getTickets() as $res)
                                    <tr>
                                      <td>{{$res->TicketID}}</td>
                                      <td>{{$res->Category}}</td>
                                      <td>{{$res->UserID}}</td>
                                      <td>{{$res->Subject}}</td>
                                      <td>{{$data['data']->convertTimeToDate('F d, Y', $res->Date)}}</td>
                                      <td><button class="btn btn-sm btn-primary open_send_ticket_modal" data-toggle="modal"  data-id="{{$res->UserUID}}~{{$res->TicketID}}~{{$res->Type}}~{{$res->Status}}~{{$res->Category}}~{{$res->Subject}}~{{$res->Main}}~{{$_SESSION['User']['UserUID']}}" data-target="#get_ticket_modal">View</button></td>
                                    </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          @else
                            There are currently no tickets to edit.
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
@endsection
