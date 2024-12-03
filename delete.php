<?php 
session_start();
include 'assets/db.php';

if (isset($_GET['category'])) 
{
    // Comprobar si existen productos asociados a la categoría
    $checkQuery = $con->query("SELECT id FROM inventeries WHERE catId = '$_GET[category]'");
    if ($checkQuery->num_rows > 0) 
    {
        // Si hay productos asociados, mostrar un mensaje emergente
        echo "<script>
                alert('No se puede eliminar la categoría porque tiene productos asociados.');
                window.location.href = 'manageCat.php';
              </script>";
    } 
    else 
    {
        // Si no hay productos asociados, eliminar la categoría
        if ($con->query("DELETE FROM categories WHERE id = '$_GET[category]'")) 
        {
            header("location:manageCat.php");
        } 
        else 
        {
            echo "<script>
                    alert('Error: " . addslashes($con->error) . "');
                    window.location.href = 'manageCat.php';
                  </script>";
        }
    }
}

if (isset($_GET['item'])) 
{
    if ($con->query("DELETE FROM inventeries WHERE id = '$_GET[item]'")) 
    {   
        $url = "location:inventeries.php?" . $_GET['url'];
        header($url);
    } 
    else 
    {
        echo "<script>
                alert('Error: " . addslashes($con->error) . "');
                window.location.href = 'inventeries.php';
              </script>";
    }
}
?>
