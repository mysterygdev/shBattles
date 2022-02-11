<?php
	$LoginConn = @fsockopen(SERVER['ip'], SERVER['ports'][0], $errno, $errstr, 0.01);
  $GameConn = @fsockopen(SERVER['ip'], SERVER['ports'][1], $errno, $errstr, 0.01);
  //var_dump($data);
?>
<p class="lead">Login Server:
  @if ($LoginConn)
    <span style="color:lime" class="b">Online</span>
  @else
    <span style="color:red" class="b">Offline</span></p>
  @endif
  @php @fclose($LoginConn); @endphp
  <p class="lead">Game Server:
  @if ($GameConn)
    <span style="color:lime">Online</span>
  @else
    <span style="color:red"">Offline</span></p>
  @endif
  @php @fclose($GameConn); @endphp
@Separator(20)
