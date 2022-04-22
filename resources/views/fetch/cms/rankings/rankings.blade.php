<div id="rankingsData"></div>
    @if(count($data) > 0)
      <div class="table-responsive">
        <table class="table table-sm table-dark text-center">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              {{-- <th>Faction</th> --}}
              {{-- <th>Class</th> --}}
              {{-- <th>Level</th> --}}
              <th>Guild</th>
              <th>Kills</th>
              {{-- <th>Deaths</th> --}}
              {{-- <th>Rank</th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach($data['users'] as $user)
              @php
                $data['rankNum']++;
                //$getRank = $data['rank']->get_Rank($rankings->K1);
                $chars = $data['rank']->getChars($user->UserUID);
              @endphp
              <tr style="display: table-row;">
                @if (count($data['rank']->getChars($user->UserUID)) > 0)
                  {{-- UserUID: {{$data['rank']->getChars($user->UserUID)[0]->UserUID}} CharName: {{$data['rank']->getChars($user->UserUID)[0]->CharName}} --}}
                  <td>{{$data['rankNum']}}</td>
                  <td>{{$data['rank']->getChars($user->UserUID)[0]->CharName}}<div class="arrow" data-toggle="collapse" data-target="#_{{$user->UserUID}}"></div></td>
                  <td>{{$data['guild']->getGuildNameByCharName($data['rank']->getChars($user->UserUID)[0]->CharName)}}</td>
                  <td>{{$data['rank']->getChars($user->UserUID)[0]->K1}}</td>
                @endif
              </tr>
                @for($x = 0; $x < count($data['rank']->getChars($user->UserUID)); $x++)
                  <tr id="_{{$user->UserUID}}" class="panel-collapse collapse">
                    <td></td>
                    <td>{{$data['rank']->getChars($user->UserUID)[$x]->CharName}}</td>
                    <td>1</td>
                    <td>1</td>
                  </tr>
                @endfor
                  {{-- <td>
                    <div id="_{{$user->UserUID}}" class="panel-collapse collapse">
                      @for($x = 0; $x < count($data['rank']->getChars($user->UserUID)); $x++)
                        {{$data['rank']->getChars($user->UserUID)[$x]->CharName}}
                      @endfor
                    </div>
                  </td> --}}
              {{-- <tr>
                <td>{{$data['rankNum']}}</td>
                <td>{{$rankings->CharName}}<div class="arrow" data-toggle="collapse" data-target="#{{$rankings->UserUID}}"></div></td>
                <td></td>
                <td class="IconHolder" width="10"></td>
                <td>{{$rankings->Level}}</td>
                <td>{{$data['guild']->getGuildNameByCharName($rankings->CharName)}}</td>
                <td>{{$rankings->K1}}</td>
                <td>{{$rankings->K2}}</td>
                <td>
                  <span class="RankIcon Rank{{$getRank}}" title="Rank{{$getRank}}"></span>
                </td>
                <tr>
                  <td></td>
                  <td>
                  <div id="{{$rankings->UserUID}}" class="panel-collapse collapse">
                    id: {{$rankings->UserUID}}
                    <div style="padding: 20px;">Caps 1</div>
                    <div style="padding: 20px;">Caps 2</div>
                    <div style="padding: 20px;">Caps 3</div>
                  </div>
                  </td>
                </tr>

              </tr> --}}
            @endforeach
          </tbody>
        </table>
      </div>
    @else
        <p>No Rankings found. Please check back later.</p>
    @endif
