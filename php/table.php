<table id="coordinates-table" border="1" width="100%" cellpadding="5">
    <thead>
    <tr>
        <th style="text-align: center">X</th>
        <th>Y</th>
        <th>R</th>
        <th>RESULT</th>
        <th>TIME</th>
        <th>BENCHMARK</th>
    </tr>
    </thead>
    <?php foreach ($_SESSION['history'] as $value) { ?>
        <tr>
            <td><?php echo $value[0] ?></td>
            <td><?php echo $value[1] ?></td>
            <td><?php echo $value[2] ?></td>
            <td><?php echo $value[3] ?></td>
            <td><?php echo $value[4] ?></td>
            <td><?php echo number_format($value[5], 10, ".", "") * 1000000 ?> ms</td>
        </tr>
    <?php } ?>
</table>
