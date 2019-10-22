<?php

include_once 'header.php';

?>
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
                foreach ($datos as $key => $value) {
                    echo "<tr>";
                    echo "<td>".$value['name']."</td>";
                    echo "<td>".$value['views']."</td>";
                    echo "<td>".$value['creator_user']."</td>";
                    echo "</tr>";
                }
                
                ?>

            </tbody>
        </table>



    </div>
</div>




<?php





print_r($datos);

include_once 'footer.php';


?>