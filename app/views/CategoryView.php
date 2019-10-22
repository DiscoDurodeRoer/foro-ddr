<?php


include_once 'header.php';

?>

<div class="row">
    <div class="col-12">

        <?php
        foreach ($datos as $key => $value) {

            ?>
            <h1><?php echo $value['name']; ?></h1>
            <h2><?php echo $value['description']; ?></h2>

            <table class="table">
                <!-- <thead class="thead-light">
                    <tr>
                        <th scope="col">Topic</th>
                        <th scope="col">Vistas</th>
                       <th scope="col">Mensajes</th>
                    <th scope="col"></th>
                    </tr>
                </thead> -->
                <tbody>

                    <?php

                        foreach ($value['child'] as $key_child => $child) {

                            echo "<tr>";
                            ?>
                        <td>
                            <a href="index.php?url=CategoryController/display/<?php echo $child['id'] ?>">
                                <?php echo $child['name'] ?></a>
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

include_once 'footer.php';

?>