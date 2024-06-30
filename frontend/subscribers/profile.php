<?php
require_once('header.php');
$user = unserialize($_SESSION["user"]);
$myposts = $user->myposts($user->id);
?>
<section class="w-100 px-4 py-5" style="background-color: #9de2ff; border-radius: .5rem .5rem 0 0;">
  <div class="row d-flex justify-content-center">
    <div class="col col-md-9 col-lg-7 col-xl-6">
      <div class="card" style="border-radius: 15px;">
        <div class="card-body p-4">
          <div class="d-flex">
            <div class="col-xl-5">
              <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                <?php

if (isset($_GET["msg"]) && $_GET["msg"] == 'uius') {
?>

  <div class="alert alert-success" role="alert">
    <strong>done</strong> user image updated successfully
  </div>


<?php
}

?>
                  <img class="img-account-profile rounded-circle mb-2" style="width:10pc;height: 10pc;border-radius: 10pc" src="<?php if(!empty($user->image)) echo $user->image; else echo 'http://bootdey.com/img/Content/avatar/avatar1.png' ?>">
                      <form action="store_user_image.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="image"><br> Upload new image</input>
                    <button type="submit" class="btn btn-primary">
                      save
                    </button>

                  </form>
                </div>
              </div>
            </div>
            <div class="flex-grow-1 ms-3">
              <h5 class="mb-1"><?= $user->name ?></h5>
              <p class="mb-2 pb-1"><?= $user->role ?></p>
              <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                <div>
                  <p class="small text-muted mb-1">Articles</p>
                  <p class="mb-0">41</p>
                </div>
                <div class="px-3">
                  <p class="small text-muted mb-1">Followers</p>
                  <p class="mb-0">976</p>
                </div>
                <div>
                  <p class="small text-muted mb-1">Rating</p>
                  <p class="mb-0">8.5</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container">
  <div class="row">


    <div class="col-6 offset-3 bg-info mt-5 rounded-2">
      <h1 class="text-black text-center">share your idea</h1>
    </div>
    <div class="col-6 offset-3 bg-info mt-5 rounded-2 pt-5">
      <?php

      if (isset($_GET["msg"]) && $_GET["msg"] == 'done') {
      ?>

        <div class="alert alert-success" role="alert">
          <strong>done</strong> post Added Successfully
        </div>


      <?php
      }

      ?>
      <?php

      if (isset($_GET["msg"]) && $_GET["msg"] == 'required_fields') {
      ?>

        <div class="alert alert-danger" role="alert">
          <strong>required fields</strong> required fields
        </div>


      <?php
      }

      ?>
      <form action="storePost.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="" class="form-label">title</label>
          <input type="text" name="title" id="" class="form-control" placeholder="" aria-describedby="helpId" />
          <small id="helpId" class="text-muted">Help text</small>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">content</label>
          <textarea type="text" name="content" id="" class="form-control" placeholder="" aria-describedby="helpId"></textarea>
          <small id="helpId" class="text-muted">Help text</small>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">image</label>
          <input type="file" name="image" id="" class="form-control" placeholder="" aria-describedby="helpId">
          <small id="helpId" class="text-muted">Help text</small>
        </div>
        <button type="submit" class="btn btn-primary my-5">
          Submit
        </button>
      </form>
    </div>
  </div>

  <?php

  foreach ($myposts as $post) {
  ?>
    <div class="col-6 offset-3 bg-info mt-5 rounded-2">
      <div class="card">
        <?php
        if (!empty($post["image"])) {
        ?>

          <img class="card-img-top" src="<?= $post["image"] ?>" alt="Title" />

        <?php
        }
        ?>
        <div class="card-body">
          <h4 class="card-title"><?= $post["title"] ?></h4>
          <p class="card-text"><?= $post["content"] ?></p>
        </div>
        <div class="row d-flex justify-content-center">
  <div class="col">
    <div class="card shadow-0 border" style="background-color: #f0f2f5;">
      <div class="card-body p-4">
        <form action="store_comment.php" method="post">
        <div data-mdb-input-init class="form-outline mb-4">
          <input type="text" id="addANote" name="comment" class="form-control" placeholder="Type comment..." />
          <input type="hidden" name="post_id" value="<?= $post["id"] ?>">
          <button type="submit" class="btn btn-primary mt-2 ms-2">+ Add a note</button>
        </div>
        </form>
        <?php
        
          $comments = $user->get_post_comment($post["id"]);
          foreach ($comments as $comment) {
            ?>

<div class="card mb-4">
          <div class="card-body">
            <p><?= $comment["comment"] ?></p>

            <div class="d-flex justify-content-between">
              <div class="d-flex flex-row align-items-center">
                  <img class="img-account-profile rounded-circle mb-2" style="width:2pc;height: 2pc;border-radius: 2pc" src="<?php if(!empty($comment["image"])) echo $user->image; else echo 'http://bootdey.com/img/Content/avatar/avatar1.png' ?>">                
                  <b><p class="small mb-0 ms-2"><?= $comment["name"] ?></p></b>
              </div>
              <div class="d-flex flex-row align-items-center">
                <p class="small text-muted mb-0"> <?= $comment["created_at"] ?> </p>
              </div>
            </div>
          </div>
        </div>

            <?php
          }
        
        ?>
      </div>
    </div>
  </div>
</div>
      </div>

    </div>
  <?php
  }

  ?>

</div>

<?php
require_once('footer.php');
?>