<?php

include_once 'header.php';

?>
<div class="row">
    <div class="col-12">


        <?php

        if (isset($data['display'])) {
            ?>

            <div class="row">
                <div class="col-9">
                    <h1><?php echo $data['name_category']  ?></h1>
                </div>
                <?php
                    if ($data['login']) {
                        ?>
                    <div class="col-3">
                        <a class="btn btn-primary btn-block btn-icon" href="index.php?url=TopicController/display_create_topic/<?php echo $data['id_cat']; ?>">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Crear topic
                        </a>
                    </div>
                <?php
                    }
                    ?>
            </div>




            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Topic</th>
                                <th scope="col">Vistas</th>
                                <!-- <th scope="col">Mensajes</th> -->
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
                                        <a href="index.php?url=MessageController/display/<?php echo $value['id'] ?>">
                                            <?php echo  $value['title']; ?>
                                        </a>
                                    </td>
                            <?php
                                        echo "<td>" . $value['views'] . "</td>";
                                        echo "<td>" . $value['nickname'] . "</td>";
                                        echo "</tr>";
                                    }
                                }



                                ?>

                        </tbody>
                    </table>
                </div>
            </div>

        <?php
        } else if (isset($data['create'])) {
            ?>
            <div class="row">
                <div class="col-12">

                    <form action="index.php?url=TopicController/create_topic/" method="POST">

                        <input type="hidden" name="id_cat" value="<?php echo $data['id_cat'] ?>" />

                        <div class="row form-group">
                            <div class="col-12">
                                <label for="title">Titulo topic</label>
                                <input type="text" class="form-control" name="title" required id="title" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12">
                                <label for="texto">Texto</label>
                                <textarea name="text" required class="form-control"  id="texto" cols="30" rows="10"></textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12">
                                <button class="btn btn-primary btn-block" type="submit">Crear</button>
                            </div>
                        </div>

                    </form>


                </div>
            </div>



        <?php
        }else if(isset($data['success'])){

            include_once "show-info-message.php";

        }

        ?>

    </div>
</div>




<?php

include_once 'footer.php';


?>