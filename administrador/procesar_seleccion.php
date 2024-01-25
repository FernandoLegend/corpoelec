<?php
// Conexión a la base de datos y otras configuraciones necesarias

if (isset($_POST['id']) && isset($_POST['seleccionado'])) {
    $id = $_POST['id'];
    $seleccionado = $_POST['seleccionado'];

    // Realiza la lógica para manejar la selección (por ejemplo, actualización en la base de datos)
    // ...

    // Imprime una respuesta (simulado)
    echo "La selección del ID $id se ha actualizado: $seleccionado";
}
?>
