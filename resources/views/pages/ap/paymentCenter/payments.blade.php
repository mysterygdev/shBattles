@extends('layouts.ap.app')
@section('index', 'payments')
@section('title', 'Payments')
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
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card">
                        <div class="card-header text-center">
                          <h5 class="">View Payments</h5>
                        </div>
                        <div class="card-body">
                          @if (count($data['payments']->getPayments()) > 0)
                            <table class="table table-striped" id="NewPlayers">
                              <thead>
                                <tr>
                                  <th>UserID</th>
                                  <th>Amount Paid</th>
                                  <th>Reward</th>
                                  <th>Email</th>
                                  <th>Payment Status</th>
                                  <th>Payment Type</th>
                                  <th>Payment Date</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($data['payments']->getPayments() as $fet)
                                  <tr>
                                    <td>{{$fet->UserID}}</td>
                                    <td>{{$fet->Paid}}</td>
                                    <td>{{$fet->Reward}}</td>
                                    <td>{{$fet->DonatorEmail}}</td>
                                    <td>{{$fet->PaymentStatus}}</td>
                                    <td>{{$fet->PaymentType}}</td>
                                    <td>{{$fet->PaymentDate}}</td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          @else
                            There are currently no posted payments.
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
