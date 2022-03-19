@extends('layouts.ap.app')
@section('index', 'manageDonations')
@section('title', 'Manage Donations')
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
                          <h5 class="">Manage donations</h5>
                          <div class="float-right">
                            <button type="button" class="btn btn-sm btn-primary"  onclick="window.open('/admin/paymentCenter/addDonation','_self')">Add New Donation</button>
                          </div>
                        </div>
                        <div class="card-body">
                          <!-- need paginator for other pages of products, maybe datatables?? homepage example?? -->
                          @if (count($data['donations']->getDonations()) > 0)
                            <table class="table table-striped" id="NewPlayers">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Reward</th>
                                  <th>Bonus</th>
                                  <th>Price</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($data['donations']->getDonations() as $fet)
                                  <tr>
                                    <td>{{$fet->RowID}}</td>
                                    <td>{{$fet->Reward}}</td>
                                    <td>{{!empty($fet->Bonus) ? $fet->Bonus : 'N/A'}}</td>
                                    <td>{{$fet->Price}}</td>
                                    <td><button type="button" class="btn btn-sm btn-primary" name="submit" onclick="window.open('/admin/webmall/editProduct?id={{$fet->ProductID}}','_target')">Edit</button></td>
                                    <td><button type="submit" class="btn btn-sm btn-danger open_mp_rmv_modal" data-toggle="modal" data-id="{{$fet->ProductID}}~{{$fet->ProductName}}~{{$fet->ProductCode}}" data-target="#get_mP_rmv_modal">Remove</button></td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          @else
                            There are currently no donation items.
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
