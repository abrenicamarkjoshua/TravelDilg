
$(function(){
    $("select#applySelectProvince").change(function(){
        var token = document.getElementsByName('_token').value;
        $.ajax({
          type: 'GET',
          headers: {'X-CSRF-TOKEN': token},
          url: '../getMunicipalitiesByProvince',
          data: { 'province' : $("select#applySelectProvince").val() },
          dataType: 'json',
          success: function(j) {
              var options = '';
              for (var i = 0; i < j.length; i++) {
                options += '<option value="' + j[i].citymunDesc + '">' + j[i].citymunDesc + '</option>';
              }
              $("select#selectMunicipality").html(options);
          },
          error: function(j) {
            alert('Error loading: ');
          }
        });

    });
  // $("select#applySelectProvince").change(function(){
  //   $.getJSON("/getMunicipalitiesByProvince",
  //       {id: $(this).val(),
         
  //       ajax: 'true'}, function(j){
  //     var options = '';
  //     for (var i = 0; i < j.length; i++) {
  //       options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
  //     }
  //     $("select#selectMunicipality").html(options);
  //   });
  // })
});
$('#mobilenumber').unbind('keyup change input paste').bind('keyup change input paste',function(e){
    var $this = $(this);
    var val = $this.val();
    var valLength = val.length;
    var maxCount = $this.attr('maxlength');
    if(valLength>maxCount){
        $this.val($this.val().substring(0,maxCount));
    }
}); 

//INPUT validation letters, spaces, and dot only
function validate(e){
    if(("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ. ").indexOf(String.fromCharCode(e.keyCode))===-1){
        e.preventDefault();
        return false;
    }
}
function checkEmail(emailAddress) {
 
   var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(emailAddress);
}

$("#addmoredocuments").click(function(){
        $('#uploaddocuments').append(' <input  name = "documents[]" type="file" accept="application/pdf"><label class = "mylabel" for="password">document remarks/notes:</label><input class = "pure-u-11-24" name = "documentremarks[]" type="text" placeholder = "type document notes/remarks"/><br>');

});

$("#positionElective").show();
$("#nonelectiveposition").hide();
if($("#positiontype").val() == "NON ELECTIVE"){
  $("#positionElective").hide();
  $("#nonelectiveposition").show();

}
$(document).ready(function() {
    $("#positiontype").change(function(){
        if($(this).val() == "NON ELECTIVE")
            {
                $("#nonelectiveposition").show();
                $("#positionElective").hide();
            }
            else{
                $("#nonelectiveposition").hide();
                $("#positionElective").show();
            }
        });
});

(function (window, document) {
document.getElementById('toggle').addEventListener('click', function (e) {
    document.getElementById('tuckedMenu').classList.toggle('custom-menu-tucked');
    document.getElementById('toggle').classList.toggle('x');
});
})(this, this.document);


// $(function(){

//     $("table").stickyTableHeaders();
// });

