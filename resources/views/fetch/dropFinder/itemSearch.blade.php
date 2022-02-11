@if (!empty($data['drops']->getItemName()))
  @if (count($data['drops']->getItemsByQuery()) > 0)
    <div class="table-responsive">
      <table class="table table-dark text-white text-center">
        <thead>
          <tr>
            <th>Item Name</th>
            <th colspan="2">Mobs</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data['drops']->getItemsByQuery() as $fet)
            <tr>
              @if ($data['drops']->isCountDisplayed() == false)
                <td rowspan="{{$data['drops']->countItemQuery()}}">{{$fet->ItemName}}</td>
              @endif
              @if ($data['drops']->isCountDisplayed() == true)
                <td>{{$fet->MobName}} - {{$fet->DropRate}}%</td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @else
    There are no items found matching your query.
  @endif
@else
  Item name can not be empty
@endif
