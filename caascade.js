jQuery(document).ready( function($)
{
  $('.caascade-submit').click(function()
  {
    var cid = '#' + $(this).parent('div').parent('div').attr('id');
    if($(cid + ' .caascade-arg0').val() == '')
    {
     alert('Please enter all required input.');
     return false;
    }

    $(cid + ' .caascade-waiting').animate({opacity:1,height:'toggle'});
    $(cid + ' .caascade-output').animate({opacity:0,height:'toggle'});
    jQuery.ajax({
      type : 'get',
      url : caascadeAjax.ajaxurl,
      dataType : 'jsonp',
      data: {
        action: "caascade_compute",
        arg0: $(cid + ' .caascade-arg0').val(),
        arg1: $(cid + ' .caascade-arg1').val(),
        arg2: $(cid + ' .caascade-arg2').val(),
        arg3: $(cid + ' .caascade-arg3').val(),
        arg4: $(cid + ' .caascade-arg4').val(),
        input_base: $(cid + ' .caascade-input_base').val(),
        output_base: $(cid + ' .caascade-output_base').val(),
				expr_1: $(cid + ' .caascade-expr_1').val(),
        expr_2: $(cid + ' .caascade-expr_2').val(),
        x_wrt: $(cid + ' .caascade-x_wrt').val(),
        y_wrt: $(cid + ' .caascade-y_wrt').val(),
        z_wrt: $(cid + ' .caascade-z_wrt').val(),
        x_from: $(cid + ' .caascade-x_from').val(),
        y_from: $(cid + ' .caascade-y_from').val(),
        z_from: $(cid + ' .caascade-z_from').val(),
        x_to: $(cid + ' .caascade-x_to').val(),
        y_to: $(cid + ' .caascade-y_to').val(),
        z_to: $(cid + ' .caascade-z_to').val(),
        azimuth: $(cid + ' .caascade-azimuth').val(),
        elevation: $(cid + ' .caascade-elevation').val(),
        ntics: $(cid + ' .caascade-ntics').val(),
        grid: $(cid + ' .caascade-grid').val(),
        logx: $(cid + ' .caascade-logx').val(),
        logy: $(cid + ' .caascade-logy').val(),
        contours: $(cid + ' .caascade-contours').val(),
        box: $(cid + ' .caascade-box').val(),
        axes: $(cid + ' .caascade-axes').val(),
        legend: $(cid + ' .caascade-legend').val(),
        xlabel: $(cid + ' .caascade-xlabel').val(),
        ylabel: $(cid + ' .caascade-ylabel').val(),
        zlabel: $(cid + ' .caascade-zlabel').val(),
        width: $(cid + ' .caascade-width').val(),
        height: $(cid + ' .caascade-height').val(),
        format: $(cid + ' .caascade-format').val(),
        cmd:  $(cid + ' .caascade-cmd').val(),
        pdf:  $(cid + ' .caascade-pdf:checked').val(),
        approximate: $(cid + ' .caascade-approximate:checked').val(),
      },
      success : function(data)
      {
        if(data.input.match(/\$(.*)\$/g) == null)
        {
          data.input = '<pre>' + data.input + '</pre>';
        }
        if(data.output.match(/\$(.*)\$/g) == null && data.output.match(/\<img/g) == null)
        {
          data.output = '<pre>' + data.output + '</pre>';
        }
        $(cid + ' .caascade-output').html('<div class="caascade-out-input"><div class="caascade-prompt caascade-prompt-i">%i1</div>' + data.input + '</div><div class="caascade-out-output"><div class="caascade-prompt caascade-prompt-o">%o1</div>' + data.output + '</div><div class="caascade-out-pdf">' + data.pdf + '</div>');
        // mathjax.org for MathML and TeX
        MathJax.Hub.Queue(["Typeset",MathJax.Hub, cid.substring(1,cid.length)]);
        $(cid + ' .caascade-waiting').animate({opacity:0,height:'toggle'});
        $(cid + ' .caascade-output').animate({opacity:1,height:'toggle'});
      },
    })
    return false;
  })
}(jQuery));

