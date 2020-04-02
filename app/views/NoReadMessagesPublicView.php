<?php


include_once 'header.php';


?>



<div class="row">
    <div class="col-12">
        <h1>Mensajes no leidos</h1>
    </div>
</div>





<div class="row">
    <div class="col-12">

        <?php

        if ($data['has_messages']) {
        ?>

            <table class="table">
                <tr>
                    <th>Topic</th>
                    <th>Numero de mensajes</th>
                </tr>
                <?php

                foreach ($data['no_read_messages'] as $key => $value) {
                    echo "<tr>";

                    echo "<td><a href='index.php?url=NoReadMessagesPublicController/redirect_to_message/".$value['id']."/".$value['page']."/".$value['message_index']."' >" . $value['title'] . "</a></td>";
                    echo "<td>" . $value['num_messages'] . "</td>";

                    echo "</tr>";
                }
                ?>
            </table>
        <?php
        } else {
        ?>
            <p>No hay mensajes sin leer</p>
        <?php
        }
        ?>



    </div>
</div>



<?php

include_once 'footer.php';

?>