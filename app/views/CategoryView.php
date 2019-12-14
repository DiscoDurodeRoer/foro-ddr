<?php


include_once 'header.php';

?>



<div class="row">
    <div class="col-12">

        <?php
        foreach ($data['categories'] as $key => $value) {

            ?>

            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <h1><?php echo $value['name']; ?></h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-9">

                            <h2><?php echo $value['description']; ?></h2>
                        </div>
                        <?php
                            if ($data['login'] && count($value['child']) === 0) {
                                ?>
                            <div class="col-3">
                                <a class="btn btn-primary btn-block btn-icon" href="index.php?url=TopicController/display_create_topic/<?php echo $value['id']; ?>">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Crear topic
                                </a>
                            </div>
                        <?php
                            }
                            ?>
                    </div>
                </div>

            </div>

            <?php
                if (count($value['child']) === 0) {
                    ?>
                <div class="row">
                    <div class="col-12">
                        <p>No hay topics ni categorias hijas.</p>
                    </div>
                </div>
            <?php
                } else {
                    ?>
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <tbody>

                                <?php

                                        foreach ($value['child'] as $key_child => $child) {

                                            echo "<tr>";
                                            ?>
                                    <td>
                                        <?php
                                                    if ($child['num_topics'] == 0) {
                                                        ?>
                                            <a href="index.php?url=CategoryController/display/<?php echo $child['id'] ?>">
                                                <?php echo $child['name'] ?>
                                            </a>
                                        <?php
                                                    } else {
                                                        ?>
                                            <a href="index.php?url=TopicController/display/<?php echo $child['id'] ?>">
                                                <?php echo $child['name'] ?>
                                            </a>
                                        <?php
                                                    }

                                                    ?>

                                    </td>
                            <?php
                                        echo "</tr>";
                                    }
                                }


                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php
            }

            ?>





    </div>
</div>



<?php

include_once 'footer.php';

?>