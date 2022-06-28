<!DOCTYPE html>
<html>
<head>
	<?php
		echo $this->fetch('meta');
		echo $this->Html->meta('app/favicon.ico', 'favicon.ico', array('type' => 'icon'));
		echo $this->Html->meta('width=device-width, initial-scale=1.0', array('type' => 'viewport'));
		echo $this->Html->meta('Foto Iraí', array('type' => 'description'));
		echo $this->Html->meta('K Web Systems', array('type' => 'author'));
	?>
	<title>
		<?php echo "Word Learner :: ".$this->fetch('title'); ?>
	</title>
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>
	
	<?php
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->css("style.css");
		echo $this->Html->css("bootstrap.css");
		echo $this->Html->css("jquery.gritter.css");
		echo $this->Html->css("font-awesome.css");
		echo $this->Html->css("nanoscroller.css");
		echo $this->Html->css("jquery.nanoscroller/nanoscroller.css");
		echo $this->Html->css("codemirror.css");
		echo $this->Html->css("ambiance.css");
		echo $this->Html->css("jquery-jvectormap-1.2.2.css");	
		echo $this->Html->css('bootstrap.datetimepicker/css/bootstrap-datetimepicker.css');
		echo $this->Html->css("bootstrap.multiselect/css/bootstrap-multiselect.css");
		echo $this->Html->css("jquery.multiselect/css/multi-select.css");

		//<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		echo $this->fetch("https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js");
		//<!-- Include all compiled plugins (below), or include individual files as needed -->
		echo $this->fetch("http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js");
		echo $this->Js->writeBuffer(); // note: write cached scripts
		echo $this->Html->script('jquery.js');
		echo $this->Html->script('bootstrap/dist/js/bootstrap.min.js');
		echo $this->Html->script('bootstrap.daterangepicker/moment.js');
		echo $this->Html->script('bootstrap.daterangepicker/daterangepicker.js');
		echo $this->Html->script('bootstrap.touchspin/bootstrap-touchspin/bootstrap.touchspin.js');
		echo $this->Html->script('bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js');
		echo $this->Html->script('bootstrap.switch/bootstrap-switch.js');
		echo $this->Html->script('bootstrap.datetimepicker/js/bootstrap-datetimepicker.js');
		echo $this->Html->script('jquery.select2/select2.min.js');
		echo $this->Html->script('bootstrap.slider/js/bootstrap-slider.js');
		echo $this->Html->script('jquery.icheck/icheck.min.js');
		echo $this->Html->css('bootstrap/dist/css/bootstrap.css');
		echo $this->Html->css('jquery.gritter/css/jquery.gritter.css');
		echo $this->Html->css('fonts/font-awesome-4/css/font-awesome.min.css');
		echo $this->Html->css('jasny.bootstrap/extend/css/jasny-bootstrap.min.css');
		echo $this->Html->css('bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css');
		echo $this->Html->css('bootstrap.switch/bootstrap-switch.min.css');
		echo $this->Html->css('jquery.select2/select2.css');
		echo $this->Html->css('bootstrap.slider/css/slider.css');
		echo $this->Html->css('jquery.icheck/skins/flat/green.css');
		echo $this->Html->css('bootstrap.daterangepicker/daterangepicker-bs3.css');
		echo $this->Html->script("jquery.maskedinput/jquery.maskedinput.js");
		
		// echo $this->Html->script('bootstrap.daterangepicker/moment.min.js');
		// echo $this->Html->css('bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css');
		// echo $this->Html->css('css/style.css');
		// echo $this->Html->css("font-awesome.min.css");
		// echo $this->Html->css("style.css");
		// echo $this->Html->css("codemirror.css");
		// echo $this->Html->css("ambiance.css");
		
		echo $this->Html->css("skin-prusia.css");
		echo $this->Html->css("jquery.magnific-popup/dist/magnific-popup.css");
		
		//USUÁRIO DA SESSÃO
		$usuario_sessao = $this->Session->read('Auth.User');
	?>
</head>
<!-- Resetando CSS -->	
<style>
	html, body, div, span, applet, object, iframe,
	h1, h2, h3, h4, h5, h6, p, blockquote, pre,
	a, abbr, acronym, address, big, cite, code,
	del, dfn, em, img, ins, kbd, q, s, samp,
	small, strike, strong, sub, sup, tt, var,
	b, u, i, center,
	dl, dt, dd, ol, ul, li,
	fieldset, form, label, legend,
	table, caption, tbody, tfoot, thead, tr, th, td,
	article, aside, canvas, details, embed, 
	figure, figcaption, footer, header, hgroup, 
	menu, nav, output, ruby, section, summary,
	time, mark, audio, video {
	margin: 0;	
	padding: 0;	
	}
</style>

<body>

<div id="cl-wrapper">
<div class="container-fluid" id="pcont">
	
<?php
	include('menu.ctp');
	
	$message = $this->Session->flash();
	if($message){
		echo $message;
	}
	echo $this->fetch('content');
?>

	</div>
	</div> 
</div>

