@extends('layouts.ap.app')
@section('index', 'editTierReward')
@section('title', 'Edit Reward')
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
                          <h5 class="">Editing Reward: <strong class="font-weight-bold">{{$data['id']}}</strong></h5>
                          <div class="float-right">
                            <button type="button" class="btn btn-sm btn-primary"  onclick="window.open('/admin/site/tieredSpender/manageRewards','_self')">Manage Rewards</button>
                          </div>
                        </div>
                        <div class="card-body">
                          @if (count($data['rewards']->getRewardById($data['id'])) > 0)
                            <form method="post">
                              {{$data['rewards']->loadImages()}}
                              <p id="response"></p>
                              @foreach ($data['rewards']->getRewardById($data['id']) as $fet)
                                <div class="form-group">
                                  <label for="RewardID">RewardID</label>
                                  <input type="text" class="form-control" id="RewardID" name="RewardID" value="{{$fet->RowID}}" readonly>
                                </div>
                                <div class="form-group">
                                  <label for="RewardName">Reward Name</label>
                                  <input type="text" class="form-control" id="RewardName" name="RewardName" placeholder="Enter Reward Name" value="{{isset($fet->RewardName) ? $fet->RewardName : ''}}">
                                  <small id="RewardName" class="form-text text-muted">Reward Name</small>
                                </div>
                                <div class="form-group">
                                  <label for="RewardDesc">Reward Desc</label>
                                  <input type="text" class="form-control" id="RewardDesc" name="RewardDesc" placeholder="Enter Reward Desc" value="{{isset($fet->RewardDesc) ? $fet->RewardDesc : ''}}">
                                  <small id="RewardDesc" class="form-text text-muted">Reward Desc</small>
                                </div>
                                <div class="form-group">
                                  <label for="RewardItemID">Reward Item ID</label>
                                  <input type="text" class="form-control" id="RewardItemID" name="RewardItemID" placeholder="Enter Reward Item ID" value="{{isset($fet->RewardItemID) ? $fet->RewardItemID : ''}}">
                                  <small id="RewardItemID" class="form-text text-muted">Reward Item ID</small>
                                </div>
                                <div class="form-group">
                                  <label for="RewardQuantity">Reward Quantity</label>
                                  <input type="text" class="form-control" id="RewardQuantity" name="RewardQuantity" placeholder="Enter Reward Quantity" value="{{isset($fet->RewardQuantity) ? $fet->RewardQuantity : ''}}">
                                  <small id="RewardQuantity" class="form-text text-muted">Reward Quantity</small>
                                </div>
                                <div class="form-group">
                                  <label for="Tier">Tier</label>
                                  <input type="text" class="form-control" id="Tier" name="Tier" placeholder="Enter Tier" value="{{isset($fet->Tier) ? $fet->Tier : ''}}">
                                  <small id="Tier" class="form-text text-muted">Tier 1-10</small>
                                </div>
                                <p class="text-center">
                                  <button type="submit" class="btn btn-sm btn-primary" name="submit" id="submit">Save Changes</button>
                                </p>
                                <input type="hidden" name="id" value="{{$data['id']}}"/>
                              @endforeach
                              <input type="hidden" name="oldImage" value="{{isset($fet->RewardImage) ? $fet->RewardImage : ''}}"/>
                              <input type="hidden" name="newImage" value="{{isset($_GET['img']) ? $_GET['img'] : ''}}"/>
                            </form>
                          @else
                            Reward ID doesn't exist.
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
    document.body.addEventListener("click", e => {
      if(e.target.closest("#submit")) {
        e.preventDefault();

        const id =  document.querySelector('input[name="id"]').value;
        const rewardName =  document.querySelector('input[name="RewardName"]').value;
        const rewardDesc =  document.querySelector('input[name="RewardDesc"]').value;
        const oldRewardImage =  document.querySelector('input[name="oldImage"]').value;
        const newRewardImage =  document.querySelector('input[name="newImage"]').value;
        const rewardItemID =  document.querySelector('input[name="RewardItemID"]').value;
        const rewardQuantity =  document.querySelector('input[name="RewardQuantity"]').value;
        const rewardTier =  document.querySelector('input[name="Tier"]').value;

        const response =  document.querySelector('#response');

        fetch('/admin/site/tieredSpender/editRewardOpt', {
          method: 'post',
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
              "Content-Type": "application/json"
          },
          body: JSON.stringify({
              id,
              rewardName,
              rewardDesc,
              oldRewardImage,
              newRewardImage,
              rewardItemID,
              rewardQuantity,
              rewardTier
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
