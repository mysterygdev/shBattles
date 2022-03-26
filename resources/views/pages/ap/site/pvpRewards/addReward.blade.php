@extends('layouts.ap.app')
@section('index', 'addPvpRewards')
@section('title', 'Add Reward')
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
                          <h5 class="">Add new reward</h5>
                          <div class="float-right">
                            <button type="button" class="btn btn-sm btn-primary"  onclick="window.open('/admin/site/pvpRewards/manageRewards','_self')">Manage Rewards</button>
                          </div>
                        </div>
                        <div class="card-body">
                          <form method="post">
                            <p id="response"></p>
                            <div class="form-group">
                              <label for="RewardType">RewardType</label>
                              <input type="text" class="form-control" id="RewardType" name="RewardType" placeholder="Enter Reward Type">
                              <small id="RewardType" class="form-text text-muted">Reward Type (Points) = Only valid setting atm</small>
                            </div>
                            <div class="form-group">
                              <label for="K1Req">Kills Required</label>
                              <input type="text" class="form-control" id="K1Req" name="K1Req" placeholder="Enter Kills Required">
                              <small id="K1Req" class="form-text text-muted">Kills Required - how many kills are required for this reward?</small>
                            </div>
                            <div class="form-group">
                              <label for="Points">Points</label>
                              <input type="text" class="form-control" id="Points" name="Points" placeholder="Enter Points Reward">
                              <small id="Points" class="form-text text-muted">Points - how many points will user receive?</small>
                            </div>
                            <p class="text-center">
                              <button type="submit" class="btn btn-sm btn-primary" name="submit" id="submit">Create New Reward</button>
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
    document.body.addEventListener("click", e => {
      if(e.target.closest("#submit")) {
        e.preventDefault();
        const rewardType =  document.querySelector('input[name="RewardType"]').value;
        const k1Req =  document.querySelector('input[name="K1Req"]').value;
        const points =  document.querySelector('input[name="Points"]').value;

        const response =  document.querySelector('#response');

        fetch('/admin/site/pvpRewards/submitReward', {
          method: 'post',
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
              "Content-Type": "application/json"
          },
          body: JSON.stringify({
              rewardType,
              k1Req,
              points
          })
        })
        .then(r => r.text())
        .then(data => {
          var parser = new DOMParser();
          var doc = parser.parseFromString(data, "text/html");
          response.innerHTML = doc.documentElement.innerHTML;
        })
      }
    });
  </script>
@endsection
