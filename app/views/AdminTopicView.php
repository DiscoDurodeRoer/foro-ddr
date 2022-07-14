<?php
require_once 'AdminView.php'
?>

<div class="col-md-10 col-12 p-4">

    <div class="row">
        <div class="col-12">
            <h1>Topics</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?php include_once 'show-info-message.php'; ?>
        </div>
    </div>

    <?php
    if (isset($data['display_edit'])) {
    ?>

        <div class="row">
            <div class="col-12">
                <h1>Editar topic</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <form action="<?php echo BASE_URL; ?>admin/topic/editar-topic" method="POST">

                    <input type="hidden" class="form-control" name="id" value="<?php echo $data['topic']['id']; ?>" />

                    <!-- Titulo topic -->
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="title">Titulo</label>
                            <input type="text" class="form-control" name="title" id="title" required maxlength="80" value="<?php echo isset($data['topic']) ? $data['topic']['title'] : ''; ?>" />
                        </div>
                    </div>

                    <!-- Nombre categoria -->
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="category">Categoria</label>
                            <select class="form-control" name="category" id="category">
                                <?php
                                foreach ($data['categories'] as $key => $value) {
                                    if ($data['topic']['id_cat'] === $value['id']) {
                                        echo "<option selected value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                                    } else {
                                        echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-6">
                            <button type="submit" name="action" class="btn btn-primary btn-block">Editar</button>
                        </div>
                        <div class="col-6">
                            <button type="button" name="back" class="btn btn-primary btn-block">Volver</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>


    <?php
    } else {
    ?>

        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table ">

                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Fecha creación</th>
                        <!-- <th>Vistas</th> -->
                        <th>Categoria</th>
                        <th>Estado</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php

                    foreach ($data['topics'] as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['title']; ?></td>
                            <td><?php echo $value['date_creation']; ?></td>
                            <!-- <td><?php echo $value['views']; ?></td> -->
                            <td><?php echo $value['category']; ?></td>
                            <td><?php
                                if ($value['open'] == TRUE) {
                                ?>
                                    <a class="btn btn-success btn-icon" href="<?php echo BASE_URL; ?>admin/topic/cerrar-topic/<?php echo $value['id']; ?>">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a class="btn btn-danger btn-icon" href="<?php echo BASE_URL; ?>admin/topic/abrir-topic/<?php echo $value['id']; ?>">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                <?php
                                }
                                ?></td>
                            <td>
                                <a class="btn btn-primary btn-icon" href="<?php echo BASE_URL; ?>admin/topic/editar-topic-form/<?php echo $value['id']; ?>">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-danger btn-icon" href="<?php echo BASE_URL; ?>admin/topic/eliminar-topic/<?php echo $value['id']; ?>">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?php
                    include_once "pagination-controls.php";
                ?>
            </div>
        </div>
        
    <?php
    }

    ?>

</div>

<?php
require_once 'AdminFooter.php';
?>