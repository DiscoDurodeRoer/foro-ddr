<?php
if (isset($data['breadcumbs'])) {
?>
    <ul class="breadcumbs mb-3">
        <?php
        foreach ($data['breadcumbs'] as $key => $value) {
            if ($value->enabled) {
                echo '<li><a href="' . $value->url . '">' . $value->display . '</a></li>';
            } else {
                echo '<li>' . $value->display . '</li>';
            }
            
            if($key != count($data['breadcumbs'])-1){
                echo '<span>/</span>';
            }
            
        }
        ?>
    </ul>
<?php
}
?>