(function ($) {
    $.StickyTableHeaders = function (el, options) {
        // To avoid scope issues, use 'base' instead of 'this'
        // to reference this class from internal events and functions.
        var base = this;

        // Access to jQuery and DOM versions of element
        base.$el = $(el);
        base.el = el;

        // Add a reverse reference to the DOM object
        base.$el.data('StickyTableHeaders', base);

        base.init = function () {
            base.options = $.extend({}, $.StickyTableHeaders.defaultOptions, options);

            base.$el.each(function () {
                var $this = $(this);
                $this.wrap('<div class="divTableWithFloatingHeader" style="position:relative"></div>');

                var originalHeaderRow = $('thead:first', this);
                originalHeaderRow.before(originalHeaderRow.clone());
                var clonedHeaderRow = $('thead:first', this);

                clonedHeaderRow.addClass('tableFloatingHeader');
                clonedHeaderRow.css('position', 'fixed');
                clonedHeaderRow.css('top', '0px');
                clonedHeaderRow.css('left', $this.css('margin-left'));
                clonedHeaderRow.css('display', 'none');

                originalHeaderRow.addClass('tableFloatingHeaderOriginal');

                // enabling support for jquery.tablesorter plugin
                $this.bind('sortEnd', function (e) { base.updateCloneFromOriginal(originalHeaderRow, clonedHeaderRow); });
            });

            base.updateTableHeaders();
            $(window).scroll(base.updateTableHeaders);
            $(window).resize(base.updateTableHeaders);
        };

        base.updateTableHeaders = function () {
            base.$el.each(function () {
                var $this = $(this);
                var $window = $(window);

                var fixedHeaderHeight = isNaN(base.options.fixedOffset) ? base.options.fixedOffset.height() : base.options.fixedOffset;

                var originalHeaderRow = $('.tableFloatingHeaderOriginal', this);
                var floatingHeaderRow = $('.tableFloatingHeader', this);
                var offset = $this.offset();
                var scrollTop = $window.scrollTop() + fixedHeaderHeight;
                var scrollLeft = $window.scrollLeft();

                if ((scrollTop > offset.top) && (scrollTop < offset.top + $this.height())) {
                    floatingHeaderRow.css('top', fixedHeaderHeight + 'px');
                    floatingHeaderRow.css('margin-top', 0);
                    floatingHeaderRow.css('left', (offset.left - scrollLeft) + 'px');
                    floatingHeaderRow.css('display', 'block');

                    base.updateCloneFromOriginal(originalHeaderRow, floatingHeaderRow);
                }
                else {
                    floatingHeaderRow.css('display', 'none');
                }
            });
        };

        base.updateCloneFromOriginal = function (originalHeaderRow, floatingHeaderRow) {
            // Copy cell widths and classes from original header
            $('th', floatingHeaderRow).each(function (index) {
                $this = $(this);
                var origCell = $('th', originalHeaderRow).eq(index);
                $this.removeClass().addClass(origCell.attr('class'));
                $this.css('width', origCell.width() + 10);
            });

            // Copy row width from whole table
            floatingHeaderRow.css('width', originalHeaderRow.width());
        };

        // Run initializer
        base.init();
    };

    $.StickyTableHeaders.defaultOptions = {
        fixedOffset: 0
    };

    $.fn.stickyTableHeaders = function (options) {
        return this.each(function () {
            (new $.StickyTableHeaders(this, options));
        });
    };

})(jQuery);

// // Jquery Function to Validate Patterns on Input Objects
// (function( $ ){
//     $.fn.validatePattern = function(search) {
//         // Get the current element's siblings
//         var pattern = this.attr('pattern');
//         var value = this.val();

//         return !(pattern&&(value.length>0)&&!value.match( new RegExp('^'+pattern+'$') ));
//     };
// })( jQuery );

// $(document).ready(function() {
//     // Bind pattern checking (invalid) to on change
//     $(':input').keypress(function() {
//         if (!$(this).validatePattern()) {
//             $(this).addClass('input-error');
//         } else{
//            $(this).removeClass('input-error');
//         }
//     });
//     // // Bind pattern valid to keyUp
//     // $(':input').keyUp(function() {
//     //     if ($(this).validatePattern()) {
//     //         $(this).removeClass('input-error');
//     //     } else{
//     //        $(this).addClass('input-error');
//     //     }
//     // });
// });

var entitlementOptions = applicationform.entitlements;
for(var i = 0; i <= entitlementOptions.length - 1; i++){
  entitlementOptions[i].onclick = function(){
    if(entitlementOptions.value == 'with entitlements'){
      $('#elementsToOperateOn :input').removeAttr('disabled');

    }else{
      $('#elementsToOperateOn :input').attr('disabled', true);

      $('#elementsToOperateOn :input').val('');
      $('#elementsToOperateOn :input').attr("checked",false);
    }
  };
}
