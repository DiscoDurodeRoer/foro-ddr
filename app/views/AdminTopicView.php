<?php
require_once 'AdminView.php'
?>

<div class="col-md-9">

    <div class="row">
        <div class="col-12">
            <h1>Topics</h1>
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

                <form action="index.php?url=AdminTopicController/edit_topic/" method="POST">

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
                            <button type="submit" name="back" class="btn btn-primary btn-block">Volver</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>


    <?php
    } else {
    ?>

        <div class="row">
            <div class="col-12">
                <table class="table">

                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Fecha creación</th>
                        <th>Vistas</th>
                        <th>Categoria</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <?php

                    foreach ($data['topics'] as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['title']; ?></td>
                            <td><?php echo $value['date_creation']; ?></td>
                            <td><?php echo $value['views']; ?></td>
                            <td><?php echo $value['category']; ?></td>
                            <td><?php
                                if ($value['open'] == TRUE) {
                                ?>
                                    <a class="btn btn-success btn-icon" href="index.php?url=AdminTopicController/close_topic/<?php echo $value['id']; ?>">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a class="btn btn-danger btn-icon" href="index.php?url=AdminTopicController/open_topic/<?php echo $value['id']; ?>">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                <?php
                                }
                                ?></td>
                            <td>
                                <a class="btn btn-primary btn-icon" href="index.php?url=AdminTopicController/display_edit/<?php echo $value['id']; ?>">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    <?php
    }

    ?>

</div>

<?php
require_once 'AdminFooter.php';
?>