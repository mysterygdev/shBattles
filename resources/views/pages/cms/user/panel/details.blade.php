<form id="pass_form" method="post">
  <div id="response"></div><br>
  <div class="form-row">
    <div class="col-md-9 mb-3">
      <label for="username">Display name:</label>
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Display name" value="{{$data['user']->DisplayName}}">
      </div>
    </div>
    <div class="col-md-9 mb-3">
      <label for="username">User name:</label>
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="User name" value="{{$data['user']->UserID}}" disabled>
      </div>
    </div>
    <div class="col-md-9 mb-3">
      <label for="username">Email:</label>
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Email" value="{{$data['user']->Email}}">
      </div>
    </div>
    <div class="col-md-9 mb-3">
      <label for="username">Status:</label>
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Status" value="{{$data['data']->statusToText($data['user']->Status)}}" disabled>
      </div>
    </div>
    <div class="col-md-9 mb-3">
      <label for="username">Points:</label>
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Points" value="{{$data['user']->Point}}" disabled>
      </div>
    </div>
    <div class="col-md-9 mb-3">
      <label for="username">Member since:</label>
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Member since" value="{{$data['data']->convertTimeToDate('F d, Y', $data['user']->JoinDate)}}" disabled>
      </div>
    </div>
  </div>
</form>
