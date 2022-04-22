@guest
  <p>Please login to continue.</p>
@else
  {{display('get_edit_details_modal','','0','2','Edit Details')}}
  <form id="pass_form" method="post">
    <div id="response"></div><br>
    <div class="form-row">
      <div class="col-md-4 mb-4">
        <label for="displayname">Display name:</label>
        <div class="form-inline">
          <div class="input-group mb-3 youplay-input">
            <input type="text" placeholder="Display name" value="{{$data['user']->DisplayName}}" disabled>
          </div>
          <button class="btn btn-sm m_auto open_edit_details_modal" data-toggle="modal" data-id="DisplayName~{{$data['user']->DisplayName}}" data-target="#get_edit_details_modal">Edit</button>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <label for="username">User name:</label>
        <div class="form-inline">
          <div class="input-group mb-3 youplay-input">
            <input type="text" placeholder="User name" value="{{$data['user']->UserID}}" disabled>
          </div>
          <button class="btn btn-sm m_auto open_edit_details_modal" data-toggle="modal" data-id="UserID~{{$data['user']->UserID}}" data-target="#get_edit_details_modal">Edit</button>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <label for="email">Email:</label>
        <div class="form-inline">
          <div class="input-group mb-3 youplay-input">
            <input type="text" placeholder="Email" value="{{$data['user']->Email}}" disabled>
          </div>
          <button class="btn btn-sm m_auto open_edit_details_modal" data-toggle="modal" data-id="Email~{{$data['user']->Email}}" data-target="#get_edit_details_modal">Edit</button>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <label for="password">Password:</label>
        <div class="form-inline">
          <div class="input-group mb-3 youplay-input">
            <input type="password" placeholder="Password" value="{{$data['user']->Pw}}" disabled>
          </div>
          <button class="btn btn-sm m_auto open_edit_details_modal" data-toggle="modal" data-id="Pw~{{$data['user']->Pw}}" data-target="#get_edit_details_modal">Edit</button>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <label for="pin">Pin:</label>
        <div class="form-inline">
          <div class="input-group mb-3 youplay-input">
            <input type="password" placeholder="Pin" value="{{$data['user']->Pin}}" disabled>
          </div>
          <button class="btn btn-sm m_auto open_edit_details_modal" data-toggle="modal" data-id="Pin~{{$data['user']->Pin}}" data-target="#get_edit_details_modal">Edit</button>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <label for="status">Status:</label>
        <div class="input-group mb-3 youplay-input">
          {{-- <input type="text" placeholder="Status" value="{{$data['data']->statusToText($data['user']->Status)}}" disabled> --}}
          <input type="text" placeholder="Status" value="Admin" disabled>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <label for="points">Points:</label>
        <div class="input-group mb-3 youplay-input">
          <input type="text" placeholder="Points" value="{{$data['user']->Point}}" disabled>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <label for="ms">Member since:</label>
        <div class="input-group mb-3 youplay-input">
          <input type="text" placeholder="Member since" value="{{$data['data']->convertTimeToDate('F d, Y', $data['user']->JoinDate)}}" disabled>
        </div>
      </div>
    </div>
  </form>
@endguest
