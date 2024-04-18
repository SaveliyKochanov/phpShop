document.addEventListener('DOMContentLoaded', () => {
    const titles = document.querySelectorAll('.footer__title')
   
    // Функция для проверки ширины экрана
    function isMobile() {
     return window.matchMedia('(max-width: 768px)').matches
    }
   
    titles.forEach(title => {
     title.addEventListener('click', function () {
      // Выполняем логику только если ширина экрана соответствует мобильной
      if (isMobile()) {
       const menu = this.nextElementSibling
   
       if (menu.style.display === 'block') {
        menu.style.display = 'none'
       } else {
        // Закрытие всех других меню перед открытием текущего
        document
         .querySelectorAll('.footer__menu')
         .forEach(m => (m.style.display = 'none'))
        menu.style.display = 'block'
       }
      }
     })
    })
   
    // Закрытие всех меню при изменении размера окна
    window.addEventListener('resize', () => {
     if (!isMobile()) {
      document.querySelectorAll('.footer__menu').forEach(menu => {
       menu.style.display = 'flex' // Или 'block' в зависимости от вашего дизайна
      })
     } else {
      document.querySelectorAll('.footer__menu').forEach(menu => {
       menu.style.display = 'none'
      })
     }
    })
   })