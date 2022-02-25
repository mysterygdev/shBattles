<div class="col-lg-3 mb-20 align-center">
  <h2>Players Online</h2>
  {{$data['info']->playersOnline()}}
  <p class="text-center lead">{{$data['info']->pOnline}}</p>
  <p class="text-center lead">{{$data['info']->AoL}} AOL & {{$data['info']->UoF}} UOF</p>
</div>
<div class="col-lg-3 mb-20 align-center">
  <h2>Server Time</h2>
  <p id="server-date" class="text-center lead">{{date("d / m / Y", time())}}</p>
  <p id="server-time" class="text-center lead">{{date("H:i:s", time())}}</p>
</div>
<div class="col-lg-3 mb-20 align-center">
  <h2>GRB Timer</h2>
  @if(date("j", strtotime('next sunday', time()) - time()) > 1)
    <p id="grb-days" class="text-center lead">{{date("j", strtotime('next sunday', time()) - time())}} days</p>
  @else
    <p id="grb-days" class="text-center lead">{{date("j", strtotime('next sunday', time()) - time())}} day</p>
  @endif
  <p id="grb-time" class="text-center lead">{{date("H:i:s", strtotime('next sunday 18:00:00', time()) - time())}}</p>
</div>
<div class="col-lg-3 mb-20 align-center">
  <h2>Server Status</h2>
  {{$data['info']->serverStatus()}}
</div>
