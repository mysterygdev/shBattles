@if (count($data['model']->getTopVoters()) > 0)
  <table class="table table-dark table-striped text-center">
    <thead style="border: hidden !important;">
      <tr style="border: hidden !important;">
        <th>CharName</th>
        <th>Vote Count</th>
        <th>Last Vote</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data['model']->getTopVoters() as $fet)
        <tr style="border:hidden !important;">
          {{-- <td>{{$script->charName}}</td>
          <td>{{$script->count}}</td> --}}
          <td>{{$data['model']->user->getCharNameFromUser($fet->UserUID)}}</td>
          <td>{{$data['model']->getUserVoteCount($fet->UserUID)}}</td>
          <td>{{$fet->LastVote}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  There are currently no top voters found.
@endif
@Separator(20)
