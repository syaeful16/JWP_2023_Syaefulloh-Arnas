<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>
<section class="container w-full mx-auto py-6 px-8">
  <h1 class="text-4xl font-semibold block">My Profile</h1>
  <?php if(!empty(session()->getFlashdata('success'))) : ?>
    <div class="text-green-600 bg-green-100 w-full px-4 py-3 rounded border border-green-600 font-regular block my-6"><?= session()->getFlashdata('success'); ?></div>
  <?php endif ?>
  <div class="w-full my-12 flex items-center gap-8">
    <div class="w-[150px] h-[150px] rounded-full relative bg-white">
      <img src="img/<?= $userInfo['photo']; ?>" id="photoProfile" alt="" class="w-[150px] h-[150px] object-cover rounded-full">
    </div>
    <div class="">
      <h1 class="text-3xl py-3 font-semibold"><?= $userInfo['name'] ?></h1>
      <form action="<?= base_url('profile/changePhoto'); ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
        <div class="flex gap-4">
          <label for="photo" class="flex items-center gap-4 py-2 px-3 border border-slate-500 max-w-max rounded-md shadow"><i class="fa-solid fa-pen"></i> Change Photo</label>
          <input type="file" name="photo" id="photo" hidden>
          <button type="submit" class="flex items-center gap-4 py-2 px-3 rounded-md bg-blue-500 text-white"><i class="fa-solid fa-floppy-disk"></i>Save</button>
        </div>
      </form>
    </div>
  </div>
  <hr>
  <div class="w-[70%] grid grid-cols-[.6fr_1fr] gap-4">
    <div class="my-6">
      <h1 class="text-2xl font-semibold">Your account identity</h1>
      <p class="text-gray-400">You can change your account identity here</p>
    </div>
    <form action="<?= base_url('profile/update') ?>" method="post">
      <?= csrf_field() ?>
      <div class="flex flex-col mt-8">
        <label for="name" class="font-semibold">Fullname</label>
        <input type="text" id="name" name="name" value="<?= $userInfo['name']; ?>" class="w-full bg-white border border-third focus:outline-none focus:ring-1 focus:ring-blue-500 block rounded-md mt-2 py-3 px-4 placeholder-slate-400 font-base" placeholder="Enter your full name" autofocus>
      </div>
      <div class="flex flex-col mt-4">
        <label for="email" class="font-semibold">Email</label>
        <input type="email" id="email" value="<?= $userInfo['email']; ?>" name="email" class="w-full bg-white border border-third focus:outline-none focus:ring-1 focus:ring-blue-500 block rounded-md mt-2 py-3 px-4 placeholder-slate-400 font-base" placeholder="Enter your email" autofocus>
      </div>
      <button type="submit" class="mt-8 w-full bg-blue-500 text-white font-semibold py-3 rounded">Save</button>
    </form>
  </div>
</section>
<script>
  $(document).ready(function() {
  $('#photo').on('change', function() {
    var file = $(this).prop('files')[0];
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#photoProfile').attr('src', e.target.result);
    }

    reader.readAsDataURL(file);
  });
});
</script>

<?= $this->endSection() ?>