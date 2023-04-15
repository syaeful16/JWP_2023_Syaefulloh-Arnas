<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-screen h-screen flex justify-center items-center bg-[#f6f6f6]">
 <div class="md:w-[500px] shadow-md p-14 bg-white rounded-lg">
  <h1 class="text-5xl font-bold mb-10 text-blue-500">Create Account</h1>
  <form action="<?= base_url('auth/save') ?>" method="post">
    <?= csrf_field() ?>
    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
      <div class="text-red-600 bg-red-100 w-full px-4 py-3 rounded border border-red-600 font-regular"><?= session()->getFlashdata('fail'); ?></div>
    <?php endif ?>
    <?php if(!empty(session()->getFlashdata('success'))) : ?>
      <div class="text-green-600 bg-green-100 w-full px-4 py-3 rounded border border-green-600 font-regular"><?= session()->getFlashdata('success'); ?></div>
    <?php endif ?>
    <div class="flex flex-col mt-8">
      <label for="name" class="font-semibold">Fullname</label>
      <input type="text" id="name" name="name" value="<?= set_value('name'); ?>" class="w-full bg-white border border-third focus:outline-none focus:ring-1 focus:ring-blue-500 block rounded-md mt-2 py-3 px-4 placeholder-slate-400 font-base" placeholder="Enter your full name" autofocus>
      <span class="text-red-400 text-sm"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
    </div>
    <div class="flex flex-col mt-4">
      <label for="email" class="font-semibold">Email</label>
      <input type="email" id="email" value="<?= set_value('email'); ?>" name="email" class="w-full bg-white border border-third focus:outline-none focus:ring-1 focus:ring-blue-500 block rounded-md mt-2 py-3 px-4 placeholder-slate-400 font-base" placeholder="Enter your email" autofocus>
      <span class="text-red-400 text-sm"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
    </div>
    <div class="flex flex-col mt-4">
      <label for="password" class="font-semibold">Password</label>
      <div class="flex relative w-full mt-2">
        <input type="password" name="password" id="pass" value="<?= set_value('password'); ?>" class="w-full bg-white border border-third focus:outline-none focus:ring-1 focus:ring-third block rounded-md py-3 px-4 placeholder-slate-400 font-base" placeholder="Enter your password">
        <i class="fa-regular fa-eye absolute right-4 h-full flex items-center" id="btn-show"></i>
      </div>
      <span class="text-red-400 text-sm"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
    </div>
    <p class="text-base mt-8 text-slate-400">Already have an account? <a href="<?= site_url('auth') ?>" class="text-sky-500 font-semibold">login</a></p>
    <button type="submit" class="mt-8 w-full bg-blue-500 text-white font-semibold py-3 rounded">Register</button>
  </form>
 </div>
</div>
<?= $this->endSection() ?>