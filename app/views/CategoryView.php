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

                        <h5><?php echo $data['category']['description']; ?></h5>
                    </div>
                    <?php
                    if ($data['login'] && count($data['category']['child']) === 0) {
                    ?>
                        <div class="col-3">
                            <a class="btn btn-primary btn-block btn-icon" href="<?php echo BASE_URL; ?>crear-topic-form/<?php echo $data['category']['id']; ?>">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> <span class="d-none d-sm-inline-block">Crear topic</span>
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
                        <div class="col-12 table-responsive margin-from-footer">
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
                                                <a href="<?php echo BASE_URL; ?>categoria/<?php echo $child['path'] ?>">
                                                <?php echo $child['name'] ?>
                                                </a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="<?php echo BASE_URL; ?>topic/<?php echo $child['path'] ?>">
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