<header>
  <nav class=" border-gray-200 bg-[#FFF9F5] dark:bg-gray-800">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="<?= $home ?>" class="flex items-center">
        <!-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="" /> -->
        <span class="self-center text-2xl font-semibold whitespace-nowrap text-[#AD785D]">M. A. H.</span>
      </a>
      <div>
        </div>
        <div class="flex items-center md:order-2">
          
          <?php if (!empty($_SESSION["userId"])) { ?>
            <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
              <span class="sr-only">Open user menu</span>
              <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-600" id="user-dropdown">
              <div class="px-4 py-3">
                <span class="block text-sm text-gray-900 dark:text-white"><?= $_SESSION["firstname"] . " " . $_SESSION["lastname"] ?></span>
                <span class="block text-sm  text-gray-500 truncate dark:text-gray-400"><?= $_SESSION["email"] ?></span>
              </div>
              <ul class="py-2" aria-labelledby="user-menu-button">
            <li>
              <a href="<?= $cart ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Panier</a>
            </li>
            <li>
              <a href="./myorders.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Mes commandes</a>
            </li>
            <li>
              <a href="./profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Mes infos</a>
            </li>
            <li>
              <a href="./logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Déconnexion</a>
            </li>
          </ul>
        </div>
        <?php } ?>
        <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
        <ul class="flex flex-col min-[768px]:items-center font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-[#FFF9F5] md:flex-row md:space-x-8 md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-800 dark:border-gray-700">
          <li class="relative flex justify-end">
            <input type="search" name="search" id="search" placeholder="Rechercher un produit ..." class="w-full md:w-2/3 lg:w-full rounded">
            <div class="absolute top-10 left-0 z-50 w-full dark:bg-gray-800" id="results"></div>
          </li>
          <li class="max-md:pt-2">
            <a href="<?= $home ?>" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-[#AD785D] md:p-0 md:dark:text-[#AD785D]" aria-current="page">Accueil</a>
          </li>
          <?php if (!empty($_SESSION['role'])) {
            if ($_SESSION['role'] === "admin") { ?>
            <li>
              <a href="<?= $admin ?>" target="_blank" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#AD785D] md:p-0 dark:text-white md:dark:hover:text-[#AD785D] dark:hover:bg-gray-700 md:dark:hover:bg-transparent dark:border-gray-700">Admin</a>
            </li>
            <?php }
        } ?>
        <li>
        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-[#AD785D] md:p-0 md:w-auto dark:text-white md:dark:hover:text-[#AD785D] dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Nos produits<svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
        <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-800 border dark:border-gray-700 dark:divide-gray-600">
          <div class="py-1">
            <a href="<?= $products ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Tous les produits</a>
          </div>
                <ul id="catDropdown" class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                  
                </ul>
            </div>
            <!-- <a href="<?= $products ?>" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#AD785D] md:p-0 dark:text-white md:dark:hover:text-[#AD785D] dark:hover:bg-gray-700 md:dark:hover:bg-transparent dark:border-gray-700">Tous les produits</a> -->
        </li>
        <?php if (empty($_SESSION['userId'])) { ?>
          <li>
            <a href="./signIn.php" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#AD785D] md:p-0 dark:text-white md:dark:hover:text-[#AD785D] dark:hover:bg-gray-700 md:dark:hover:bg-transparent dark:border-gray-700">Connexion</a>
          </li>
          <?php } ?>
          <button id="theme-toggle" type="button" class="text-[#AD785D] dark:text-[#AD785D] hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
          </button>
        </ul>
      </div>
    </div>
  </nav>
</header>
  
  <?php $script = '<script type="module" src="./assets/js/products/search.js"></script><br>
                  <script type="module" src="./assets/js/products/allcategories.js"></script>' ?>