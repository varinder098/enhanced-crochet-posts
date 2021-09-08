


$(document).ready(function() {
    var max_fields = 10;
    var add_button = $(".add");
    var append = $('.append');
     
    
    if ($(".page_id").text() == "add") {
        var x = 1;
        var y = 1; 
        var rowIdx =1;
    } else {
        var rowIdx = $('.count').text();
        var x = $('.count').text();
        var y = $('.vcount').text();
        if(y==0)
        {
            y=1;
        }
    }

    $(add_button).click(function(e) {
        e.preventDefault();
        x++;
        $(append).append(`<tr id="R${++rowIdx}"><td><div class="ml-2 mb-2 d-flex"><span class="strong"> </span><input type="text" class="form-control" name="us[]"></div><p style=" margin-top: -29px;"> ${rowIdx}. </p></td><td><div class="mb-2 d-flex"><input type="text" class="form-control mr-2" name="uk[]"><a href="#" class="btn btn-sm btn-danger delete">&times;</a></div></td></tr>`); //add input box
    });





      $(append).on('click', '.delete', function () {
        // Getting all the rows next to the row
        // containing the clicked button
        var child = $(this).closest('tr').nextAll();
  
        // Iterating across all the rows 
        // obtained to change the index
        child.each(function () {
  
          // Getting <tr> id.
          var id = $(this).attr('id');
  
          // Getting the <p> inside the .row-index class.
          var idx = $(this).children(append).children('p');
  
          // Gets the row number from <tr> id.
          var dig = parseInt(id.substring(1));
  
          // Modifying row index.
          idx.html(` ${dig - 1}.`);
  
          // Modifying row id.
          $(this).attr('id', `R${dig - 1}`);
        });
  
        // Removing the current row.
        $(this).closest('tr').remove();
  
        // Decreasing total number of rows by 1.
        rowIdx--;
      });


    ///////////////////

        var add_video = $(".video");
    var vappend = $('.vappend');



  if ($(".page_id").text() == "add") {
        
        var y = 1; 
        var rowIdy =1;
    } else {
        var rowIdy = $('.vcount').text();

        var y = $('.vcount').text();
        if(y==0)
        {
            y=1;
        }
    }

      $(add_video).click(function(e) {
        e.preventDefault();
        if (y < max_fields) {
            y++;
            $(vappend).append(`
                <tr id="V${++rowIdy}">
                    <td style="display: flex;">
                        <span class="strong">${rowIdy}.</span>
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
                            <a href="#" class="btn btn-sm btn-danger deletes">&times;</a>
                        </div>
                    </td>
                </tr>`); //add input box
        
        } 
        else {
            alert('You Reached the limits')
        }
    });

    $(vappend).on('click', '.deletes', function () {
  
        // Getting all the rows next to the row
        // containing the clicked button
        var child = $(this).closest('tr').nextAll();
  
        // Iterating across all the rows 
        // obtained to change the index
        child.each(function() {
  
          // Getting <tr> id.
          var id = $(this).attr('id');
  
          // Getting the <p> inside the .row-index class.
          var idy = $(this).children(vappend).children('span');
  
          // Gets the row number from <tr> id.
          var digy = parseInt(id.substring(1)-1);
  
          // Modifying row index.
          idy.html(`${digy}.`);
  
          // Modifying row id.
          $(this).attr('id', `V${digy}`);
        });
  
        // Removing the current row.
        $(this).closest('tr').remove();
  
        // Decreasing total number of rows by 1.
        rowIdy--;
      });


   




    $(document).on("click", ".delete", function(e) {
        e.preventDefault();
      
        $(this).closest('tr').remove();
        x--;
    })

    $(document).on("click", ".deletes", function(e) {
        e.preventDefault();





          /////////////////////////////////
         $.ajax({
                type: "post",
                url: $(".admin_url").attr("value"),
                dataType: 'json',
                data: {
                    action: 'delete_data',
                    post_id: $(".post_id").attr("value"),
                    
                },
                success: function(data) {
                  console.log(data)
                }
            });
         ////////////////////////////////////

     $(this).closest('tr').remove();
        y--;
    })

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