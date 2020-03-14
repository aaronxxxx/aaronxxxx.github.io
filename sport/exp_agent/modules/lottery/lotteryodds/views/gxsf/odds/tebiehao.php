<div class="game-box quick-order" style="display: block;">
    <table class="order-table">
        <caption>特别号</caption>
        <tbody>
        <tr>
            <?php
            for($i=1;$i<5;$i++){
                echo '<td class="choose">';
                echo '<span class="num ball ball-red">'.$i.'</span>';
                echo '<input type="text" name="ball_1_h'.$i.'" value="'.$rows[0]['h'.$i].'">';
                echo '</td>';
            }
            ?>
        </tr>
        <tr>
            <?php
            for($i=5;$i<9;$i++){
                echo '<td class="choose">';
                echo '<span class="num ball ball-red">'.$i.'</span>';
                echo '<input type="text" name="ball_1_h'.$i.'" value="'.$rows[0]['h'.$i].'">';
                echo '</td>';
            }
            ?>
        </tr>
        <tr>
            <?php
            for($i=9;$i<13;$i++){
                echo '<td class="choose">';
                echo '<span class="num ball ball-red">'.$i.'</span>';
                echo '<input type="text" name="ball_1_h'.$i.'" value="'.$rows[0]['h'.$i].'">';
                echo '</td>';
            }
            ?>
        </tr>
        <tr>
            <?php
            for($i=13;$i<17;$i++){
                echo '<td class="choose">';
                echo '<span class="num ball ball-red">'.$i.'</span>';
                echo '<input type="text" name="ball_1_h'.$i.'" value="'.$rows[0]['h'.$i].'">';
                echo '</td>';
            }
            ?>
        </tr>
        <tr>
            <?php
            for($i=17;$i<21;$i++){
                echo '<td class="choose">';
                echo '<span class="num ball ball-red">'.$i.'</span>';
                echo '<input type="text" name="ball_1_h'.$i.'" value="'.$rows[0]['h'.$i].'">';
                echo '</td>';
            }
            ?>
        </tr>
        <tr>
            <td class="choose">
                <span class="num ball ball-red">21</span>
                <input type="text" name="ball_1_h21" value="<?=$rows[0]['h21']?>">
            </td>
        </tr>
        <tr>
            <td class="choose">
                <font class="choose-name">特大</font>
                <input type="text" name="ball_1_h22" value="<?=$rows[0]['h22']?>">  </td>
            <td class="choose">
                <font class="choose-name">特小</font>
                <input type="text" name="ball_1_h23" value="<?=$rows[0]['h23']?>">  </td>
            <td class="choose">
                <font class="choose-name">特单</font>
                <input type="text" name="ball_1_h24" value="<?=$rows[0]['h24']?>">  </td>
            <td class="choose">
                <font class="choose-name">特双</font>
                <input type="text" name="ball_1_h25" value="<?=$rows[0]['h25']?>">  </td>
        </tr>
        </tbody>
    </table>
</div>