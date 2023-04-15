<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="w-screen flex flex-col items-center mt-20">
  <div class="w-[400px] flex flex-col items-center">
    <div class="bg-blue-100 flex justify-center items-center rounded-full text-lg p-3">
      <i class="fa-solid fa-key text-blue-500"></i>
    </div>
    <h1 class="text-[2.5rem] font-medium mt-4 mb-1">Forgot Password</h1>
    <p class="text-gray-400">No worries, we'll send you reset intructions.</p>
    <?php if(!empty(session()->getFlashdata('success'))) : ?>
      <div class="text-green-600 bg-green-100 w-full px-4 py-3 mt-5 rounded border border-green-600 font-regular"><?= session()->getFlashdata('success'); ?></div>
    <?php endif ?>
    <form action="<?= base_url('auth/sendReset') ?>" method="post" class="w-full">
      <div class="flex flex-col mt-8">
        <label for="name" class="font-semibold">Email</label>
        <input type="email" name="email" value="<?= set_value('email'); ?>" class="w-full bg-white border border-third focus:outline-none focus:ring-1 focus:ring-blue-500 block rounded-md mt-2 py-3 px-4 placeholder-slate-400 font-base" placeholder="Enter your Email" autofocus>
        <span class="text-red-400 text-sm"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
      </div>
      <button type="submit" class="mt-8 w-full bg-blue-500 text-white font-semibold py-3 rounded">Reset Password</button>
    </form>
    <a href="<?= base_url('auth') ?>" class="flex items-center gap-4 mt-6 text-gray-500"><i class="fa-solid fa-arrow-left"></i> Back to Login</a>
  </div>
</section>
<?= $this->endSection() ?>