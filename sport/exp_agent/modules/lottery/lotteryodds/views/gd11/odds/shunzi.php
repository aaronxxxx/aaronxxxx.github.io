<div class="game-box quick-order" style="display: block;">
    <div id="locate-box">
        <table class="order-table" tabs-view="1">
            <caption>前三球</caption>
			<tr>
                <td class="choose">
                    <font class="choose-name">顺子</font>
                    <input type="text" name="ball_1_h1" value="<?=$rows[0]['h1']?>" id="1-h1">
                </td>
                <td class="choose">
                    <font class="choose-name">半顺</font>
                    <input type="text" name="ball_1_h2" value="<?=$rows[0]['h2']?>" id="1-h2">
                </td>
                <td class="choose">
                    <font class="choose-name">杂六</font>
                    <input type="text" name="ball_1_h3" value="<?=$rows[0]['h3']?>" id="1-h3">
                </td>
            </tr>
        </table>
        <table class="order-table" tabs-view="2">
            <caption>中三球</caption>
            <tr>
                <td class="choose">
                    <font class="choose-name">顺子</font>
                    <input type="text" name="ball_2_h1" value="<?=$rows[1]['h1']?>" id="2-h1">
                </td>
                <td class="choose">
                    <font class="choose-name">半顺</font>
                    <input type="text" name="ball_2_h2" value="<?=$rows[1]['h2']?>" id="2-h2">
                </td>
                <td class="choose">
                    <font class="choose-name">杂六</font>
                    <input type="text" name="ball_2_h3" value="<?=$rows[1]['h3']?>" id="2-h3">
                </td>
            </tr>
        </table>

        <table class="order-table" tabs-view="3">
            <caption>后三球</caption>
            <tbody><tr>
                <td class="choose">
                    <font class="choose-name">顺子</font>
                    <input type="text" name="ball_3_h1" value="<?=$rows[2]['h1']?>" id="3-h1">
                </td>
                <td class="choose">
                    <font class="choose-name">半顺</font>
                    <input type="text" name="ball_3_h2" value="<?=$rows[2]['h2']?>" id="3-h2">
                </td>
                <td class="choose">
                    <font class="choose-name">杂六</font>
                    <input type="text" name="ball_3_h3" value="<?=$rows[2]['h3']?>" id="3-h3">
                </td>
            </tr>
            </tbody></table>

    </div>
</div>