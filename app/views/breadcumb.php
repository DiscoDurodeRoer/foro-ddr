<?php
if (isset($data['breadcumbs'])) {
?>
    <ul>
        <?php
        foreach ($data['breadcumbs'] as $key => $value) {
            if ($value->enabled) {
                echo '<li><a href="' . $value->url . '">' . $value->display . '</a></li>';
            } else {
                echo '<li>' . $value->display . '</li>';
            }
        }
        ?>
    </ul>
<?php
}
?>