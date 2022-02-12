<?php
    use Illuminate\Database\Capsule\Manager as DB;

    $sql = ('
                SELECT COUNT(*) AS \'Players\',
                (SELECT COUNT(*) FROM PS_GameData.dbo.Chars WHERE LoginStatus=? AND Family IN (0,1)) AS \'AoL\',
                (SELECT COUNT(*) FROM PS_GameData.dbo.Chars WHERE LoginStatus=? AND Family IN (2,3)) AS \'UoF\'
                FROM PS_GameData.dbo.Chars WHERE LoginStatus=?
    ');

    $res = DB::select(DB::raw($sql), [1, 1, 1]);
    foreach ($res as $fet) {
        $pOnline = $fet->Players;
        $AoL = $fet->AoL;
        $UoF = $fet->UoF;
    }

    if ($pOnline > 0) {
        $aolPercent = number_format( $AoL/$pOnline * 100, 2 );
        $aolPercent = substr($aolPercent,0,-3);
        $uofPercent = number_format( $UoF/$pOnline * 100, 2 );
        $uofPercent = substr($uofPercent,0,-3);
    } else {
        $aolPercent = 0;
        $uofPercent = 0;
    }
?>
<div>
    <p>Players Online: <span><?php echo e($pOnline); ?></span></p>
    

    <div class="progress-bar-container">
        <?php if($aolPercent == '0'): ?>
            <p class="factionPercent">AoL:</p><div class="progress-bar-panel progress-blue" style="width:20%">
                <span class="percent"><?php echo e($aolPercent); ?>%</span>
            </div>
            <br>
            <p class="factionPercent">UoF:</p><div class="progress-bar-panel progress-red" style="width:20%">
                <span class="percent"><?php echo e($uofPercent); ?>%</span>
            </div>
        <?php else: ?>
            <p class="factionPercent">AoL:</p><div class="progress-bar-panel progress-blue" style="width:<?php echo e($aolPercent); ?>%">
                <span class="percent"><?php echo e($aolPercent); ?>%</span>
            </div>
            <br>
            <p class="factionPercent">UoF:</p><div class="progress-bar-panel progress-red" style="width:<?php echo e($uofPercent); ?>%">
                <span class="percent"><?php echo e($uofPercent); ?>%</span>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php separator(20) ?>
<?php /**PATH C:\laragon\www\shaiyabattles\app\widgets\playerCount\php/script.blade.php ENDPATH**/ ?>