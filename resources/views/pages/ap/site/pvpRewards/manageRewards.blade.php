@extends('layouts.ap.app')
@section('index', 'managePvpRewards')
@section('title', 'Manage Rewards')
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
                          <h5 class="">Manage Rewards</h5>
                          <div class="float-right">
                            <button type="button" class="btn btn-sm btn-primary"  onclick="window.open('/admin/site/pvpRewards/addReward','_self')">Add New Reward</button>
                          </div>
                        </div>
                        <div class="card-body">
                          @if (count($data['rewards']->getRewards()) > 0)
                            <table class="table table-striped" id="Payments">
                              <thead>
                                <tr>
                                  <th>RewardID</th>
                                  <th>RewardType</th>
                                  <th>Kills Required</th>
                                  <th>Points</th>
                                  <th>Action</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($data['rewards']->getRewards() as $fet)
                                  <tr>
                                    <td>{{$fet->RewardID}}</td>
                                    <td>{{$fet->RewardType}}</td>
                                    <td>{{$fet->K1Req}}</td>
                                    <td>{{$fet->Points}}</td>
                                    <td><button type="button" class="btn btn-sm btn-primary" name="submit" onclick="window.open('/admin/site/pvpRewards/editReward/{{$fet->RewardID}}','_target')">Edit</button></td>
                                    <td><button type="submit" class="btn btn-sm btn-danger open_mR_rmv_modal" data-toggle="modal" data-id="{{$fet->RewardID}}~{{$fet->RewardType}}~{{$fet->K1Req}}~{{$fet->Points}}" data-target="#get_mR_rmv_modal">Remove</button></td>
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
  {{display('get_mR_rmv_modal','','0','2','Confirm Reward Removal')}}
  <script>
  $(document).ready(function(){
    $('#Payments').dataTable( {
      "searching": true,
			"info": false,
			"bLengthChange": false
    });
	});
  $(document).on('click', '.open_mR_rmv_modal', function (e) {
      e.preventDefault();

      var uid = $(this).data("id");

          $("#get_mR_rmv_modal #dynamic-content").html("");
          $("#get_mR_rmv_modal #modal-loader").show();

      $.ajax({
        type: "POST",
        url: "/resources/jquery/addons/ajax/blade/init.pvpRewards_remove.php",
        data: "id="+uid,
        dataType: "html"
      })
      .done(function (data) {
        $('#get_mR_rmv_modal #dynamic-content').html('');
        $('#get_mR_rmv_modal #dynamic-content').hide().html(data).fadeIn("slow");
        $('#get_mR_rmv_modal #modal-loader').hide("slow");
      })
      .fail(function () {
        $("#get_mR_rmv_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
        $("#get_mR_rmv_modal #modal-loader").hide();
      });
    });
</script>
@endsection
