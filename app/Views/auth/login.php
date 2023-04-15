<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-screen h-screen flex justify-center items-center bg-[#f6f6f6]">
 <div class="md:w-[400px] xl:w-[500px] shadow-md p-14 bg-white rounded-lg">
  <h1 class="text-5xl font-bold mb-10 text-blue-500">Login</h1>
  <form action="<?= base_url('auth/login'); ?>" method="post">
    <?= csrf_field() ?>
    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
      <div class="text-red-600 bg-red-100 w-full px-4 py-3 rounded border border-red-600 font-regular"><?= session()->getFlashdata('fail'); ?></div>
    <?php endif ?>
    <div class="flex flex-col mt-8">
      <label for="name" class="font-semibold">Email</label>
      <input type="email" name="email" value="<?= set_value('email'); ?>" class="w-full bg-white border border-third focus:outline-none focus:ring-1 focus:ring-blue-500 block rounded-md mt-2 py-3 px-4 placeholder-slate-400 font-base" placeholder="Enter your Email" autofocus>
      <span class="text-red-400 text-sm"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
    </div>
    <div class="flex flex-col mt-4">
      <label for="name" class="font-semibold">Pasword</label>
      <div class="flex relative w-full mt-2">
        <input type="password" name="password" id="pass" value="<?= set_value('password'); ?>" class="w-full bg-white border border-third focus:outline-none focus:ring-1 focus:ring-third block rounded-md py-3 px-4 placeholder-slate-400 font-base" placeholder="Enter your password">
        <i class="fa-regular fa-eye absolute right-4 h-full flex items-center" id="btn-show"></i>
      </div>
      <span class="text-red-400 text-sm"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
    </div>
    <p class="mt-8 font-semibold"><a href="<?= site_url('auth/forgotPassword') ?>" class="text-base text-base text-sky-500">Forgot Password ?</a></p>
    <div class="flex items-center justify-between my-2">
      <hr class="border w-full">
      <p class="px-3 text-gray-500">or</p>
      <hr class="border w-full">
    </div>
    <p class="text-base text-slate-400">Don't have an account yet? <a href="<?= site_url('auth/register') ?>" class="text-sky-500 font-semibold">Create an account</a></p>
    <button type="submit" class="mt-8 w-full bg-blue-500 text-white font-semibold py-3 rounded">Login</button>
  </form>
 </div>
</div>
<?= $this->endSection() ?>