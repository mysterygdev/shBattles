<div class="table-responsive">
  <table class="table table-sm table-dark">
    <thead>
      <tr>
        @if ($data['panel']->getDeadCharacterCount() > 0)
          @php
            $count = 1;
          @endphp
          <th></th>
          @foreach ($data['panel']->getDeadCharacters() as $res)
            <th>Dead Character {{$count}}</th>
            @php
              $count++;
            @endphp
          @endforeach
        @else
          You don't have any dead characters.
        @endif
      </tr>
    </thead>
    <tbody>
      @if ($data['panel']->getDeadCharacterCount() > 0)
        <tr>
          <th>Character Name</th>
          @foreach ($data['panel']->getDeadCharacters() as $res)
            <td>{{$res->CharName}}</td>
          @endforeach
        </tr>
        <tr>
          <th>Slot</th>
          @foreach ($data['panel']->getDeadCharacters() as $res)
            <td>{{$res->Slot}}</td>
          @endforeach
        </tr>
        <tr>
          <th>Level</th>
          @foreach ($data['panel']->getDeadCharacters() as $res)
            <td>{{$res->Level}}</td>
          @endforeach
        </tr>
        <tr>
          <th>Mode</th>
          @foreach ($data['panel']->getDeadCharacters() as $res)
            <td>{{$res->Grow}}</td>
          @endforeach
        </tr>
        <tr>
          <th>Class</th>
          @foreach ($data['panel']->getDeadCharacters() as $res)
            <td>{{$data['user']->getClass($data['user']->getUserFaction($data['user']->UserUID), $res->Job)}}</td>
          @endforeach
        </tr>
        <tr>
          <th>Map</th>
          @foreach ($data['panel']->getDeadCharacters() as $res)
            <td>{{$data['user']->getMap($res->Map)}}</td>
          @endforeach
        </tr>
        <tr>
          <th>Kills</th>
          @foreach ($data['panel']->getDeadCharacters() as $res)
            <td>{{$res->K1}}</td>
          @endforeach
        </tr>
        <tr>
          <th>Deaths</th>
          @foreach ($data['panel']->getDeadCharacters() as $res)
            <td>{{$res->K2}}</td>
          @endforeach
        </tr>
        <tr>
          {{display('get_res_modal','','0','2','Resurrect Character')}}
          <th></th>
          @foreach ($data['panel']->getDeadCharacters() as $res)
            <td><button class="btn gradient color-white color-white" id="res_btn" data-toggle="modal" data-id="{{$res->CharID}}~{{$res->CharName}}" data-target="#get_res_modal">Resurrect</button></td>
          @endforeach
        </tr>
      @endif
    </tbody>
  </table>
</div>
