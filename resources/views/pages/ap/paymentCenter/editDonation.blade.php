@extends('layouts.ap.app')
@section('index', 'editDonation')
@section('title', 'Edit Donation')
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
                          <h5 class="">Edit Donation</h5>
                          <div class="float-right">
                            <button type="button" class="btn btn-sm btn-primary"  onclick="window.open('/admin/paymentCenter/manageDonations','_self')">Manage Donations</button>
                          </div>
                        </div>
                        <div class="card-body">
                          @if (count($data['donations']->getDonationById($data['id'])) > 0)
                            <form method="post">
                              <p id="response"></p>
                              @foreach ($data['donations']->getDonationById($data['id']) as $fet)
                                <div class="form-group">
                                  <label for="Reward">Reward</label>
                                  <input type="text" class="form-control" id="Reward" name="Reward" placeholder="Enter Reward" value="{{isset($fet->Reward) ? $fet->Reward : 'NULL'}}">
                                </div>
                                <div class="form-group">
                                  <label for="Bonus">Bonus</label>
                                  <input type="text" class="form-control" id="Bonus" name="Bonus" placeholder="Bonus" value="{{isset($fet->Bonus) ? $fet->Bonus : NULL}}">
                                  <small id="Bonus" class="form-text text-muted">Bonus Points (Not Required)</small>
                                </div>
                                <div class="form-group">
                                  <label for="Price">Price</label>
                                  <input type="text" class="form-control" id="Price" name="Price" placeholder="Price" value="{{isset($fet->Price) ? $fet->Price : 'NULL'}}">
                                </div>
                                <p class="text-center">
                                  <button type="submit" class="btn btn-sm btn-primary" name="submit" id="submit">Save Changes</button>
                                </p>
                                <input type="hidden" name="id" value="{{$data['id']}}"
                              @endforeach
                            </form>
                          @else
                            Donation option doesn't exist.
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
        const reward =  document.querySelector('input[name="Reward"]').value;
        const bonus =  document.querySelector('input[name="Bonus"]').value;
        const price =  document.querySelector('input[name="Price"]').value;

        const response =  document.querySelector('#response');

        fetch('/admin/paymentCenter/editDonationOpt', {
          method: 'post',
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
              "Content-Type": "application/json"
          },
          body: JSON.stringify({
              id,
              reward,
              bonus,
              price
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
