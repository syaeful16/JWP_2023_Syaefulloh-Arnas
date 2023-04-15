<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css"  rel="stylesheet" />
  <script src="https://kit.fontawesome.com/f1a60a6392.js" crossorigin="anonymous"></script>
</head>
<body class="w-screen mx-auto"> 
  <nav class="bg-white border-gray-200 shadow">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="<?= base_url('dashboard') ?>" class="flex items-center">
        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap">Diary notes</span>
    </a>
    <div class="flex items-center md:order-2">
        <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
          <span class="sr-only">Open user menu</span>
          <img class="w-8 h-8 object-cover rounded-full" src="img/<?= $userInfo['photo']; ?>" alt="user photo">
        </button>
        <!-- Dropdown menu -->
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
          <div class="px-4 py-3">
            <span class="block text-sm text-gray-900"><?= $userInfo['name']; ?></span>
            <span class="block text-sm  text-gray-500 truncate"><?= $userInfo['email']; ?></span>
          </div>
          <ul class="py-2" aria-labelledby="user-menu-button">
            <li>
              <a href="<?= base_url('profile') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
            </li>
            <li>
              <a href="<?= site_url('auth/logout'); ?>" class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100">Sign out</a>
            </li>
          </ul>
        </div>
        <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
      </button>
    </div>
  </nav>
  <section class="container mx-auto 2xl:px-40 py-8">
    <!-- Content Web -->
    <?= $this->renderSection('content'); ?>

  </section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>