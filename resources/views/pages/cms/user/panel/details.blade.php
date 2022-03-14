@guest
  <p>Please login to continue.</p>
@else
  <form id="pass_form" method="post">
    <div id="response"></div><br>
    <div class="form-row">
      <div class="col-md-3 mb-3">
        <label for="username">Display name:</label>
        <div class="input-group mb-3 youplay-input">
          <input type="text" placeholder="Display name" value="{{$data['user']->DisplayName}}" disabled>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <label for="username">User name:</label>
        <div class="input-group mb-3 youplay-input">
          <input type="text" placeholder="User name" value="{{$data['user']->UserID}}" disabled>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <label for="username">Email:</label>
        <div class="input-group mb-3 youplay-input">
          <input type="text" placeholder="Email" value="{{$data['user']->Email}}" disabled>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <label for="username">Status:</label>
        <div class="input-group mb-3 youplay-input">
          <input type="text" placeholder="Status" value="{{$data['data']->statusToText($data['user']->Status)}}" disabled>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <label for="username">Points:</label>
        <div class="input-group mb-3 youplay-input">
          <input type="text" placeholder="Points" value="{{$data['user']->Point}}" disabled>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <label for="username">Member since:</label>
        <div class="input-group mb-3 youplay-input">
          <input type="text" placeholder="Member since" value="{{$data['data']->convertTimeToDate('F d, Y', $data['user']->JoinDate)}}" disabled>
        </div>
      </div>
    </div>
  </form>
@endguest
