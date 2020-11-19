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

                <?php

                if (isset($data['display'])) {
                ?>

                    <div class="row">
                        <div class="col-md-9 col-12 mt-2">
                            <h1><?php echo $data['name_category']  ?></h1>
                        </div>
                        <?php
                        if ($data['login']) {
                        ?>
                            <div class="col-md-3 col-12">
                                <a class="btn btn-primary btn-block btn-icon" href="/foro-ddr/crear-topic-form/<?php echo $data['id_cat']; ?>">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Crear topic
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-12 mt-2">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Topic</th>
                                        <!-- <th scope="col">Vistas</th> -->
                                        <th scope="col">Usuario creador</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if (isset($data['topics'])) {
                                        foreach ($data['topics'] as $key => $value) {
                                            echo "<tr>";
                                    ?>
                                            <td>
                                                <a href="/foro-ddr/reply/<?php echo $value['path'] ?>">
                                                    <?php echo  $value['title']; ?>
                                                </a>
                                            </td>
                                    <?php
                                            // echo "<td>" . $value['views'] . "</td>";
                                            echo "<td>" . $value['nickname'] . "</td>";
                                            if($value['open'] == FALSE){
                                                echo "<td><i class='fa fa-lock'></i></td>";
                                            }else{
                                                echo "<td></td>";
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
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
                } else if (isset($data['create'])) {
                ?>
                    <div class="row">
                        <div class="col-12">

                            <form action="/foro-ddr/crear-topic" method="POST" novalidate>

                                <input type="hidden" name="id_cat" value="<?php echo $data['id_cat'] ?>" />

                                <div class="row form-group">
                                    <div class="col-12">
                                        <label for="title">Titulo topic</label>
                                        <input type="text" class="form-control" name="title" required id="title" />
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-12">
                                        <label for="editor">Texto</label>
                                        <textarea name="text" required class="form-control" id="editor" cols="30" rows="10"></textarea>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-6">
                                        <button class="btn btn-primary btn-block" name="action" type="submit">Crear</button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-primary btn-block" name="back" type="button">Volver</button>
                                    </div>
                                </div>

                            </form>


                        </div>
                    </div>



                <?php
                }
                ?>
            </div>
        </div>



    </div>
</div>




<?php

include_once 'footer.php';


?>