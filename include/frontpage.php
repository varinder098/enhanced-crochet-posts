<div class="pro-plugin">
  <div class="d-none post_id" value="<?php echo get_the_ID(); ?>"></div>
  <div class="d-none admin_url" value="<?php echo admin_url('admin-ajax.php'); ?>"></div>
  <input type="checkbox" id="modal">
  <div class="popup-open">
    <label for="modal" class="open-post"><i class="fas fa-cog"></i> <span class="post_setting">Change Post Settings</span></label>
  </div>
  <label for="modal" class="modal-background"></label>
  <div class="modal popup">
    <div class="modal-header">
      <h3>Settings</h3>
      <img class="header-img" onclick="$('#modal').click();" src="<?= get_site_url().IMAGES.'cross.png' ?>">
    </div>
    <div class="modal-body">
      <div class="first" style="padding-bottom: 18px;">
        <h2 class="modal-title ml-3"> Language Adjustments</h2>
        <div class="row">
          <div class="col-md-6">
            <div class="modal-text">Change Terminology</div>
          </div>
          <div class="col-md-6">
            <div class="toggle">
              <span class="lang"> US</span>
              <label class="switch">
                <input type="checkbox" id="language" checked>
                <span class="slider round"></span>
              </label>
              <span class="lang"> UK</span>
            </div>
          </div>
        </div>
        <div class="second">
          <h2 class="modal-title ml-3"> Left Handed Adjustments</h2>
          <div class="row">
            <div class="col-md-6">
              <div class="modal-text" >Reverse Images</div>
            </div>
            <div class="col-md-6">
              <div class="toggle">
                <span class="lang">OFF</span>
                <label class="switch">
                  <input type="checkbox" id="flip_images">
                  <span class="slider round"></span>
                </label>
                <span class="lang"> ON</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="modal-text" >Flip Videos</div>
            </div>
            <div class="col-md-6">
              <div class="toggle">
                <span class="lang">OFF</span>
                <label class="switch">
                  <input type="checkbox" id="flip_videos">
                  <span class="slider round"></span>
                </label>
                <span class="lang"> ON</span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="apply" class="btn apply mr-4" onclick="$('#modal').click();">APPLY CHANGES</button>
        </div>
      </div>
    </div>
  </div>
</div>