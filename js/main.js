$(function () {
	// Side bar menu in admin page
	var trigger = $('.hamburger'),
		overlay = $('.overlay'),
		isClosed = false;

	trigger.click(function () {
		hamburger_cross();
	});

	function hamburger_cross() {

		if (isClosed == true) {
			overlay.hide();
			trigger.removeClass('is-open');
			trigger.addClass('is-closed');
			isClosed = false;
		} else {
			overlay.show();
			trigger.removeClass('is-closed');
			trigger.addClass('is-open');
			isClosed = true;
		}
	}
	$('[data-toggle="offcanvas"]').click(function () {
		$('#wrapper').toggleClass('toggled');
	});
	//end of code


	// alert 
	function alertDialog(icon, title, content) {
		Swal.fire(
			title,
			content,
			icon
		)
	}
	//end of code

	//Increment Decrement Button for food.php and categoryfood.php
	function incrementValue(e) {
		e.preventDefault();
		var fieldName = $(e.target).data('field');
		var parent = $(e.target).closest('div');
		var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

		if (!isNaN(currentVal)) {
			parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
		} else {
			parent.find('input[name=' + fieldName + ']').val(1);
		}
	}

	function decrementValue(e) {
		e.preventDefault();
		var fieldName = $(e.target).data('field');
		var parent = $(e.target).closest('div');
		var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

		if (!isNaN(currentVal) && currentVal > 0) {
			parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
		} else {
			parent.find('input[name=' + fieldName + ']').val(0);
		}
	}

	$('.input-group').on('click', '.button-plus', function (e) {
		incrementValue(e);
	});

	$('.input-group').on('click', '.button-minus', function (e) {
		decrementValue(e);
	});
	//end of code

	//TABLE DESIGN
	$("#tabletbl").DataTable({
		"responsive": true,
		"autoWidth": false
	});
	//end of code

});

//   Owl Carousel Function for food.php
/*$('.owl-carousel').owlCarousel({
	loop: false,
	margin: 10,
	nav: true,
	responsive: {
		0: {
			items: 1
		},
		600: {
			items: 3
		},
		1000: {
			items: 5
		}
	}
})*/
//end of code