<?php
	echo $this->Html->script("jquery.cookie/jquery.cookie.js");
	echo $this->Html->script("jquery.pushmenu/js/jPushMenu.js");
	echo $this->Html->script("jquery.nanoscroller/jquery.nanoscroller.js");
	echo $this->Html->script("jquery.sparkline/jquery.sparkline.min.js");
	echo $this->Html->script("jquery.ui/jquery-ui.js");
	echo $this->Html->script("jquery.gritter/js/jquery.gritter.js");
	echo $this->Html->script("behaviour/core.js");
	// echo $this->Html->script("bootstrap/dist/js/bootstrap.min.js");
	echo $this->Html->script("jquery.codemirror/lib/codemirror.js");
	echo $this->Html->script("jquery.codemirror/mode/xml/xml.js");
	echo $this->Html->script("jquery.codemirror/mode/css/css.js");
	echo $this->Html->script("jquery.codemirror/mode/htmlmixed/htmlmixed.js");
	echo $this->Html->script("jquery.codemirror/addon/edit/matchbrackets.js");
	echo $this->Html->script("jquery.vectormaps/jquery-jvectormap-1.2.2.min.js");
	echo $this->Html->script("jquery.vectormaps/maps/jquery-jvectormap-world-mill-en.js");
	echo $this->Html->script("jquery.flot/jquery.flot.js");
	echo $this->Html->script("jquery.flot/jquery.flot.pie.js");
	echo $this->Html->script("jquery.flot/jquery.flot.resize.js");
	echo $this->Html->script("jquery.flot/jquery.flot.labels.js");
	echo $this->Html->script("jquery.datatables/jquery.datatables.min.js");
	echo $this->Html->script("jquery.datatables/bootstrap-adapter/js/datatables.js");
	echo $this->Html->script("bootstrap.multiselect/js/bootstrap-multiselect.js");
	echo $this->Html->script("jquery.multiselect/js/jquery.multi-select.js");
	echo $this->Html->script("jquery.quicksearch/jquery.quicksearch.js");
	echo $this->Html->script("jquery.maskedinput.js");
	echo $this->Html->script("masonry.js");
	echo $this->Html->script("jquery.magnific-popup/dist/jquery.magnific-popup.min.js");
?>

<script type="text/javascript">
    $(document).ready(function(){
	
	  /* INÍCIO POP UP FOTOS */
	  
	   //Initialize Mansory
      var $container = $('.gallery-cont');
      // initialize
      $container.masonry({
        columnWidth: 0,
        itemSelector: '.item'
      });
      
      //Resizes gallery items on sidebar collapse
      $("#sidebar-collapse").click(function(){
          $container.masonry();      
      });
      
      //MagnificPopup for images zoom
      $('.image-zoom').magnificPopup({ 
        type: 'image',
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below
        zoom: {
        enabled: true, // By default it's false, so don't forget to enable it

        duration: 300, // duration of the effect, in milliseconds
        easing: 'ease-in-out', // CSS transition easing function 

        // The "opener" function should return the element from which popup will be zoomed in
        // and to which popup will be scaled down
        // By defailt it looks for an image tag:
        opener: function(openerElement) {
          // openerElement is the element on which popup was initialized, in this case its <a> tag
          // you don't need to add "opener" option if this code matches your needs, it's defailt one.
          var parent = $(openerElement).parents("div.img");
          return parent;
        }
        }

      });
	  /* FIM POP UP FOTOS */
	  
      /*Date Range Picker*/
      $('#reservation').daterangepicker();
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        format: 'MM/DD/YYYY h:mm A'
      });
      var cb = function(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + "]");
      }

      var optionSet1 = {
        startDate: moment().subtract('days', 29),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2014',
        dateLimit: { days: 60 },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
           'Last 7 Days': [moment().subtract('days', 6), moment()],
           'Last 30 Days': [moment().subtract('days', 29), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        },
        opens: 'left',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
      };

      var optionSet2 = {
        startDate: moment().subtract('days', 7),
        endDate: moment(),
        opens: 'left',
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
           'Last 7 Days': [moment().subtract('days', 6), moment()],
           'Last 30 Days': [moment().subtract('days', 29), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        }
      };

      $('#reportrange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

      $('#reportrange').daterangepicker(optionSet1, cb);

      $('#reportrange').on('show', function() { console.log("show event fired"); });
      $('#reportrange').on('hide', function() { console.log("hide event fired"); });
      $('#reportrange').on('apply', function(ev, picker) {
        alert("mama mia");
        console.log("apply event fired, start/end dates are " 
          + picker.startDate.format('MMMM D, YYYY') 
          + " to " 
          + picker.endDate.format('MMMM D, YYYY')
        ); 
      });
      $('#reportrange').on('cancel', function(ev, picker) { console.log("cancel event fired"); });
      /*Switch*/
      $('.switch').bootstrapSwitch();      
      /*DateTime Picker*/
        $(".datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
        $(".datetime1").datetimepicker({format: 'yyyy-mm-dd'});
      
      /*Select2*/
        $(".select2").select2({
          width: '100%'
        });
      
       /*Tags*/
        $(".tags").select2({tags: 0,width: '100%'});
      
       /*Slider*/
        $('.bslider').slider();     
      
      /*Input & Radio Buttons*/
        $('.icheck').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
      /*spinners*/
        $("input[name='cleaninit']").TouchSpin();
        $("input[name='demo1']").TouchSpin({
          min: 0,
          max: 100,
          step: 0.1,
          decimals: 2,
          boostat: 5,
          maxboostedstep: 10,
          postfix: '%'
        });
        $("input[name='demo2']").TouchSpin({
          min: -1000000000,
          max: 1000000000,
          stepinterval: 50,
          maxboostedstep: 10000000,
          prefix: '$'
        });
        $("input[name='demo4']").TouchSpin({
          postfix: "a button",
          postfix_extraclass: "btn btn-default"
        });
      /*End of spinners*/
      /*Color Picker*/
        $('.demo1').colorpicker({
          format: 'hex', // force this format
        });
        $('.demo2').colorpicker({
          format: 'hex', // force this format
        });
        $('.demo-auto').colorpicker();
        // Disabled / enabled triggers
        $(".disable-button").click(function(e) {
            e.preventDefault();
            $("#demo_endis").colorpicker('disable');
        });

        $(".enable-button").click(function(e) {
            e.preventDefault();
            $("#demo_endis").colorpicker('enable');
        });
		
		//MULTISELECT
		////////////////////////////////
		$('#searchable').multiSelect({
		selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='Digite aqui'>",
		selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='Digite aqui'>",
		afterInit: function(ms){
		  var that = this,
			  $selectableSearch = that.$selectableUl.prev(),
			  $selectionSearch = that.$selectionUl.prev(),
			  selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
			  selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

		  that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
		  .on('keydown', function(e){
			if (e.which === 40){
			  that.$selectableUl.focus();
			  return false;
			}
		  });

		  that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
		  .on('keydown', function(e){
			if (e.which == 40){
			  that.$selectionUl.focus();
			  return false;
			}
		  });
		},
		afterSelect: function(){
		  this.qs1.cache();
		  this.qs2.cache();
		},
		afterDeselect: function(){
		  this.qs1.cache();
		  this.qs2.cache();
		}
	  });
        
      /*End of Color Picker*/
    });
