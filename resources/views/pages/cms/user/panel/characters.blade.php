<div class="table-responsive">
  <table class="table table-dark table-striped text-center">
    <thead>
      <tr>
        <th></th>
        <th>Character 1</th>
        <th>Character 2</th>
        <th>Character 3</th>
        <th>Character 4</th>
        <th>Character 5</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>Character Name</th>
        @if ($data['panel']->getCharacterCount() > 0)
          @foreach ($data['panel']->getData() as $res)
            <td>{{$res->CharName}}</td>
          @endforeach
          @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
            <td>Character is empty</td>
          @endfor
        @else
          @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
            <td>Character is empty</td>
          @endfor
        @endif
      </tr>
        <tr>
          <th>Level</th>
          @if ($data['panel']->getCharacterCount() > 0)
            @foreach ($data['panel']->getData() as $res)
              <td>{{$res->Level}}</td>
            @endforeach
            @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
              <td>Character is empty</td>
            @endfor
          @else
            @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
              <td>Character is empty</td>
            @endfor
          @endif
        </tr>
        <tr>
          <th>Mode</th>
          @if ($data['panel']->getCharacterCount() > 0)
            @foreach ($data['panel']->getData() as $res)
              <td>{{$res->Grow}}</td>
            @endforeach
            @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
              <td>Character is empty</td>
            @endfor
          @else
            @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
              <td>Character is empty</td>
            @endfor
          @endif
        </tr>
        <tr>
          <th>Class</th>
          @if ($data['panel']->getCharacterCount() > 0)
            @foreach ($data['panel']->getData() as $res)
              <td>{{$data['user']->getClass($data['user']->getUserFaction($data['user']->UserUID), $res->Job)}}</td>
            @endforeach
            @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
              <td>Character is empty</td>
            @endfor
          @else
            @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
              <td>Character is empty</td>
            @endfor
          @endif
        </tr>
        <tr>
          <th>Map</th>
          @if ($data['panel']->getCharacterCount() > 0)
            @foreach ($data['panel']->getData() as $res)
              <td>{{$data['user']->getMap($res->Map)}}</td>
            @endforeach
            @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
              <td>Character is empty</td>
            @endfor
          @else
            @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
              <td>Character is empty</td>
            @endfor
          @endif
        </tr>
        <tr>
          <th>Kills</th>
          @if ($data['panel']->getCharacterCount() > 0)
            @foreach ($data['panel']->getData() as $res)
              <td>{{$res->K1}}</td>
            @endforeach
            @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
              <td>Character is empty</td>
            @endfor
          @else
            @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
              <td>Character is empty</td>
            @endfor
          @endif
        </tr>
        <tr>
          <th>Deaths</th>
          @if ($data['panel']->getCharacterCount() > 0)
            @foreach ($data['panel']->getData() as $res)
              <td>{{$res->K2}}</td>
            @endforeach
            @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
              <td>Character is empty</td>
            @endfor
          @else
            @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
              <td>Character is empty</td>
            @endfor
          @endif
        </tr>
        <tr>
          <th>Login Status</th>
          @if ($data['panel']->getCharacterCount() > 0)
            @foreach ($data['panel']->getData() as $res)
              <td>{{$data['user']->getLoginStatus($res->LoginStatus)}}</td>
            @endforeach
            @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
              <td>Character is empty</td>
            @endfor
          @else
            @for ($i = $data['panel']->getCharacterCount(); $i < 5; $i++)
              <td>Character is empty</td>
            @endfor
          @endif
      </tr>
    </tbody>
  </table>
</div>
