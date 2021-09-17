$(document).ready(function() {
    var max_fields = 10;
    var add_button = $(".add");
    var append = $('.append');
    var add_video = $(".video");
    var vappend = $('.vappend');
    
    if ($(".page_id").text() == "add") {
        var x = 1;
        var y = 1;
    } else {
        var x = $('.count').text();
        var y = $('.vcount').text();
        if(y==0){ y=1; }
        if(x==0){ x=1; }
    }

    $(add_button).click(function(e) {
        e.preventDefault();
        x++;
        $(append).append(`<tr id="R${x}"><td><div class="ml-2 mb-2 d-flex"><span class="strong"> </span><input type="text" class="form-control" name="us[]"></div><p style=" margin-top: -29px;"> ${x}. </p></td><td><div class="mb-2 d-flex"><input type="text" class="form-control mr-2" name="uk[]"><a href="javascript:void(0)" class="btn btn-sm btn-danger delete">&times;</a></div></td></tr>`); //add input box
    });

      $(append).on('click', '.delete', function () {
        var child = $(this).closest('tr').nextAll();
            child.each(function () {
                var id = $(this).attr('id');
                var idx = $(this).children(append).children('p');
                var dig = parseInt(id.substring(1));
                idx.html(` ${dig - 1}.`);
                $(this).attr('id', `R${dig - 1}`);
            });
        $(this).closest('tr').remove();
        x--;

      });

      $(add_video).click(function(e) {
        e.preventDefault();
        if (y < max_fields) {
            y++;
            $(vappend).append(`
                <tr id="V${y}">
                    <td style="display: flex;">
                        <span class="strong">${y}.</span>
                        <div class="ml-2 mb-2 d-flex">
                            <input type="file" class="hide_file form-control" title="Choose File" name="default_video[]" accept=" video/*">
                        </div>
                    </td>
                    <td>
                        <div class="mb-2 d-flex">
                            <input type="file" class="hide_file form-control" title="Choose File" name="left_handed_video[]" accept=" video/*"
                            >
                        </div>
                    </td>
                    <td style="vertical-align: inherit;">
                        <div class="mb-2 d-flex">
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger deletes">&times;</a>
                        </div>
                    </td>
                </tr>`); //add input box
        } 
        else {
            alert('You Reached the limits')
        }
    });

    $(vappend).on('click', '.deletes', function () {
        var child = $(this).closest('tr').nextAll();
            child.each(function() {
                var id = $(this).attr('id');
                var idy = $(this).children(vappend).children('span');
                var digy = parseInt(id.substring(1)-1);
                idy.html(`${digy}.`);
                $(this).attr('id', `V${digy}`);
            });

            var x=$(this).attr('data-id');
            if(x===undefined)
            {
            }else{
                 $(".deletes-record").append('<input type="hidden" name="deleted_video[]" value="'+x+'">');
                
            }

       
        $(this).closest('tr').remove();
        y--;
    });

    $(function() {
        var $tabButtonItem = $('#tab-button li'),
            $tabSelect = $('#tab-select'),
            $tabContents = $('.tab-contents'),
            activeClass = 'is-active';

        $tabButtonItem.first().addClass(activeClass);
        $tabContents.not(':first').hide();

        $tabButtonItem.find('a').on('click', function(e) {
            var target = $(this).attr('href');

            $tabButtonItem.removeClass(activeClass);
            $(this).parent().addClass(activeClass);
            $tabSelect.val(target);
            $tabContents.hide();
            $(target).show();
            e.preventDefault();
        });

        $tabSelect.on('change', function() {
            var target = $(this).val(),
                targetSelectNum = $(this).prop('selectedIndex');

            $tabButtonItem.removeClass(activeClass);
            $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
            $tabContents.hide();
            $(target).show();
        });
    });

    function copyToClipboard(text) {
      if (window.clipboardData && window.clipboardData.setData) {
        // IE specific code path to prevent textarea being shown while dialog is visible.
        return clipboardData.setData("Text", text);

      } else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
        var textarea = document.createElement("textarea");
        textarea.textContent = text;
        textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
        document.body.appendChild(textarea);
        textarea.select();
        try {
          return document.execCommand("copy"); // Security exception may be thrown by some browsers.
        } catch (ex) {
          console.warn("Copy to clipboard failed.", ex);
          return false;
        } finally {
          document.body.removeChild(textarea);
        }
      }
    }

    // this code is to check the videos limit less than 40 mb 
    $(document).on('change', '.hide_file', function (event) {
        $(this).next('.hide_file').html(event.target.files[0].name);
        $(this).addClass("uploaded");
    });

    $(document).on('click', '#save_videos #publish', function (e) {
         e.preventDefault();
         check();
    });

    function check(){
        if (localStorage.getItem("wp_limit") === null) {
            $(".checklimit").click();
        }
        var limit = localStorage.getItem("wp_limit");
        var hide_file = document.getElementsByClassName('uploaded');
        var imageSizeArr = 0;
        for (var i = 0; i <hide_file.length; i++) {
           imageSizeArr += parseInt(hide_file[i].files[0].size);
        }
        if(imageSizeArr<limit){
           $('#post').submit();
        }else{
            alert("Please upload videos less than "+limit+" mb");
        }
    }

    $(document).on('click', '#update_btn', function (e) {
        
        var limit= $("#limit").val();
        $.ajax({ 
            type: "post",
                url: $(".admin_url").attr("value"),
                dataType: 'json',
                data: {
                    action: 'update_limit',
                    post_id: $(".post_id").attr("value"),
                    limit: limit
                },
            success: function (data) { 
               if(data.status==200)
               {
                 localStorage.setItem("wp_limit",limit);
               }
               else
               {
                 alert("something went wrong !! ask your developer");
               }
            },
            error: function (errorMessage) {
                alert("something went wrong !! ask your developer");
            }
        });
        e.preventDefault();
    });

    setTimeout(function() {
        if (localStorage.getItem("wp_limit") === null) {
            $(".checklimit").click();
        }
    }, 1300);
});


       
