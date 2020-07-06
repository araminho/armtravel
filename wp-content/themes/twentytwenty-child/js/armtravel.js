function Tourism() {
    this.__init.call(this);
}

Tourism.prototype = {
    __init: function () {
        this.setData();
        this.__initEvents();
    },
    setData: function () {
    },
    closeAllSelect: function (elmnt) {
        /*a function that will close all select boxes in the document,
        except the current select box:*/
        let x, y, i, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        for (i = 0; i < y.length; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < x.length; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
    },
    __initEvents: function () {
        jQuery('.slider-container.home-slider').slick({
            infinite: true,
            autoplay: true,
            arrows: true,
            autoplaySpeed: 3000,
        });

        jQuery('.slider-container.tur-slider').slick({
            arrows: false,
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 3,
            centerMode: true,
            variableWidth: true
        });

        jQuery(document).on('click', '.slider-left-arrow', function (e) {
            jQuery(e.target).closest('.slider').find('.slider-container').slick('slickPrev');
        });

        jQuery(document).on('click', '.slider-right-arrow', function (e) {
            jQuery(e.target).closest('.slider').find('.slider-container').slick('slickNext');
        });

        // jQuery('.slider .slider-container').on('afterChange', function(event, slick, currentSlide, nextSlide){
        //   video_tag = jQuery('#main-slider .slick-slide').find('video').get(0);
        //   if(typeof video_tag !== 'undefined') {
        //     video_tag.pause();
        //   }
        //   video_tag = jQuery('.slider .slider-container .slick-active').find('video').get(0);
        //   if(typeof video_tag !== 'undefined') {
        //     video_tag.play();
        //   }
        // });
        let that = this;
        let x, i, j, selElmnt, a, b, c;
        /*look for any elements with the class "custom-select":*/
        x = document.getElementsByClassName("custom-select");
        for (i = 0; i < x.length; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            /*for each element, create a new DIV that will act as the selected item:*/
            a = document.createElement("DIV");
            a.setAttribute("class", "select-selected");
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            x[i].appendChild(a);
            /*for each element, create a new DIV that will contain the option list:*/
            b = document.createElement("DIV");
            b.setAttribute("class", "select-items select-hide");
            for (j = 1; j < selElmnt.length; j++) {
                /*for each option in the original select element,
                create a new DIV that will act as an option item:*/
                c = document.createElement("DIV");
                c.innerHTML = selElmnt.options[j].innerHTML;
                c.addEventListener("click", function (e) {
                    /*when an item is clicked, update the original select box,
                    and the selected item:*/
                    let y, i, k, s, h;
                    s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                    h = this.parentNode.previousSibling;
                    for (i = 0; i < s.length; i++) {
                        if (s.options[i].innerHTML == this.innerHTML) {
                            s.selectedIndex = i;
                            h.innerHTML = this.innerHTML;
                            y = this.parentNode.getElementsByClassName("same-as-selected");
                            for (k = 0; k < y.length; k++) {
                                y[k].removeAttribute("class");
                            }
                            this.setAttribute("class", "same-as-selected");
                            break;
                        }
                    }
                    h.click();
                });
                b.appendChild(c);
            }
            x[i].appendChild(b);
            a.addEventListener("click", function (e) {
                /*when the select box is clicked, close any other select boxes,
                and open/close the current select box:*/
                e.stopPropagation();
                that.closeAllSelect(this);
                this.nextSibling.classList.toggle("select-hide");
                this.classList.toggle("select-arrow-active");
            });
        }

        /*if the user clicks anywhere outside the select box,
        then close all select boxes:*/
        document.addEventListener("click", that.closeAllSelect);
    }

};
let TourismClass = new Tourism();

jQuery(document).ready(function(){
    // console.log(jQuery('#contact-message-field').length);
    // jQuery('#contact-message-field').unwrap();
});