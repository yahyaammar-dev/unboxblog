<div class="container list">
    <div class="row">
        <div class="col-sm-12">
           
            <div class="title">
                <h1 class="sectionHeading-title metaFont">PICK A DESTINATION</h1>
            </div>
            
          <div class="sliderContainer">
            <div class="slider">
                <div class="map-list slider-inner">
                    <div class="area slider-img">
                        <img src="../unboxblog/wp-content/themes/bone-child/images/afgh.png">
                        <p class="areaText">Afghanistan</p>
                    </div>
                    <div class="area slider-img">
                        <img src="../unboxblog/wp-content/themes/bone-child/images/pak.png">
                        <p class="areaText">Pakistan</p>
                    </div>
                    <div class="area slider-img">
                        <img src="../unboxblog/wp-content/themes/bone-child/images/bosnia.png">
                        <p class="areaText">Bosnia</p>
                    </div>
                    <div class="area slider-img">
                        <img src="../unboxblog/wp-content/themes/bone-child/images/afgh.png">
                        <p class="areaText">Afghanistan</p>
                    </div>
                    <div class="area slider-img">
                        <img src="../unboxblog/wp-content/themes/bone-child/images/bosnia.png">
                        <p class="areaText">Bosnia</p>
                    </div>
                    <div class="area slider-img">
                        <img src="../unboxblog/wp-content/themes/bone-child/images/pak.png">
                        <p class="areaText">Pakistan</p>
                    </div>
                    <div class="area slider-img">
                        <img src="../unboxblog/wp-content/themes/bone-child/images/arrow.png" class="arrow">
                        <p class="areaText">Explore<br>More</p>
                    </div>
                </div>
            </div>  
        </div>

        </div>
    </div>
</div>





<script>
    let slider = document.querySelector('.slider');
let innerSlider = document.querySelector('.slider-inner');

const sdSliderContainer = document.querySelector('.slider');
    const sdSlider = document.querySelector('.slider-inner');
    const sdSliderInnerBox = document.querySelectorAll('.slider-img');



let pressed = false;
let startx;
let x;



	slider.addEventListener('mousedown',(e)=>{
		pressed = true
		startx = e.offsetX - innerSlider.offsetLeft;
		slider.style.cursor = 'grabbing'
		});

	slider.addEventListener('mouseenter',()=>{
		slider.style.cursor = 'grab'
	});

	slider.addEventListener('mouseup',()=>{
		slider.style.cursor = 'grab';
		pressed = false
		});

	slider.addEventListener('mousemove',(e)=>{
		if(!pressed) return
		e.preventDefault()
		x = e.offsetX
		innerSlider.style.left = `${x-startx}px`

		checkboundary()

		})


	function checkboundary(){
		let outer = slider.getBoundingClientRect();
		let inner = innerSlider.getBoundingClientRect();

		if(parseInt(innerSlider.style.left)>0){
			innerSlider.style.left = '0px'
		}else if (inner.right < outer.right){
			innerSlider.style.left = `-${inner.width-outer.width}px`
		}
	}

	checkboundary()



    // touch event 
    sdSliderContainer.addEventListener('touchstart', (e)=>{
    pressed = true;
    startx = e.touches[0].clientX - sdSlider.offsetLeft;
    });

    window.addEventListener('touchend', ()=>{
    pressed = false;
    });


    sdSliderContainer.addEventListener('touchmove', (e)=>{
    if(!pressed) return
    e.preventDefault();

    x = e.touches[0].clientX;

    sdSlider.style.left = `${x - startx}px`;

    checkboundary();
    });

    function checkboundary(){
    let outer = sdSliderContainer.getBoundingClientRect();
    let inner = sdSlider.getBoundingClientRect();

    if(parseInt(sdSlider.style.left) > 0){
        sdSlider.style.left = '0px';
    }else if(inner.right < outer.right){
        sdSlider.style.left = `-${inner.width - outer.width}px`
    }
    };













</script>