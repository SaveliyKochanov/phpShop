
const filtersTest = document.querySelector('.filters-block__text')

filtersTest.addEventListener('click', () => {
	const dropdownMenu = document.querySelector('.dropdown-menu')

	if (dropdownMenu.style.display === 'none') {
		dropdownMenu.style.display = 'block'
	} else {
		dropdownMenu.style.display = 'none'
	}
})

// --------------------------

const headers = document.querySelectorAll('dropdown-menu__item-header')

headers.forEach(function (header) {
	header.addEventListener('click', function () {
		// Получаем следующий элемент (список) после заголовка
		var content = this.nextElementSibling

		// Проверяем, отображается ли содержимое
		if (content.style.display === 'block') {
			// Скрываем содержимое
			content.style.display = 'none'
		} else {
			// Показываем содержимое и скрываем все остальные активные списки
			document
				.querySelectorAll('.dropdown-menu__item-content')
				.forEach(function (item) {
					item.style.display = 'none'
				})
			content.style.display = '<flex></flex>'
		}
	})
})

// 	document.addEventListener('DOMContentLoaded', function () {
// 		// Получаем все заголовки в dropdown-menu__item
// 		const headers = document.querySelectorAll('.brands')

// 		headers.forEach(function (header) {
// 			header.addEventListener('click', function () {
// 				// Получаем следующий элемент (список) после заголовка
// 				var content = this.nextElementSibling

// 				// Проверяем, отображается ли содержимое
// 				if (content.style.display === 'block') {
// 					// Скрываем содержимое
// 					content.style.display = 'none'
// 				} else {
// 					// Показываем содержимое и скрываем все остальные активные списки
// 					document
// 						.querySelectorAll('.dropdown-menu__item-content')
// 						.forEach(function (item) {
// 							item.style.display = 'none'
// 						})
// 					content.style.display = 'block'
// 				}
// 		})
// 	})
// })
