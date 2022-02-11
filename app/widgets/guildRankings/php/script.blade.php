<table class="table table-dark table-striped text-center">
  <thead style="border: hidden !important;">
    <tr style="border: hidden !important;">
      <th>Rank</th>
      <th>Guild Name</th>
      <th>Guild Leader</th>
      <th>Fact.</th>
    </tr>
  </thead>
  <tbody>
      @if (count($data['model']->getGuildRankings()) > 0)
        @foreach ($data['model']->getGuildRankings() as $fet)
          <tr>
            <td>{{$fet->Rank}}</td>
            <td>{{$fet->GuildName}}</td>
            <td>{{$fet->MasterName}}</td>
            @if ($fet->Country == 0)
              <td><img src="/resources/themes/core/images/icons/guildranking/aol.png" height="35" width="35"></td>
            @else
              <td><img src="/resources/themes/core/images/icons/guildranking/uof.png" height="35" width="35"></td>
            @endif
          </tr>
        @endforeach
      @else
        There are currently no guilds found.
      @endif
  </tbody>
</table>
@Separator(20)
