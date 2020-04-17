<?php


include_once 'header.php';

?>

<div class="row">
    <div class="col-12">

        <div class="row">
            <div class="col-12">
                <?php include 'breadcumb.php'; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="row">
                    <div class="col-12 mt-2">
                        <h1><?php echo $data['category']['name']; ?></h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-9">

                        <h2><?php echo $data['category']['description']; ?></h2>
                    </div>
                    <?php
                    if ($data['login'] && count($data['category']['child']) === 0) {
                    ?>
                        <div class="col-3">
                            <a class="btn btn-primary btn-block btn-icon" href="index.php?url=TopicController/display_create_topic/<?php echo $data['category']['id']; ?>">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Crear topic
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <?php
                if (count($data['category']['child']) === 0) {
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

                                    foreach ($data['category']['child'] as $key_child => $child) {

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

            </div>
        </div>

    </div>
</div>



<?php

include_once 'footer.php';

?>