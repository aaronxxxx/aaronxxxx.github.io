<div class="game-box quick-order" style="display: block;">
    <div id="locate-box">
        <table class="order-table" tabs-view="1">
            <caption>正码一特</caption>
            <tbody>
            <?php
            $ball = 1;
            for($j=0;$j<5;$j++){
                echo '<tr>';
                for($i=1;$i<5;$i++){
                    echo '<td class="choose">';
                    echo '<span class="num ball ball-red">'.$ball.'</span>';
                    echo '<input type="text" name="ball_1_h'.$ball.'" value="'.$rows[0]['h'.$ball].'">';
                    echo '</td>';
                    $ball++;
                }
                echo '</tr>';
            }
            ?>
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
        <table class="order-table" tabs-view="2">
            <caption>正码二特</caption>
            <tbody>
            <?php
            $ball = 1;
            for($j=0;$j<5;$j++){
                echo '<tr>';
                for($i=1;$i<5;$i++){
                    echo '<td class="choose">';
                    echo '<span class="num ball ball-bull">'.$ball.'</span>';
                    echo '<input type="text" name="ball_2_h'.$ball.'" value="'.$rows[1]['h'.$ball].'">';
                    echo '</td>';
                    $ball++;
                }
                echo '</tr>';
            }
            ?>
            <tr>
                <td class="choose">
                    <span class="num ball ball-red">21</span>
                    <input type="text" name="ball_2_h21" value="<?=$rows[1]['h21']?>">
                </td>
            </tr>
            <tr>
                <td class="choose">
                    <font class="choose-name">特大</font>
                    <input type="text" name="ball_2_h22" value="<?=$rows[1]['h22']?>">  </td>
                <td class="choose">
                    <font class="choose-name">特小</font>
                    <input type="text" name="ball_2_h23" value="<?=$rows[1]['h23']?>">  </td>
                <td class="choose">
                    <font class="choose-name">特单</font>
                    <input type="text" name="ball_2_h24" value="<?=$rows[1]['h24']?>">  </td>
                <td class="choose">
                    <font class="choose-name">特双</font>
                    <input type="text" name="ball_2_h25" value="<?=$rows[1]['h25']?>">  </td>
            </tr>
            </tbody></table>
        <table class="order-table" tabs-view="3">
            <caption>正码三特</caption>
            <tbody>
            <?php
            $ball = 1;
            for($j=0;$j<5;$j++){
                echo '<tr>';
                for($i=1;$i<5;$i++){
                    echo '<td class="choose">';
                    echo '<span class="num ball ball-red">'.$ball.'</span>';
                    echo '<input type="text" name="ball_3_h'.$ball.'" value="'.$rows[2]['h'.$ball].'">';
                    echo '</td>';
                    $ball++;
                }
                echo '</tr>';
            }
            ?>
            <tr>
                <td class="choose">
                    <span class="num ball ball-red">21</span>
                    <input type="text" name="ball_3_h21" value="<?=$rows[2]['h21']?>">
                </td>
            </tr>
            <tr>
                <td class="choose">
                    <font class="choose-name">特大</font>
                    <input type="text" name="ball_3_h22" value="<?=$rows[2]['h22']?>">  </td>
                <td class="choose">
                    <font class="choose-name">特小</font>
                    <input type="text" name="ball_3_h23" value="<?=$rows[2]['h23']?>">  </td>
                <td class="choose">
                    <font class="choose-name">特单</font>
                    <input type="text" name="ball_3_h24" value="<?=$rows[2]['h24']?>">  </td>
                <td class="choose">
                    <font class="choose-name">特双</font>
                    <input type="text" name="ball_3_h25" value="<?=$rows[2]['h25']?>">  </td>
            </tr>
            </tbody></table>
        <table class="order-table" tabs-view="4">
            <caption>正码四特</caption>
            <tbody>
            <?php
            $ball = 1;
            for($j=0;$j<5;$j++){
                echo '<tr>';
                for($i=1;$i<5;$i++){
                    echo '<td class="choose">';
                    echo '<span class="num ball ball-bull">'.$ball.'</span>';
                    echo '<input type="text" name="ball_4_h'.$ball.'" value="'.$rows[3]['h'.$ball].'">';
                    echo '</td>';
                    $ball++;
                }
                echo '</tr>';
            }
            ?>
            <tr>
                <td class="choose">
                    <span class="num ball ball-red">21</span>
                    <input type="text" name="ball_4_h21" value="<?=$rows[3]['h21']?>">
                </td>
            </tr>
            <tr>
                <td class="choose">
                    <font class="choose-name">特大</font>
                    <input type="text" name="ball_4_h22" value="<?=$rows[3]['h22']?>">  </td>
                <td class="choose">
                    <font class="choose-name">特小</font>
                    <input type="text" name="ball_4_h23" value="<?=$rows[3]['h23']?>">  </td>
                <td class="choose">
                    <font class="choose-name">特单</font>
                    <input type="text" name="ball_4_h24" value="<?=$rows[3]['h24']?>">  </td>
                <td class="choose">
                    <font class="choose-name">特双</font>
                    <input type="text" name="ball_4_h25" value="<?=$rows[3]['h25']?>">  </td>
            </tr>
            </tbody></table>
    </div>
</div>