<?php

include_once 'header.php';

?>
<div class="row">
    <div class="col-12">

        <div class="row">
            <div class="col-12">
                <h1><?php echo $datos['name_category']  ?></h1>
            </div>
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

                        if (isset($datos['topics'])) {
                            foreach ($datos['topics'] as $key => $value) {
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





    </div>
</div>




<?php

include_once 'footer.php';


?>