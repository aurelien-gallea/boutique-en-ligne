<?php 

// on récupère tout de suite le login et le rang de l'utilisateur connecté pour l'affichage
if(isset($_SESSION['id'])); 
?>
<!DOCTYPE html>
<html lang="fr">

<head>
<title><?= $title ?></title>
    <meta property="og:type" content="website"/>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>    
    <link href="./public/assets/images/favicon.ico" rel="icon" type="image/x-icon" >
    <link rel="stylesheet" href="./public/design/default.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
          document.documentElement.classList.add('dark');
        } else {
          document.documentElement.classList.remove('dark')
        }
    </script>
    
    
</head>

<body class="flex flex-col min-h-screen">

    <header class="">  
        <?php require_once("./php/Components/header.php") ?>
    </header>

    <!-- Alert en cas de success  -->
    <?php if (isset($_SESSION['success'])) { ?>
        <div class=""><?= $_SESSION["success"] ?></div>

    <?php } ?>
    <!-- Alert en cas d'echec  -->
    <?php if (isset($_SESSION['error'])) { ?>
        <div class=""><?= $_SESSION["error"] ?></div>
   
    <?php } ?>

    
    <section class="">
        <div class="myDiv min-h-screen">
            <?= $content ?>
        </div>
    </section>



    <footer class="bg-white dark:bg-gray-900">
        <?php require_once('./php/Components/footer.php'); ?>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script type="module" src="./assets/js/modules/darkmode.js"></script>
    <?php 
    if (isset($script)) {
        echo $script;
    }

    ?>
</body>
</html>