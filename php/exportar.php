<?php
// Conexión a la base de datos
include('database.php');

// Consulta para obtener las quejas y sugerencias
$query = "SELECT * FROM quejas_sugerencias";
$stmt = $pdo->prepare($query);
$stmt->execute();
$quejas_sugerencias = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Establece los encabezados para forzar la descarga del archivo Excel
header("Content-Type: application/vnd.ms-excel; charset=UTF-8"); // Tipo de contenido para Excel y codificación UTF-8
header("Content-Disposition: attachment; filename=quejas_sugerencias.xls"); // Nombre del archivo a descargar

// Inicia la estructura básica para un archivo Excel (.xls)
echo "<html xmlns:x='urn:schemas-microsoft-com:office:excel'>
        <head>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
            <xml>
                <x:ExcelWorkbook>
                    <x:ExcelWorksheets>
                        <x:ExcelWorksheet>
                            <x:Name>Quejas y Sugerencias</x:Name>
                            <x:WorksheetOptions>
                                <x:DisplayGridlines/>
                            </x:WorksheetOptions>
                        </x:ExcelWorksheet>
                    </x:ExcelWorksheets>
                </x:ExcelWorkbook>
            </xml>
        </head>
        <body>
            <table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Mensaje</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                </tr>";

// Muestra los datos de las quejas y sugerencias
foreach ($quejas_sugerencias as $row) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nombre']}</td>
            <td>{$row['correo']}</td>
            <td>{$row['mensaje']}</td>
            <td>{$row['tipo']}</td>
            <td>{$row['fecha']}</td>
          </tr>";
}

// Cierra la tabla
echo "</table>
      </body>
    </html>";
?>



