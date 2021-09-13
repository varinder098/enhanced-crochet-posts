$(document).ready(function() {
    var max_fields = 10;
    var add_button = $(".add");
    var append = $('.append');
    var add_video = $(".video");
    var vappend = $('.vappend');
     
    
    if ($(".page_id").text() == "add") {
        var x = 1;
        var y = 1; 
        var rowIdx =1;
        var rowIdy =1;
    } else {
        var rowIdx = $('.count').text();
        var rowIdy = $('.vcount').text();
        var x = $('.count').text();
        var y = $('.vcount').text();

        if(y==0)
        {
            y=1;
        }

        if(x==0)
        {
            x=1;
        }
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

        $(".deletes-record").append('<input type="hidden" name="deleted_video[]" value="'+$(this).attr('data-id')+'">');
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

    $(document).on('change', '.hide_file', function (event) {
        $(this).next('.hide_file').html(event.target.files[0].name);
    })
});
/**/