</script>
<script>
$(document).ready(function() {
 
setTimeout("$('#message').slideToggle('slow')", 1100);
 
});
</script>
<script type="text/javascript">
      //Add dataTable Functions
      var functions = $('<div class="btn-group"><button class="btn btn-default btn-xs" type="button">Actions</button><button data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle" type="button"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul role="menu" class="dropdown-menu"><li><a href="#">Edit</a></li><li><a href="#">Copy</a></li><li><a href="#">Details</a></li><li class="divider"></li><li><a href="#">Remove</a></li></ul></div>');
      $("#datatable tbody tr td:last-child").each(function(){
        $(this).html("");
        functions.clone().appendTo(this);
      });
    
    $(document).ready(function(){
      //initialize the javascript
      //Basic Instance
      $("#datatable").dataTable();
      
      //Search input style
      $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
      $('.dataTables_length select').addClass('form-control');    
          
       /* Formating function for row details */
        function fnFormatDetails ( oTable, nTr )
        {
            var aData = oTable.fnGetData( nTr );
            var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
            sOut += '<tr><td>Rendering engine:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
            sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
            sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
            sOut += '</table>';
             
            return sOut;
        }
       
        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement( 'th' );
        var nCloneTd = document.createElement( 'td' );
        nCloneTd.innerHTML = '<img class="toggle-details" src="images/plus.png" />';
        nCloneTd.className = "center";
         
        $('#datatable2 thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );
         
        $('#datatable2 tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );
         
        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#datatable2').dataTable( {
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']]
        });
         
        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $('#datatable2').delegate('tbody td img','click', function () {
            var nTr = $(this).parents('tr')[0];
            if ( oTable.fnIsOpen(nTr) )
            {
                /* This row is already open - close it */
                this.src = "images/plus.png";
                oTable.fnClose( nTr );
            }
            else
            {
                /* Open this row */
                this.src = "images/minus.png";
                oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
            }
        });
        
      $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
      $('.dataTables_length select').addClass('form-control');   
      
      /* Init DataTables */
      var aTable = $('#datatable3').dataTable();
       
      /* Apply the jEditable handlers to the table */
      aTable.$('td').editable( 'js/jquery.datatables/examples/examples_support/editable_ajax.php', {
          "callback": function( sValue, y ) {
              var aPos = aTable.fnGetPosition( this );
              aTable.fnUpdate( sValue, aPos[0], aPos[1] );
          },
          "submitdata": function ( value, settings ) {
              return {
                  "row_id": this.parentNode.getAttribute('id'),
                  "column": aTable.fnGetPosition( this )[2]
              };
          },
          "height": "14px",
      });
    });
</script>

</body>
</html>