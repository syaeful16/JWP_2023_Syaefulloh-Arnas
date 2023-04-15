<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="w-screen flex flex-col items-center mt-20">
  <div class="w-[400px] flex flex-col items-center">
    <div class="bg-blue-100 flex justify-center items-center rounded-full text-lg p-3">
    <i class="fa-regular fa-keyboard text-blue-500"></i>
    </div>
    <h1 class="text-[2.5rem] font-medium mt-4 mb-1">Change Password</h1>
    <p class="text-gray-400">No worries, we'll send you reset intructions.</p>
    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
      <div class="text-green-600 bg-green-100 w-full px-4 py-3 rounded border border-green-600 font-regular"><?= session()->getFlashdata('fail'); ?></div>
    <?php endif ?>
    <form action="<?= base_url('auth/updatePassword') ?>" method="post" class="w-full">
      <input type="text" name="token" value="<?= $token ?>" hidden>
      <div class="flex flex-col mt-8">
        <label for="password" class="font-semibold">Password</label>
        <div class="flex relative w-full mt-2">
          <input type="password" name="password" id="pass" value="<?= set_value('password'); ?>" class="w-full bg-white border border-third focus:outline-none focus:ring-1 focus:ring-third block rounded-md py-3 px-4 placeholder-slate-400 font-base" placeholder="Enter your password">
          <i class="fa-regular fa-eye absolute right-4 h-full flex items-center" id="btn-show"></i>
        </div>
        <span class="text-red-400 text-sm"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
      </div>
      <div class="flex flex-col mt-8">
        <label for="cpassword" class="font-semibold">Confirm Password</label>
        <div class="flex relative w-full mt-2">
          <input type="password" name="cpassword" id="pass2" value="<?= set_value('cpassword'); ?>" class="w-full bg-white border border-third focus:outline-none focus:ring-1 focus:ring-third block rounded-md py-3 px-4 placeholder-slate-400 font-base" placeholder="Enter repeat password">
          <i class="fa-regular fa-eye absolute right-4 h-full flex items-center" id="btn-show2"></i>
        </div>
        <span class="text-red-400 text-sm"><?= isset($validation) ? display_error($validation, 'cpassword') : '' ?></span>
      </div>
      <button type="submit" class="mt-8 w-full bg-blue-500 text-white font-semibold py-3 rounded">Reset Password</button>
    </form>
    <a href="<?= base_url('auth') ?>" class="flex items-center gap-4 mt-6 text-gray-500"><i class="fa-solid fa-arrow-left"></i> Back to Login</a>
  </div>
</section>
<?= $this->endSection() ?>