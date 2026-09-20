$(function(){
    $(function () {
        let lastScroll = 0;
        const header = $('.header');
        const headerHeight = header.outerHeight();
        const delta = 10;
        const startHide = 50; // 👈 после 50px начинаем работать

        $(window).on('scroll', function () {
            const currentScroll = $(this).scrollTop();

            // игнор мелких движений
            if (Math.abs(currentScroll - lastScroll) < delta) return;

            // если ещё не проскроллили 50px — всегда показываем
            if (currentScroll <= startHide) {
                header.removeClass('hide show');
                $('body').removeClass('header-fixed');
                lastScroll = currentScroll;
                return;
            }

            // 🔻 вниз
            if (currentScroll > lastScroll) {
                header.addClass('hide').removeClass('show');
                $('body').removeClass('header-fixed');
            }
            // 🔺 вверх
            else {
                header.removeClass('hide').addClass('show');
                $('body').addClass('header-fixed');
            }

            lastScroll = currentScroll;
        });
    });

	$('.header__burger').click(function(event){
		$('.header__burger,.header__menu').toggleClass('active');
		$('body').toggleClass('lock');
	});

	$('.header .header__body .header__menu .header__list li a.header__link').click(function(){
		$('body').removeClass('lock');
		$('.header__burger,.header__menu').removeClass('active');
	})

	// Рабочий якорь с переходом по страницам
	$("body").on('click', '[href*="#"]', function(e){
		var fixed_offset = 100;
		$('html,body').stop().animate({ scrollTop: $(this.hash).offset().top - fixed_offset }, 1000);
		e.preventDefault();
	});

    $('.hero-carousel').owlCarousel({
        items:1,
        autoplay:true,
        loop:true,
        dots:true,
        animateOut: 'fadeOut',
        mouseDrag: false,
        touchDrag: false,
    })


    $('.products-carousel').each(function () {
        const $carousel = $(this);
        const $wrapper = $carousel.closest('#products');
        const $nav = $wrapper.find('.custom-nav');

        $carousel.owlCarousel({
            loop: false,
            dots: false,
            nav: true,
            margin: 16,

            navContainer: $nav,

            navText: [
                '<i class="fa-solid fa-arrow-left-long"></i>',
                '<i class="fa-solid fa-arrow-right-long"></i>'
            ],

            stagePadding: 200,

            responsive: {
                0: {
                    items: 2,
                    stagePadding: 0,
                    margin: 4,
                },
                767: {
                    items: 2,
                    stagePadding: 0,
                },
                1024: {
                    items: 3,
                    stagePadding: 100
                },
                1200: {
                    items: 3,
                    stagePadding: 50
                },
                1400: {
                    items: 3,
                    stagePadding: 200
                }
            }
        });
    });
    ;

    // $('.products-carousel').owlCarousel({
    //     loop:false,
    //     dots:false,
    //     nav:true,
    //     margin:16,
    //     navContainer: '.custom-nav',
    //     navText: ["<i class=\"fa-solid fa-arrow-left-long\"></i>", "<i class=\"fa-solid fa-arrow-right-long\"></i>"],
    //     stagePadding: 200,
    //     responsive:{
    //         0:{
    //             items:2,
    //             stagePadding: 0,
    //             margin:4,
    //         },
    //         767:{
    //             items:2,
    //             stagePadding: 0,
    //         },
    //         1024:{
    //             items:3,
    //             stagePadding: 100
    //         },
    //         1200:{
    //             items:3,
    //             stagePadding: 50
    //         },
    //         1400:{
    //             items:3,
    //             stagePadding: 200
    //         }
    //     }
    // });

    $('.products-carousel .owl-nav').appendTo('.owl-nav-append');

// accordion
    const accordionItemHeaders = document.querySelectorAll(
        ".accordion-item-header"
    );

    accordionItemHeaders.forEach((accordionItemHeader) => {
        accordionItemHeader.addEventListener("click", (event) => {
            // Uncomment in case you only want to allow for the display of only one collapsed item at a time!

            const currentlyActiveAccordionItemHeader = document.querySelector(
                ".accordion-item-header.active"
            );
            if (
                currentlyActiveAccordionItemHeader &&
                currentlyActiveAccordionItemHeader !== accordionItemHeader
            ) {
                currentlyActiveAccordionItemHeader.classList.toggle("active");
                currentlyActiveAccordionItemHeader.nextElementSibling.style.maxHeight = 0;
            }
            accordionItemHeader.classList.toggle("active");
            const accordionItemBody = accordionItemHeader.nextElementSibling;
            if (accordionItemHeader.classList.contains("active")) {
                accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
            } else {
                accordionItemBody.style.maxHeight = 0;
            }
        });
    });

    $('.accordion-item').click(function(){
        $(this).toggleClass('active');
        $('.accordion-item').not(this).removeClass('active');
    })


    $('.gallery-carousel').owlCarousel({
        autoplay:false,
        items:1,
        loop:false,
        URLhashListener:true,
        nav:false,
        dots:false,
        margin:0,
        autoHeight:true,
        autoWidth: false,
        startPosition: 'URLHash',
    });

    $('.gallery-hash-carousel').owlCarousel({
        loop:false,
        autoplay:false,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:3
            },
            600:{
                items:5
            },
            1000:{
                items:7
            }
        }
    });

    $('#videoModal').on('shown.bs.modal', function () {
        var video = document.getElementById('modalVideo');
        var source = document.getElementById('modalVideoSource');

        // Если видео еще не загружено
        if (!video.src) {
            source.src = source.getAttribute('data-src');
            video.load(); // загружает видео после установки src
        }

        video.play();
    });

    $('#videoModal').on('hidden.bs.modal', function () {
        var video = document.getElementById('modalVideo');
        video.pause();
        // video.currentTime = 0; // по желанию

        // Если хочешь полностью остановить загрузку — можно убрать src:
        video.removeAttribute('src');
        video.load();
    });

    $('#contactForm').submit(function(e){
        e.preventDefault();
        var $this = $(this);

        $.ajax({
            url: $this.prop('action'),
            method: 'POST',
            data: $this.serialize(),
            success:function(data){
                $('#result_form').html('Your application has been accepted. Our specialists will contact you').show();
                $('#finishModal').modal('show');
                $("#contactForm")[0].reset();
            },error:function(data){
                $('#result_form').html('Error!').show();
                $('#finishModal').modal('show');
                document.getElementById("nextBtn").setAttribute("disabled", "");
            }
        })
    });
});
