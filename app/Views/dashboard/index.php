<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>
  <section>
    <?php if(empty($userInfo['photo'])) : ?>
      <div class="w-full p-5 bg-orange-100/50 rounded-lg border border-orange-400 flex justify-between gap-4">
        <i class="fa-solid fa-triangle-exclamation text-orange-600 text-lg"></i>
        <div class="w-[80%]">
          <h1 class="text-base font-medium">Update your profile</h1>
          <p class="text-base text-gray-500">Your profile photo has not been added, please add it first</p>
        </div>
        <a href="<?= base_url('profile') ?>" class="py-2 px-3 bg-white block max-w-max text-sm rounded-md border border-slate-400 mt-3 shadow">Go to Profile settings</a>
      </div>
    <?php endif ?>
    <div class="w-full grid grid-cols-[1fr_.5fr] my-6">
      <div class="w-full p-6">
        <h1 class="text-3xl font-bold mb-6">My Diary</h1>
        <?php if(!empty(session()->getFlashdata('successdel'))) : ?>
          <div class="text-green-600 bg-green-100 w-full px-4 py-3 mt-4 rounded border border-green-600 font-regular"><?= session()->getFlashdata('successdel'); ?></div>
        <?php endif ?>
        <?php if(!empty(session()->getFlashdata('faildel'))) : ?>
          <div class="text-red-600 bg-red-100 w-full px-4 py-3 mt-4 rounded border border-red-600 font-regular"><?= session()->getFlashdata('faildel'); ?></div>
        <?php endif ?>
        <?php if(!empty($dataDiary)) : ?>
          <?php foreach($dataDiary as $data): ?>
            <div class="w-full bg-blue-100 p-6 rounded my-4">
              <div class="flex justify-between">
                <p class="text-sm"><?= $data['date_created'] ?></p>
                <form action="/dashboard/delete/<?= $data['id']; ?>">
                  <button type="submit">
                    <i class="fa-solid fa-trash text-red-500"></i>
                  </button>
                </form>
              </div>
                <h1 class='text-xl font-semibold py-2'><?= $data['title'] ?></h1>
              <p class=""><?= $data['diary'] ?></p>
            </div>
          <?php endforeach ?>
        <?php else :?>
          <div class="flex gap-4 justify-center items-center border border-red-400 py-4 rounded">
            <i class="fa-solid fa-box-open text-red-500 text-2xl"></i>
            <h1 class="text-2xl text-center">Data is empty</h1>
          </div>
        <?php endif ?>
      </div>
      <div class="w-full bg-white shadow-md rounded-lg px-6 py-10 border border-slate-1  00">
        <h1 class="text-2xl font-bold">Add Diary</h1>
        <?php if(!empty(session()->getFlashdata('fail'))) : ?>
          <div class="text-red-600 bg-red-100 w-full px-4 py-3 mt-4 rounded border border-red-600 font-regular"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif ?>
        <?php if(!empty(session()->getFlashdata('success'))) : ?>
          <div class="text-green-600 bg-green-100 w-full px-4 py-3 mt-4 rounded border border-green-600 font-regular"><?= session()->getFlashdata('success'); ?></div>
        <?php endif ?>
        <form action="<?= base_url('dashboard/insert') ?>" method="post">
          <?= csrf_field() ?>
          <div class="flex flex-col mt-8">
            <label for="title" class="font-semibold">Title</label>
            <input type="text" name="title" class="w-full bg-white border border-third focus:outline-none focus:ring-1 focus:ring-blue-500 block rounded-md mt-2 py-3 px-4 placeholder-slate-400 font-base" placeholder="Enter your Email" autofocus>
            <span class="text-red-400 text-sm"><?= isset($validation) ? display_error($validation, 'title') : '' ?></span>
          </div>
          <div class="flex flex-col mt-8">
            <label for="diary" class="font-semibold">Your Diary</label>
            <textarea type="text" name="diary" class="w-full bg-white border border-third focus:outline-none focus:ring-1 focus:ring-blue-500 block rounded-md mt-2 py-3 px-4 placeholder-slate-400 font-base min-h-[100px] max-h-[180px]"></textarea>
            <span class="text-red-400 text-sm"><?= isset($validation) ? display_error($validation, 'dairy') : '' ?></span>
          </div>
          <button class="w-full bg-blue-500 text-white mt-6 py-2 font-bold rounded">Save</button>
        </form>
      </div>
    </div>
  </section>
  <!-- <section class="container mx-auto">
    <div class="w-full grid grid-cols-2">
      <div class="">2</div>
    </div>
  </section> -->
<?= $this->endSection() ?>
