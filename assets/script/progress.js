$(document).ready(() => {
    const progress = document.getElementById('progress')
    const prev = document.getElementById('prev')
    const next = document.getElementById('next')
    const circles = document.querySelectorAll('.circle')
    
    let currentActive = 1
    if (next){
        next.addEventListener('click', () => {
            currentActive++
        
            if(currentActive > circles.length) {
        
            }
        
            update()
        })
    }
    if(prev) {
        prev.addEventListener('click', () => {
            currentActive--
        
            if(currentActive < 1) {
                currentActive = 1 //aqui
            }
        
            update()
        })
    }

    function update() {
        circles.forEach((circle, idx) => {
            if(idx < currentActive) {
                circle.classList.add('active')
            } else {
                circle.classList.remove('active')
            }
        })
    
        const actives = document.querySelectorAll('.active')
    
        progress.style.width = (actives.length - 1) / (circles.length - 1) * 100 + '%'
    
        if(currentActive === 1) {
            prev.disabled = true  //aqui
        } else if(currentActive === circles.length) {
            next.disabled = true  //aqui
        } else {
            prev.disabled = false // aqui
            next.disabled = false // aqui
        }
    }
});