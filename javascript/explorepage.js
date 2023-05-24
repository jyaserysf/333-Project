
const cardWrapper = document.querySelectorAll('.card-wrapper')

for (let i = 0; i < cardWrapper.length; i++) {
const cardWrapperChildren = Array.from(cardWrapper[i].children)
const widthToScroll = cardWrapper[i].children[0].offsetWidth

const arrowPrev = cardWrapper[i].querySelector('.arrow.prev')
const arrowNext = cardWrapper[i].querySelector('.arrow.next')
const cardBounding = cardWrapper[i].getBoundingClientRect()
const column = Math.floor(cardWrapper[i].offsetWidth / (widthToScroll + 24))
let currScroll = 0
let initPos = 0
let clicked = false



cardWrapper[i].classList.add('no-smooth')
cardWrapper[i].scrollLeft = cardWrapper[i].offsetWidth
cardWrapper[i].classList.remove('no-smooth')


arrowPrev.onclick = function() {
    cardWrapper[i].scrollLeft -= document.body.clientWidth
  }
  
  arrowNext.onclick = function() {
    cardWrapper[i].scrollLeft +=  document.body.clientWidth
  }



  cardWrapper[i].onmousedown = function(e) {
    cardWrapper[i].classList.add('grab')
    initPos = e.clientX - cardBounding.left
    currScroll = cardWrapper[i].scrollLeft
    clicked = true
    }
    
    
    
    cardWrapper[i].onmouseup = mouseUpAndLeave
    cardWrapper[i].onmouseleave = mouseUpAndLeave
    
    function mouseUpAndLeave() {
    cardWrapper[i].classList.remove('grab')
    clicked = false
    }
    
  }