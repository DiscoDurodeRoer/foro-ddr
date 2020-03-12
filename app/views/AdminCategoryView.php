<?php
require_once 'AdminView.php'
?>

<div class="col-md-9">

    <?php
    if (isset($data['display_create'])) {
    ?>

        <div class="row">
            <div class="col-12">
                <h1>Crear categoria</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <form action="index.php?url=AdminCategoryController/create_category" method="POST">

                    <!-- Nombre categoria -->
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" />
                        </div>
                    </div>

                    <!-- Descripción categoria -->
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="description">Descripción</label>
                            <textarea name="description" class="form-control" id="description"></textarea>
                        </div>
                    </div>

                    <!-- Nombre categoria -->
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="parent">Categoria padre</label>
                            <select class="form-control" name="parent" id="parent">
                                <?php
                                foreach ($data['categories'] as $key => $value) {
                                    echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Icono categoria -->
                    <!-- <div class="row form-group">
                        <div class="col-12">
                        
                        </div>
                    </div> -->

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Añadir</button>
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
                <h1>Categorias</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <a class="btn btn-primary btn-icon" href="index.php?url=AdminCategoryController/display_create">
                    <i class="fa fa-plus" aria-hidden="true"></i>Crear Categoria
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table">

                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Padre</th>
                        <th>Icono</th>
                        <th>Topics</th>
                    </tr>
                    <?php

                    foreach ($data['categories'] as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['name']; ?></td>
                            <td><?php echo $value['description']; ?></td>
                            <td><?php echo $value['parent']; ?></td>
                            <td><?php echo $value['icon']; ?></td>
                            <td><?php echo $value['num_topics']; ?></td>
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